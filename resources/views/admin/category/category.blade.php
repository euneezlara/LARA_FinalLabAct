<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{ Auth::user()->name }}
            @if($categories !== null)
                <span class="badge text-danger" style="float:right"> Total Categories: {{ count($categories) }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $category->id }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $category->category_name }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $category->user->name }}</td>
                                        <td>
                                            @if($category->category_image)
                                            <img src="{{ asset('storage/' . $category->category_image) }}" alt="Category Image"
                                                style="max-width: 100px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $category->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <a href="{{ url('category/edit/' . $category->id) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <form action="{{ route('delete.category', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
             

                <div class="col-md-4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h1 class="text-xl font-semibold mb-6">Add Categories</h1>
                        <form enctype="multipart/form-data" action="{{ route('add.category') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="category_name" class="block text-gray-700 text-sm font-medium mb-2">Category Name</label>
                                <input type="text" id="category_name" name="category_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter category name" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="category_image" style="font-weight: bold;">Image</label>
                                <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*">
                
                            </div>
                            <div class="mb-6">
                                <button type="submit" id="createCategoryBtn" style="background-color: yellow; color: black; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 9999px; cursor: pointer;">Create Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Soft Deleted Categories Table -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight p-6">Soft Deleted Categories</h2>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($softDeletedCategories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>
                                    @if($category->category_image)
                                        <img src="{{ asset('storage/' . $category->category_image) }}" alt="Category Image" style="max-width: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <form action="{{ route('restore.category', $category->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success">Restore</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('forceDelete.category', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
