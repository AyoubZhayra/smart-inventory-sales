<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('inventory.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Get category_id or subcategory_id from the request
        $categoryId = $request->input('category_id'); 
        $subcategoryId = $request->input('subcategory_id');
        
        $category = null;
        $subcategory = null;

        if ($subcategoryId) {
            $subcategory = Subcategory::with('category')->findOrFail($subcategoryId);
            $category = $subcategory->category; // Get parent category for context if needed
        } elseif ($categoryId) {
            // If only category_id is passed, maybe get its subcategories?
            // This logic might need refinement depending on desired UX when clicking Add Product from category view (if re-enabled)
            $category = Category::findOrFail($categoryId);
        }
        
        // Get all subcategories for the dropdown selector
        // Consider grouping by parent category for better UX
        $subcategories = Subcategory::with('category')
                         ->orderBy('category_id')->orderBy('name')
                         ->get()
                         ->groupBy('category.name'); // Group by parent category name
        
        // Pass the specific subcategory (if provided) and all subcategories to the view
        return view('inventory.products.create', compact('subcategories', 'subcategory', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }
        
        $validated['status'] = $request->input('status', true);

        Product::create($validated);

        if ($request->filled('subcategory_id')) {
            return redirect()->route('inventory.subcategory', $request->input('subcategory_id'))
                           ->with('success', 'Product Variant created successfully');
        }

        return redirect()->route('products.index')->with('success', 'Product Variant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('inventory.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load(['subcategory.category']);
        
        $subcategories = Subcategory::with('category')
                         ->orderBy('category_id')->orderBy('name')
                         ->get()
                         ->groupBy('category.name'); 
                         
        return view('inventory.products.edit', compact('product', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        } else {
            $validated['image_path'] = $product->image_path;
        }
        
        $validated['status'] = $request->input('status', $product->status);

        $product->update($validated);

        if ($request->filled('subcategory_id')) {
            return redirect()->route('inventory.subcategory', $request->input('subcategory_id'))
                           ->with('success', 'Product Variant updated successfully');
        }
        
        return redirect()->route('products.index')->with('success', 'Product Variant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $subcategoryId = $product->subcategory_id;

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();

        $referer = request()->headers->get('referer');
        if ($referer && strpos($referer, 'inventory/subcategories/') !== false && $subcategoryId) {
            return redirect()->route('inventory.subcategory', $subcategoryId)
                           ->with('success', 'Product Variant deleted successfully');
        } elseif ($referer && strpos($referer, 'inventory/categories/') !== false) {
            preg_match('/inventory\/categories\/(\d+)/', $referer, $matches);
            $categoryId = $matches[1] ?? null;
            if ($categoryId) {
                 return redirect()->route('inventory.category', $categoryId)
                           ->with('success', 'Product Variant deleted successfully');
            }
        }

        return redirect()->route('products.index')->with('success', 'Product Variant deleted successfully');
    }
}
