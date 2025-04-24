@extends('layouts.manager')

@section('title', $subcategory->name . ' - Product Details')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-700 rounded-xl shadow-lg p-8 mb-6"> {{-- Subcategory Color Theme --}}
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                {{-- Link back to parent company --}}
                <a href="{{ route('inventory.category', $category->id) }}" class="mr-3 text-white hover:text-purple-200 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-white">{{ $subcategory->name }} <span class="text-xl font-normal opacity-80">({{ $category->name }})</span></h1>
            </div>
            <div class="flex space-x-3">
                 {{-- Add Item specific to this Product --}}
                <a href="{{ route('products.create', ['subcategory_id' => $subcategory->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Item
                </a>
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden mb-6">
         <div class="relative">
            <!-- Banner Image (using product image or fallback) -->
            <div class="h-40 bg-white relative overflow-hidden"> {{-- Subcategory Color Theme Removed --}}
                @if($category->image_path)
                    {{-- Always use parent company image for banner --}}
                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-full h-full object-contain opacity-30">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>
            
            <!-- Product Image (Overlay) -->
            <div class="absolute -bottom-16 left-8">
                <div class="h-40 w-40 rounded-lg shadow-lg border-4 border-white overflow-hidden bg-white">
                    @if($subcategory->image_path)
                        <img src="{{ asset('storage/' . $subcategory->image_path) }}" alt="{{ $subcategory->name }}" class="w-full h-full object-contain">
                    @else
                         <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center"> {{-- Subcategory Color Theme --}}
                            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="mt-16 px-8 pb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $subcategory->name }}</h2>
                     <p class="text-sm text-gray-500">Parent Company: <a href="{{ route('inventory.category', $category->id) }}" class="text-blue-600 hover:underline">{{ $category->name }}</a></p>
                </div>
                
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <div class="px-3 py-1 bg-green-50 rounded text-green-700 font-medium text-sm">
                        {{ $products->count() }} Items
                    </div>
                    @if($subcategory->status)
                        <div class="px-3 py-1 bg-green-50 rounded text-green-700 font-medium text-sm">
                            Active
                        </div>
                    @else
                        <div class="px-3 py-1 bg-red-50 rounded text-red-700 font-medium text-sm">
                            Inactive
                        </div>
                    @endif
                    
                     {{-- Edit Product Link (formerly Edit Subcategory) --}}
                    <a href="{{ route('subcategories.edit', $subcategory) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Section (Formerly Products) -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3 md:mb-0">Product Variants in {{ $subcategory->name }}</h2>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search product variants..." class="w-full md:w-60 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                 {{-- Add Item Button --}}
                 <a href="{{ route('products.create', ['subcategory_id' => $subcategory->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add New Item
                </a>
            </div>
        </div>
        
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <!-- Item Image -->
                        <a href="{{ route('products.show', $product) }}" class="block h-36 relative overflow-hidden bg-gray-100">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-contain group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-100">
                                    <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-2 right-2 z-10">
                                @if($product->stock_quantity > 0)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">In Stock</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Out of Stock</span>
                                @endif
                            </div>
                        </a>
                        
                        <!-- Item Details -->
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1 mr-2">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <h3 class="text-base font-semibold text-gray-800 line-clamp-1 group-hover:text-purple-600">{{ $product->name }}</h3>
                                    </a>
                                </div>
                                <p class="text-lg font-bold text-blue-600 flex-shrink-0">${{ number_format($product->price, 2) }}</p>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">Qty: {{ $product->stock_quantity }}</p>
                            
                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-2 mt-3 pt-3 border-t border-gray-100">
                                 <a href="{{ route('products.edit', $product) }}" class="text-blue-500 hover:text-blue-700" title="Edit Product Variant">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product variant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Product Variant">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No product variants found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new product variant for this product.</p>
                 <div class="mt-6">
                    <a href="{{ route('products.create', ['subcategory_id' => $subcategory->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add First Product Variant
                    </a>
                </div>
            </div>
        @endif
    </div>

</div> 

{{-- Optional: Add styles if needed --}}
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection 