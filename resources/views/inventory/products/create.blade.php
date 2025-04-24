@extends('layouts.manager')

@section('title', 'Create Product Variant')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-violet-600 to-purple-700 rounded-xl shadow-lg p-8 mb-6">
        <div class="flex items-center">
            <a href="{{ request()->has('return_to_category') && request()->has('category_id')
                ? route('inventory.category', request('category_id'))
                : route('products.index') }}" class="mr-3 text-white hover:text-purple-200 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-white">
                {{ isset($category) ? 'Add Product Variant to ' . $category->name : 'Create Product Variant' }}
            </h1>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- If coming from a category page, include these hidden fields -->
            @if(request()->has('return_to_category'))
                <input type="hidden" name="return_to_category" value="1">
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Variant Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Variant Information -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 pb-2 border-b">Product Variant Information</h2>

                    <!-- Parent Product (Formerly Subcategory) -->
                    <div>
                        <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Product*</label>
                        <select name="subcategory_id" id="subcategory_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="">Select a parent product</option>
                            {{-- Loop through grouped products (formerly subcategories) --}}
                            @foreach($subcategories as $parentCompanyName => $subcats)
                                <optgroup label="{{ $parentCompanyName }}">
                                    @foreach($subcats as $sub)
                                        <option value="{{ $sub->id }}" {{ old('subcategory_id', $subcategory->id ?? '') == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @if($subcategories->isEmpty())
                            <p class="text-yellow-600 text-sm mt-1">No parent products found. Please create a parent product first.</p>
                        @endif
                        @error('subcategory_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pricing & Inventory -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 pb-2 border-b">Pricing & Inventory</h2>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price*</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" min="0" step="0.01" value="{{ old('price') }}" class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden Cost Price -->
                    <input type="hidden" name="cost_price" value="0">

                    <!-- Stock -->
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity*</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" min="0" step="1" value="{{ old('stock_quantity', 0) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        @error('stock_quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="flex items-center">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }} class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="status" class="ml-2 block text-sm text-gray-700">Product Variant is active</label>
                    </div>
                </div>
            </div>

            <!-- Product Variant Image -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800 pb-2 border-b mb-4">Product Variant Image</h2>

                <div class="flex items-center space-x-6">
                    <div class="w-40 h-40 border-2 border-gray-300 border-dashed rounded-lg flex items-center justify-center">
                        <img id="preview" src="#" alt="Preview" class="h-full w-full object-cover hidden">
                        <div id="placeholder" class="text-center p-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-500">No image</p>
                        </div>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product Variant Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        <p class="mt-1 text-sm text-gray-500">Recommended size: 800x800 pixels. Max file size: 2MB</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ request()->has('return_to_category') && request()->has('category_id')
                    ? route('inventory.category', request('category_id'))
                    : route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create Product Variant
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                document.getElementById('placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection 