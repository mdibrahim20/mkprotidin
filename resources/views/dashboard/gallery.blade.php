<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management</title>
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

        function editVideoGallery(videoId) {
            fetch(`/admin/video-gallery/${videoId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_video_id').value = data.id;
                    document.getElementById('edit_title1').value = data.title1;
                    document.getElementById('edit_title2').value = data.title2;
                    document.getElementById('edit_title3').value = data.title3;
                    document.getElementById('edit_video1').value = data.video1;
                    document.getElementById('edit_video2').value = data.video2;
                    document.getElementById('edit_video3').value = data.video3;

                    document.getElementById('editVideoGalleryForm').setAttribute('action', `/admin/video-gallery/${data.id}`);

                    openModal('editVideoGalleryModal');
                })
                .catch(error => console.error('Error fetching video gallery:', error));
        }
        
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
  

        <main class="flex-1 p-6 md:ml-64">
            @include('dashboard.nav')
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Gallery Management</h1>
                <button onclick="openModal('addGalleryModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Gallery</button>
            </header>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Galleries</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Title 1</th>
                            <th class="border p-2">Title 2</th>
                            <th class="border p-2">Title 3</th>
                            <th class="border p-2">Images</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr class="text-center">
                                <td class="border p-2">{{ $gallery->title1 }}</td>
                                <td class="border p-2">{{ $gallery->title2 }}</td>
                                <td class="border p-2">{{ $gallery->title3 }}</td>
                                <td class="border p-2 flex justify-center space-x-2">
                                    <img src="{{ asset('storage/'.$gallery->image1) }}" width="50">
                                    <img src="{{ asset('storage/'.$gallery->image2) }}" width="50">
                                    <img src="{{ asset('storage/'.$gallery->image3) }}" width="50">
                                </td>
                                <td class="border p-2">
                                    <button onclick="editGallery({{ $gallery->id }})" class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</button>
                                    @if(auth()->user() && auth()->user()->isAdmin()) 
                                    <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
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

                <div class="mt-4">{{ $galleries->links() }}</div>
            </div>

            <!-- ADD GALLERY MODAL -->
            <div id="addGalleryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Add New Gallery</h2>
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4"><label class="block">Title 1</label><input type="text" name="title1" class="w-full p-2 border rounded"></div>
                        <div class="mb-4"><label class="block">Title 2</label><input type="text" name="title2" class="w-full p-2 border rounded"></div>
                        <div class="mb-4"><label class="block">Title 3</label><input type="text" name="title3" class="w-full p-2 border rounded"></div>
                        
                        <div class="mb-4"><label class="block">Image 1</label><input type="file" name="image1" class="w-full p-2 border rounded"></div>
                        <div class="mb-4"><label class="block">Image 2</label><input type="file" name="image2" class="w-full p-2 border rounded"></div>
                        <div class="mb-4"><label class="block">Image 3</label><input type="file" name="image3" class="w-full p-2 border rounded"></div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Gallery</button>
                        <button type="button" onclick="closeModal('addGalleryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
            </div>
            
            

            <!-- EDIT GALLERY MODAL -->
            <div id="editGalleryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit Gallery</h2>
                    <form action="" method="POST" id="editGalleryForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
            
                        <input type="hidden" name="id" id="edit_gallery_id">
            
                        <div class="mb-4">
                            <label class="block">Title 1</label>
                            <input type="text" name="title1" id="edit_title1" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block">Title 2</label>
                            <input type="text" name="title2" id="edit_title2" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block">Title 3</label>
                            <input type="text" name="title3" id="edit_title3" class="w-full p-2 border rounded">
                        </div>
            
                        <!-- Image Upload Fields with Preview -->
                        <div class="mb-4">
                            <label class="block">Image 1</label>
                            <img id="edit_image1_preview" src="" class="w-24 h-24 object-cover mb-2" />
                            <input type="file" name="image1" id="edit_image1" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block">Image 2</label>
                            <img id="edit_image2_preview" src="" class="w-24 h-24 object-cover mb-2" />
                            <input type="file" name="image2" id="edit_image2" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block">Image 3</label>
                            <img id="edit_image3_preview" src="" class="w-24 h-24 object-cover mb-2" />
                            <input type="file" name="image3" id="edit_image3" class="w-full p-2 border rounded">
                        </div>
            
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Gallery</button>
                        <button type="button" onclick="closeModal('editGalleryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
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
