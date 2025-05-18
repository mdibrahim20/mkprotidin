<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad Management</title>
    <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function editAd(adId) {
            fetch(`/admin/ads/${adId}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Ad Data Received:", data); // Debugging Log

                    document.getElementById('edit_ad_id').value = data.id;
                    document.getElementById('edit_ad_title').value = data.title;
                    document.getElementById('edit_ad_position').value = data.position;
                    document.getElementById('edit_ad_url').value = data.url;

                    // Ensure the form action is set correctly
                    document.getElementById('editAdForm').setAttribute('action', `/admin/ads/${data.id}`);

                    // Open the modal
                    openModal('editAdModal');
                })
                .catch(error => {
                    console.error('Error fetching ad data:', error);
                });
        }

       
    </script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        
       
    
        <main class="flex-1 p-6 ml-0 md:ml-64">
            @include('dashboard.nav')
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Ad Management</h1>
                <button onclick="openModal('addAdModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Ad</button>
            </header>
    
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Ads</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Title</th>
                            <th class="border p-2">Position</th>
                            <th class="border p-2">Image</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad)
                            <tr class="text-center">
                                <td class="border p-2">{{ $ad->title }}</td>
                                <td class="border p-2">{{ $ad->position }}</td>
                                <td class="border p-2"><img src="{{ asset('storage/' . $ad->image) }}" width="100"></td>
                                <td class="border p-2">
                                    <button onclick="editAd({{ $ad->id }})" class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</button>
                                    @if (auth()->user() && auth()->user()->isAdmin())
                                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" style="display:inline;">
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
    
                <div class="mt-4">{{ $ads->links() }}</div>
            </div>
        </main>
    </div>
                <!-- ADD AD MODAL -->
            <div id="addAdModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Add New Ad</h2>
                    <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block">Title</label>
                            <input type="text" name="title" id="title" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="position" class="block">Position</label>
                            <select name="position" id="position" class="w-full p-2 border rounded">
                                <option value="header">Header</option>
                                <option value="sidebar">Sidebar</option>
                                <option value="footer">Footer</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="url" class="block">URL</label>
                            <input type="text" name="url" id="url" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block">Image</label>
                            <input type="file" name="image" id="image" class="w-full p-2 border rounded">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Ad</button>
                        <button type="button" onclick="closeModal('addAdModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- EDIT AD MODAL -->
            <!-- EDIT AD MODAL -->
<div id="editAdModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Edit Ad</h2>
        <form action="" method="POST" id="editAdForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Hidden Input for ID -->
            <input type="hidden" name="id" id="edit_ad_id">

            <div class="mb-4">
                <label for="edit_ad_title" class="block">Title</label>
                <input type="text" name="title" id="edit_ad_title" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="edit_ad_position" class="block">Position</label>
                <select name="position" id="edit_ad_position" class="w-full p-2 border rounded">
                    <option value="header">Header</option>
                    <option value="sidebar">Sidebar</option>
                    <option value="footer">Footer</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="edit_ad_url" class="block">URL</label>
                <input type="text" name="url" id="edit_ad_url" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="edit_ad_image" class="block">Upload New Image</label>
                <input type="file" name="image" id="edit_ad_image" class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Ad</button>
            <button type="button" onclick="closeModal('editAdModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
        </form>
    </div>
</div>
    {{-- <div class="md:hidden flex justify-between items-center bg-gray-800 text-white p-4">
            <h2 class="text-xl font-bold">Admin Dashboard</h2>
            <button onclick="toggleSidebar()" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div> --}}
    
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
