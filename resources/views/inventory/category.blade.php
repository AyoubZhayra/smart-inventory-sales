@extends('layouts.manager')

@section('title', $category->name . ' - Company Overview')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('inventory.index') }}" class="mr-3 text-white hover:text-blue-200 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-white">{{ $category->name }}</h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('subcategories.create', $category) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-500 hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Company Info -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden mb-6">
        <div class="relative">
            <!-- Banner Image -->
            <div class="h-40 bg-white relative overflow-hidden">
                @if($category->image_path)
                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-full h-full object-contain opacity-40">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>
            
            <!-- Company Image (Overlay) -->
            <div class="absolute -bottom-16 left-8">
                <div class="h-40 w-40 shadow-lg border-4 border-white overflow-hidden bg-white">
                    @if($category->image_path)
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Company Details -->
        <div class="mt-16 px-8 pb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h2>
                </div>
                
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <div class="px-3 py-1 bg-purple-50 rounded text-purple-700 font-medium text-sm">
                        {{ $category->subcategories->count() }} Products
                    </div>
                    @if($category->status)
                        <div class="px-3 py-1 bg-green-50 rounded text-green-700 font-medium text-sm">
                            Active
                        </div>
                    @else
                        <div class="px-3 py-1 bg-red-50 rounded text-red-700 font-medium text-sm">
                            Inactive
                        </div>
                    @endif
                    
                    <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Company
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Subcategories Section -->
    @if($category->subcategories->count() > 0)
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3 md:mb-0">Products</h2>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('subcategories.create', $category) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($category->subcategories as $subcategory)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Product Top -->
                    <div class="h-3 bg-gradient-to-r from-purple-400 to-pink-500"></div>
                    
                    <!-- Product Content -->
                    <div class="p-6">
                        <!-- Product Image -->
                        <div class="flex justify-center mb-5">
                            @if($subcategory->image_path)
                                <div class="w-40 h-40 overflow-hidden rounded-lg">
                                    <img src="{{ asset('storage/' . $subcategory->image_path) }}" alt="{{ $subcategory->name }}" class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="w-40 h-40 bg-gradient-to-br from-purple-50 to-pink-100 flex items-center justify-center rounded-lg border border-purple-100">
                                    <svg class="h-16 w-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-purple-600 transition-colors">{{ $subcategory->name }}</h3>
                            
                            <div class="flex justify-center space-x-2 mb-3">
                                @if($subcategory->status)
                                    <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-50 text-red-700 text-xs rounded">Inactive</span>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center border-t border-gray-100 pt-3 mt-2">
                                <a href="{{ route('inventory.subcategory', $subcategory) }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                    View Product Details
                                </a>
                                <div class="flex space-x-2">
                                    <a href="{{ route('subcategories.edit', $subcategory) }}" class="text-purple-500 hover:text-purple-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('subcategories.destroy', $subcategory) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product? This might also delete associated items.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Products Section -->
    @if($category->parent_id)
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3 md:mb-0">Product Variants in {{ $category->name }} (All Products)</h2>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search product variants..." class="w-full md:w-60 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        @if(count($products) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                        <!-- Item Image -->
                        <a href="{{ route('products.show', $product) }}" class="block h-48 relative overflow-hidden bg-gray-100">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-100">
                                    <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-2 right-2">
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
                                    <h3 class="text-base font-semibold text-gray-800 line-clamp-1 group-hover:text-blue-600">{{ $product->name }}</h3>
                                    @if($product->subcategory)
                                    <p class="text-xs text-gray-500 mt-1">Product: {{ $product->subcategory->name }}</p>
                                    @endif
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
                <p class="mt-1 text-sm text-gray-500">There are currently no product variants listed under this company.</p>
            </div>
        @endif
    </div>
    @endif
</div>

<style>
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection 