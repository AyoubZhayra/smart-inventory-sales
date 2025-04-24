@extends('layouts.manager')

@section('title', 'Edit Company')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold text-white">Edit Company: {{ $category->name }}</h1>
            </div>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Companies
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-8">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Company Name*</label>
                        <input type="text" name="name" id="name" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                    
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Image</label>
                    <div class="mt-1 flex items-center space-x-4 p-4 border-2 border-dashed border-gray-300 rounded-md">
                        <div id="preview-container" class="{{ $category->image_path ? '' : 'hidden' }} w-24 h-24 rounded bg-gray-100 overflow-hidden flex-shrink-0">
                            <img id="preview-image" src="{{ $category->image_path ? asset('storage/' . $category->image_path) : '#' }}" alt="Image preview" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                             <label for="image-upload" class="cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
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
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Company
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for image preview -->
<script>
    const defaultImageSrc = "{{ $category->image_path ? asset('storage/' . $category->image_path) : '#' }}";
</script>
@endsection 