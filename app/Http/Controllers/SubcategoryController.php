<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        return view('subcategories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validatedData;
        $data['status'] = $request->input('status', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($data);

        return redirect()->route('inventory.category', $data['category_id'])
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $subcategory->load('category');
        return view('subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validatedData;
        $data['status'] = $request->input('status', $subcategory->status);

        if ($request->hasFile('image')) {
            if ($subcategory->image_path) {
                Storage::disk('public')->delete($subcategory->image_path);
            }
            $data['image_path'] = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->update($data);

        return redirect()->route('inventory.category', $subcategory->category_id)
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $categoryId = $subcategory->category_id;

        if ($subcategory->image_path) {
            Storage::disk('public')->delete($subcategory->image_path);
        }

        $subcategory->delete();

        return redirect()->route('inventory.category', $categoryId)
            ->with('success', 'Product deleted successfully.');
    }
}
