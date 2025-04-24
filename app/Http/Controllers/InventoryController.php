<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        // Get all active categories
        $categories = Category::where('status', true)
                            ->with('subcategories')
                            ->get();
                            
        // Get the total count of products
        $totalProducts = Product::count();
        
        // Calculate product counts for each category by summing subcategory product counts
        foreach ($categories as $category) {
            $subcategoryIds = $category->subcategories->pluck('id')->toArray();
            // Count products belonging to the subcategories of this category
            $category->product_count = Product::whereIn('subcategory_id', $subcategoryIds)->count();
        }
        
        return view('inventory.index', compact('categories', 'totalProducts'));
    }
    
    public function showCategory(Category $category)
    {
        // Eager load subcategories and their products
        $category->load(['subcategories.products']);
        
        // Get all products belonging to the subcategories of this category
        $subcategoryIds = $category->subcategories->pluck('id')->toArray();
        $products = Product::whereIn('subcategory_id', $subcategoryIds)->get();
        
        // Calculate product counts for each subcategory
        foreach ($category->subcategories as $subcategory) {
            // Count products linked to this specific subcategory
            $subcategory->product_count = Product::where('subcategory_id', $subcategory->id)->count();
        }
        
        // Count total products in this category (sum of products in its subcategories)
        $totalCategoryProducts = $products->count();
        
        // Get subcategories separately for the view if needed
        $subcategories = $category->subcategories;
        
        // Pass category, subcategories, products, and total count to the view
        return view('inventory.category', compact('category', 'subcategories', 'products', 'totalCategoryProducts'));
    }
    
    /**
     * Display the specified subcategory and its products.
     */
    public function showSubcategory(Subcategory $subcategory)
    {
        // Eager load category (for breadcrumbs/links) and products
        $subcategory->load(['category', 'products']);
        
        $products = $subcategory->products; // Get products directly from the relationship
        $category = $subcategory->category; // Get parent category
        
        // Pass the subcategory, its products, and the parent category to the view
        return view('inventory.subcategory', compact('subcategory', 'products', 'category'));
    }
} 