<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO Optimization</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
            <nav class="bg-gray-800 text-white p-4">
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.articles.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Articles</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Categories</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.seo.index') }}" class="block py-2 px-4 bg-gray-700 rounded">SEO Settings</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.ads.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Manage Ads</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.comments.index') }}" class="block py-2 px-4 bg-gray-700 rounded">
                            Comments
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('logout') }}" class="block py-2 px-4 rounded hover:bg-gray-700"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">SEO Optimization</h1>
                <button onclick="openModal('seoModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Edit SEO Settings</button>
            </header>

            <!-- SEO Settings Display -->
            <!-- SEO Settings Display -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Current SEO Settings</h2>
    <p><strong>Meta Title:</strong> {{ $settings?->meta_title ?? 'Not Set' }}</p>
    <p><strong>Meta Description:</strong> {{ $settings?->meta_description ?? 'Not Set' }}</p>
    <p><strong>Meta Keywords:</strong> {{ $settings?->meta_keywords ?? 'Not Set' }}</p>
    <p><strong>Canonical URL:</strong> {{ $settings?->canonical_url ?? 'Not Set' }}</p>
    <p><strong>OG Image:</strong>
        @if($settings?->og_image)
            <img src="{{ asset('storage/'.$settings->og_image) }}" class="mt-2 w-32">
        @else
            No Image Set
        @endif
    </p>
</div>


            <!-- SEO Modal -->
            <div id="seoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit SEO Settings</h2>
                    <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="meta_title" placeholder="Meta Title" value="{{ $settings->meta_title ?? '' }}" required class="w-full p-2 border rounded">
                        <textarea name="meta_description" placeholder="Meta Description" class="w-full p-2 border rounded">{{ $settings->meta_description ?? '' }}</textarea>
                        <input type="text" name="meta_keywords" placeholder="Meta Keywords" value="{{ $settings->meta_keywords ?? '' }}" class="w-full p-2 border rounded">
                        <input type="url" name="canonical_url" placeholder="Canonical URL" value="{{ $settings->canonical_url ?? '' }}" class="w-full p-2 border rounded">
                        <input type="file" name="og_image" class="w-full p-2 border rounded">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </form>
                    
                </div>
            </div>
        </main>
    </div>
</body>
</html>
