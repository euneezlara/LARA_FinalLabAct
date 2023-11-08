
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hello {{Auth::user()->name}}<b style = "float:right"></b>
        </h2>
    </x-slot>
    <div class="container">
        <h1>Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
</x-app-layout>
