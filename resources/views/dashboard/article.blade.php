<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Script for showing modals
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
            <h2 class="text-2xl font-bold mb-6">News Dashboard</h2>
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
            <!-- Navbar -->
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Article Management</h1>
                <button onclick="openModal('addArticleModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Article</button>
            </header>

            <!-- Articles Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Articles</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Title</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Tags</th>
                            <th class="border p-2">Created At</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr class="text-center">
                                <td class="border p-2">{{ $article->title }}</td>
                                <td class="border p-2">{{ $article->category->name ?? "Null" }}</td>
                                <td class="border p-2">
                                    @foreach ($article->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last), @endif
                                    @endforeach
                                </td>
                                
                                <td class="border p-2">{{ $article->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border p-2">
                                    <button onclick="openModal('editArticleModal{{ $article->id }}')" class="bg-yellow-500 text-white px-4 py-1 rounded">Edit</button>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
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
                {{ $articles->links() }}
            </div>

            <!-- Add Article Modal -->
            <div id="addArticleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Add New Article</h2>
                    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf                    
                        <div class="mb-4">
                            <label for="title" class="block">Title</label>
                            <input type="text" name="title" id="title" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block">Content</label>
                            <textarea name="content" id="content" class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block">Category</label>
                            <select name="category_id" id="category_id" class="w-full p-2 border rounded">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tags" class="block">Tags</label>
                            <select name="tags[]" id="tags" class="w-full p-2 border rounded" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="block">Image</label>
                            <input type="file" name="image" id="image" class="w-full p-2 border rounded">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Article</button>
                        <button type="button" onclick="closeModal('addArticleModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Edit Article Modals -->
            @foreach ($articles as $article)
                <div id="editArticleModal{{ $article->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                        <h2 class="text-xl font-semibold mb-4">Edit Article: {{ $article->title }}</h2>
                        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <!-- Title Input -->
                            <div class="mb-4">
                                <label for="title" class="block">Title</label>
                                <input type="text" name="title" id="title" class="w-full p-2 border rounded" value="{{ old('title', $article->title) }}" required>
                            </div>
                        
                            <!-- Content Textarea -->
                            <div class="mb-4">
                                <label for="content" class="block">Content</label>
                                <textarea name="content" id="content" class="w-full p-2 border rounded" required>{{ old('content', $article->content) }}</textarea>
                            </div>
                        
                            <!-- Category Select -->
                            <div class="mb-4">
                                <label for="category_id" class="block">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-2 border rounded">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Tags Select (Multiple) -->
                            <div class="mb-4">
                                <label for="tags" class="block">Tags</label>
                                <select name="tags[]" id="tags" class="w-full p-2 border rounded" multiple>
                                    @foreach ($tags as $tag)
    <option value="{{ $tag->id }}" 
        {{ in_array($tag->id, (array) old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
        {{ $tag->name }}
    </option>
@endforeach


                                </select>
                            </div>
                        
                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="block">Image</label>
                                <input type="file" name="image" id="image" class="w-full p-2 border rounded">
                            </div>
                        
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Article</button>
                            <button type="button" onclick="history.back()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        </form>
                        
                    </div>
                </div>
            @endforeach
        </main>
    </div>
</body>
</html>
