<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-semibold mb-6">Edit Category</h1>
            
            <form enctype="multipart/form-data" action="{{ url('category/update/'.$categories->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="category_name" class="block text-gray-700 text-sm font-medium mb-2">Update Category Name</label>
                    <input type="text" id="category_name" name="category_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ $categories->category_name }}" required>
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="current_image" style="font-weight: bold;">Current Image</label>
                    @if(isset($categories->category_image))
                        <img src="{{ asset('storage/' . $categories->category_image) }}" alt="Current Category Image" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </div>
    
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="category_image" style="font-weight: bold;">New Image</label>
                    <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*">
                </div>

                <div class="mb-6">
                    <button type="submit" style="background-color: yellow; color: black; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 9999px; cursor: pointer;">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
