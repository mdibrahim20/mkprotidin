<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery Management</title>
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
                    document.getElementById('edit_video1').value = data.video1;

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
                <h1 class="text-xl font-semibold">Video Gallery Management</h1>
                <button onclick="openModal('addVideoGalleryModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Video</button>
            </header>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Videos</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Title 1</th>
                            <th class="border p-2">Videos</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videos as $video)
                            <tr class="text-center">
                                <td class="border p-2">{{ $video->title1 }}</td>

                                <td class="border p-2">
                                    <a href="{{ $video->video1 }}" target="_blank">{{ $video->video1 }}</a><br>

                                </td>
                                <td class="border p-2">
                                    <button onclick="editVideoGallery({{ $video->id }})" class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</button>
                                    @if(auth()->user() && auth()->user()->isAdmin()) 
                                    <form action="{{ route('admin.video-gallery.destroy', $video->id) }}" method="POST" style="display:inline;">
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
                <div class="mt-4">{{ $videos->links() }}</div>
            </div>
        </main>
                    <!-- ADD Video MODAL -->
                <div id="addVideoGalleryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Add New Video</h2>
                    <form action="{{ route('admin.video-gallery.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block">Title</label>
                            <input type="text" name="title1" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Video URL</label>
                            <input type="url" name="video1" class="w-full p-2 border rounded" placeholder="Enter YouTube/Vimeo URL" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Video</button>
                        <button type="button" onclick="closeModal('addVideoGalleryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
                </div>

                    
                    
            <!-- EDIT Video MODAL -->
            <div id="editVideoGalleryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                <h2 class="text-xl font-semibold mb-4">Edit Video</h2>
                <form action="" method="POST" id="editVideoGalleryForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="edit_video_id">

                    <div class="mb-4">
                        <label class="block">Title</label>
                        <input type="text" name="title1" id="edit_title" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Video URL</label>
                        <input type="url" name="video1" id="edit_video_url" class="w-full p-2 border rounded" placeholder="Enter YouTube/Vimeo URL" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Video</button>
                    <button type="button" onclick="closeModal('editVideoGalleryModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                </form>
            </div>
            </div>

    </div>
</body>
</html>
