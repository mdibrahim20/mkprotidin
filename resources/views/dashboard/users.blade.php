<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Open Modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Edit User
        function editUser(userId) {
            fetch(`/admin/users/${userId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user_id').value = data.id;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_email').value = data.email;
                    document.getElementById('edit_role').value = data.role;

                    document.getElementById('editUserForm').setAttribute('action', `/admin/users/${data.id}`);

                    openModal('editUserModal');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
     

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64">
            <!-- Navbar -->
            @include('dashboard.nav')
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">User Management</h1>
                <button onclick="openModal('addUserModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New User</button>
            </header>

            <!-- Users Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Users</h2>
                {{-- <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Role</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td class="border p-2">{{ $user->name }}</td>
                                <td class="border p-2">{{ $user->email }}</td>
                                <td class="border p-2">{{ ucfirst($user->role) }}</td>
                                <td class="border p-2">
                                    <button onclick="editUser({{ $user->id }})" class="bg-blue-500 text-white px-4 py-1 rounded">Edit</button>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Role</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td class="border p-2">{{ $user->name }}</td>
                                <td class="border p-2">{{ $user->email }}</td>
                                <td class="border p-2">{{ ucfirst($user->role) }}</td>
                                <td class="border p-2">
                                    <span class="{{ $user->status === 'active' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="border p-2">
                                    <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="{{ $user->status === 'active' ? 'bg-red-500' : 'bg-green-500' }} text-white px-4 py-1 rounded">
                                            {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    
                                    <button onclick="editUser({{ $user->id }})" class="bg-blue-500 text-white px-4 py-1 rounded">Edit</button>
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

            <!-- Add User Modal -->
            <!-- Add User Modal -->
<div id="addUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Add New User</h2>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="role" class="block">Role</label>
                <select name="role" id="role" class="w-full p-2 border rounded" required>
                    <option value="author" {{ old('role', 'author') == 'author' ? 'selected' : '' }}>Author</option>
                    <option value="editor" {{ old('role', 'author') == 'editor' ? 'selected' : '' }}>Editor</option>
                </select>
                
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add User</button>
            <button type="button" onclick="closeModal('addUserModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
        </form>
    </div>
</div>


            <!-- Edit User Modal -->
            <!-- Edit User Modal -->
<div id="editUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Edit User</h2>
        <form action="" method="POST" id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" id="user_id">
            <div class="mb-4">
                <label for="edit_name" class="block">Name</label>
                <input type="text" name="name" id="edit_name" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="edit_email" class="block">Email</label>
                <input type="email" name="email" id="edit_email" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="edit_role" class="block">Role</label>
                <select name="role" id="edit_role" class="w-full p-2 border rounded" required>
                    <option value="author">Author</option>
                    <option value="editor">Editor</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="edit_password" class="block">New Password (optional)</label>
                <input type="password" name="password" id="edit_password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
            <button type="button" onclick="closeModal('editUserModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
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
