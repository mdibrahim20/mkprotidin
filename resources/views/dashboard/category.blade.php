<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>

    <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Script for showing modals
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function editCategory(categoryId) {
            fetch(`/admin/categories/${categoryId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Populate the modal form with data
                    document.getElementById('category_id').value = data.id;
                    document.getElementById('edit_category_name').value = data.name; // Ensure correct input ID

                    // Set the correct action URL for the form
                    const formAction = `/admin/categories/${data.id}`;
                    document.getElementById('editCategoryForm').setAttribute('action', formAction);

                    // Open the modal
                    openModal('editCategoryModal');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
       

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64">
            <!-- Navbar -->
            @include('dashboard.nav')
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Category Management</h1>
                <button onclick="openModal('addCategoryModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Category</button>
            </header>

            <!-- Categories Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Categories</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Category Name</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="text-center">
                                <td class="border p-2">{{ $category->name }}</td>
                                <td class="border p-2">
                                    <button onclick="editCategory({{ $category->id }})" class="bg-blue-500 text-white px-4 py-1 rounded">Edit</button>
                                    @if(auth()->user() && auth()->user()->isAdmin()) 
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $categories->links() }}  <!-- Display pagination links -->
                </div>
            </div>

            <!-- Add Category Modal -->
            <div id="addCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Add New Category</h2>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="category_name" class="block">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="w-full p-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</button>
                        <button type="button" onclick="closeModal('addCategoryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Edit Category Modal -->
            <div id="editCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit Category</h2>
                    <form action="" method="POST" id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="category_id" id="category_id"> <!-- Hidden field for category ID -->
                        <div class="mb-4">
                            <label for="edit_category_name" class="block">Category Name</label>
                            <input type="text" name="category_name" id="edit_category_name" class="w-full p-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Category</button>
                        <button type="button" onclick="closeModal('editCategoryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "green",
            }).showToast();
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
            }).showToast();
        });
    </script>
@endif

</body>
</html>
