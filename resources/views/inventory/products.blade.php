@extends('layouts.manager')

@section('title', 'Products')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-violet-600 to-purple-700 rounded-xl shadow-lg p-8 mb-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-white">Products Management</h1>
                <p class="text-purple-100 mt-2">Manage your product inventory</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-purple-600 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add New Product
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-500 hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    Manage Categories
                </a>
            </div>
        </div>
    </div>

    <!-- Search + Filter Section -->
    <div class="flex flex-col md:flex-row gap-6 mb-6">
        <!-- Search -->
        <div class="w-full md:w-2/3">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="relative">
                    <input type="text" placeholder="Search products by name, code, category..." class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Filter by:</span>
                    <button class="text-sm text-purple-600 hover:text-purple-800">
                        Clear All
                    </button>
                </div>
                <div class="flex flex-wrap gap-2 mt-3">
                    <select class="py-1 px-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">All Categories</option>
                    </select>
                    <select class="py-1 px-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">All Statuses</option>
                        <option value="1">In Stock</option>
                        <option value="0">Out of Stock</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50 text-blue-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Products</p>
                    <p class="text-xl font-semibold text-gray-800">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-50 text-green-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">In Stock</p>
                    <p class="text-xl font-semibold text-gray-800">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-50 text-red-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Out of Stock</p>
                    <p class="text-xl font-semibold text-gray-800">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-50 text-yellow-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Low Stock</p>
                    <p class="text-xl font-semibold text-gray-800">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">All Products</h2>
            <div class="flex space-x-3">
                <button class="flex items-center text-gray-500 hover:text-gray-700">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    List
                </button>
                <button class="flex items-center text-purple-600">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Grid
                </button>
            </div>
        </div>

        @if(isset($products) && count($products) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                        <!-- Product Image -->
                        <div class="h-48 relative overflow-hidden bg-gray-100">
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
                        </div>
                        
                        <!-- Product Details -->
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $product->name }}</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-purple-600">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $product->stock_quantity }}</p>
                                </div>
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="mt-3">
                                @if(isset($product->category))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex justify-between mt-4 pt-3 border-t border-gray-100">
                                <a href="{{ route('products.show', $product) }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                    View Details
                                </a>
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.edit', $product) }}" class="text-blue-500 hover:text-blue-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="flex flex-col items-center">
                    <svg class="h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No products found</h3>
                    <p class="text-gray-500 mb-4">Add products to manage your inventory</p>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add First Product
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection 