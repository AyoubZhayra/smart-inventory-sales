@extends('layouts.manager')

@section('title', 'Create New Company')

@section('content')
<div class="space-y-8 fade-in">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold text-white">Create New Company</h1>
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
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Company Name*</label>
                        <input type="text" name="name" id="name" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                         @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Image Upload -->
                <div>
                    <label for="image-upload" class="block text-sm font-medium text-gray-700 mb-1">Company Image</label>
                    <div class="mt-1 flex items-center space-x-4 p-4 border-2 border-dashed border-gray-300 rounded-md">
                        <div id="preview-container" class="hidden w-24 h-24 rounded bg-gray-100 overflow-hidden">
                            <img id="preview-image" src="#" alt="Image preview" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input id="image-upload" name="image" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                     @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Company
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
    
    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                previewImage.setAttribute('src', this.result);
                previewContainer.classList.remove('hidden');
            });
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection 