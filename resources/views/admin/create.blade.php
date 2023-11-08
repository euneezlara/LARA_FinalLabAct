<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-semibold mb-6">Create Category</h1>
            
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="category_name" class="block text-gray-700 text-sm font-medium mb-2">Category Name</label>
                    <input type="text" id="category_name" name="category_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter category name" required>
                </div>

                <div class="mb-6">
                    <button type="submit" id="createCategoryBtn" style="background-color: yellow; color: black; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 9999px; cursor: pointer;">Create Category</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="hidden fixed top-0 right-0 m-4 p-2 bg-green-400 text-white rounded-md shadow-md">
        Category Created
    </div>
</x-app-layout>

<script>
    // Add JavaScript to show the toast when the button is clicked
    document.getElementById('createCategoryBtn').addEventListener('click', function() {
        var toast = document.getElementById('toast');
        toast.classList.remove('hidden');
        setTimeout(function() {
            toast.classList.add('hidden');
        }, 3000); // Hide the toast after 3 seconds (adjust as needed)
    });
</script>
