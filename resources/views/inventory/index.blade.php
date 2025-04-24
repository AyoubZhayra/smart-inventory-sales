@extends('layouts.manager')

@section('title', 'Inventory Overview')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Inventory Overview</h1>
                <p class="text-lg text-blue-200 mt-1">Manage your companies, subcategories, and products.</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add Company
                </a>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                 <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Companies</p>
                <p class="text-2xl font-bold text-gray-900">{{ $categories->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Products</p>
                <p class="text-2xl font-bold text-gray-900">{{ $categories->sum(fn($cat) => $cat->subcategories->count()) }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Product Variants</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <!-- Companies List -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Companies</h2>
    
    @if($categories->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <!-- Company Image -->
                    <a href="{{ route('inventory.category', $category) }}" class="block h-48 relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100">
                        @if($category->image_path)
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="h-full w-full object-contain group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="h-full w-full flex items-center justify-center">
                                <svg class="h-16 w-16 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        @endif
                        <!-- Status Badge -->
                        <div class="absolute top-2 right-2">
                             @if($category->status)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Active</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Inactive</span>
                            @endif
                        </div>
                    </a>
                    
                    <!-- Company Details -->
                    <div class="p-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 group-hover:text-blue-600 transition-colors">{{ $category->name }}</h3>
                        <div class="mt-2 flex justify-between items-center text-sm text-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $category->subcategories->count() }} Products
                            </span>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-gray-100 flex justify-end">
                             <a href="{{ route('inventory.category', $category) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No companies found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by adding your first company.</p>
            <div class="mt-6">
                <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add Company
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 