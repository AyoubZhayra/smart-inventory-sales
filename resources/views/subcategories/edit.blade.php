@extends('layouts.manager')

@section('title', 'Edit Product')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-700 rounded-xl shadow-lg p-8 mb-6"> {{-- Changed color theme --}}
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                 <a href="{{ route('inventory.category', $subcategory->category_id) }}" class="mr-3 text-white hover:text-purple-200 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-white">Edit Product: {{ $subcategory->name }}</h1>
            </div>
             <a href="{{ route('inventory.category', $subcategory->category_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"> {{-- Changed color theme --}}
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to {{ $subcategory->category->name }} {{-- $subcategory->category is the parent Company --}}
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-8">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') {{-- Use PUT method for update --}}
                
                {{-- Hidden input for parent company ID (keep name category_id for backend) --}}
                <input type="hidden" name="category_id" value="{{ $subcategory->category_id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name*</label>
                        <input type="text" name="name" id="name" class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('name', $subcategory->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="1" {{ old('status', $subcategory->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $subcategory->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <div class="mt-1 flex items-center space-x-4 p-4 border-2 border-dashed border-gray-300 rounded-md">
                        <div id="preview-container" class="{{ $subcategory->image_path ? '' : 'hidden' }} w-24 h-24 rounded bg-gray-100 overflow-hidden flex-shrink-0">
                            <img id="preview-image" src="{{ $subcategory->image_path ? asset('storage/' . $subcategory->image_path) : '#' }}" alt="Image preview" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                             <label for="image-upload" class="cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                <span>Upload a file</span>
                                <input id="image-upload" name="image" type="file" class="sr-only">
                            </label>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB. Leave blank to keep current image.</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('inventory.category', $subcategory->category_id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"> {{-- Changed color theme --}}
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for image preview -->
<script>
    const imageUpload = document.getElementById('image-upload');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const defaultImageSrc = "{{ $subcategory->image_path ? asset('storage/' . $subcategory->image_path) : '#' }}"; // Store default image

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                previewImage.setAttribute('src', this.result);
                previewContainer.classList.remove('hidden');
            });
            
            reader.readAsDataURL(file);
        } else {
             // If no file is selected (e.g., user cancels), revert to the original image or hide if none existed
             if (defaultImageSrc !== '#') {
                previewImage.setAttribute('src', defaultImageSrc);
                previewContainer.classList.remove('hidden');
             } else {
                previewImage.setAttribute('src', '#');
                previewContainer.classList.add('hidden');
             }
        }
    });
</script>
@endsection 