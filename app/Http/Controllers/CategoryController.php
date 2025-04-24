<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // Fetch all categories (parent_id logic removed earlier)
        $categories = Category::query()
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name') // Optional: Order categories alphabetically
            ->get();
        
        return view('categories.index', compact('categories', 'query'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create() // No request needed unless passing other data
    {
        // Removed parent category logic
        return view('categories.create'); // Pass only view name
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Simplified validation for Category only
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $validatedData;
        $data['status'] = $request->input('status', true); // Default status

        // Handle image upload for Category
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        // Redirect to the categories index
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     * Note: This might be redundant if inventory.category view is preferred.
     */
    public function show(Category $category)
    {
        // Simplified: just pass the category. Subcategory loading is handled elsewhere.
        return view('categories.show', compact('category')); 
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        // Simplified: just pass the category to the view
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
         // Simplified validation for Category only
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validatedData;
        $data['status'] = $request->input('status', $category->status);

        // Handle image upload for Category
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        // Redirect to the categories index
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Delete image if exists
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }
        
        // Note: Deleting a category might orphan subcategories/products
        // unless cascade delete is set up in migrations or handled here.
        $category->delete(); 

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
} 