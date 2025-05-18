<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Management</title>
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


        function openViewArticleModal(articleId) {
            console.log("Fetching article with ID:", articleId);

            fetch(`/admin/articles/${articleId}/json`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    console.log("Raw Response:", response);

                    if (!response.ok) {
                        return response.text().then(errorText => {
                            console.error("Error Response Body:", errorText);
                            throw new Error(`HTTP error! Status: ${response.status}, Message: ${errorText}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Fetched Data:", data);

                    document.getElementById('modalArticleTitle').innerText = data.title;
                    document.getElementById('modalArticleAuthor').innerText = data.author;
                    document.getElementById('modalArticleCategory').innerText = data.category;
                    document.getElementById('modalArticleContent').innerHTML = data.content;
                    document.getElementById('modalArticleTags').innerText = data.tags.join(', ');

                    openModal('viewArticleModal');
                })
                .catch(error => {
                    console.error('Error fetching article:', error);
                    alert("Error fetching article: " + error.message);
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
                <h1 class="text-xl font-semibold">Article Management</h1>
                <div>
                    <button onclick="openModal('addArticleModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add
                        New Article</button>
                    @can('approve-article')
                        <button onclick="openModal('pendingArticlesModal')"
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                            Pending Articles
                        </button>
                    @endcan


                </div>

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
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Created At</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr class="text-center">
                                <td class="border p-2">{{ $article->title }}</td>
                                <td class="border p-2">{{ $article->category->name ?? 'Null' }}</td>
                                <td class="border p-2">
                                    @foreach ($article->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border p-2">{{ ucfirst($article->status) }}</td>
                                <td class="border p-2">{{ $article->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border p-2">
                                    <button onclick="openModal('editArticleModal{{ $article->id }}')"
                                        class="bg-yellow-500 text-white px-4 py-1 rounded">
                                        Edit
                                    </button>

                                    @can('approve-article')
                                        <form action="{{ route('admin.articles.toggleStatus', $article->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="{{ $article->status === 'published' ? 'bg-red-500' : 'bg-green-500' }} text-white px-4 py-1 rounded">
                                                {{ $article->status === 'published' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $articles->links() }}
            </div>

            <!-- Add Article Modal -->
            <!--<div id="addArticleModal"-->
            <!--    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">-->
            <!--    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">-->
            <!--        <h2 class="text-xl font-semibold mb-4">Add New Article</h2>-->
            <!--        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">-->
            <!--            @csrf-->
            <!--            <div class="mb-4">-->
            <!--                <label for="title" class="block">Title</label>-->
            <!--                <input type="text" name="title" id="title" class="w-full p-2 border rounded"-->
            <!--                    required>-->
            <!--            </div>-->
            <!--            <div class="mb-4">-->
            <!--                <label for="content" class="block">Content</label>-->
            <!--                <textarea name="content" id="content" class="w-full p-2 border rounded" required></textarea>-->
            <!--            </div>-->
            <!--            <div class="mb-4">-->
            <!--                <label for="category_id" class="block">Category</label>-->
            <!--                <select name="category_id" id="category_id" class="w-full p-2 border rounded">-->
            <!--                    @foreach ($categories as $category)-->
            <!--                        <option value="{{ $category->id }}">{{ $category->name }}</option>-->
            <!--                    @endforeach-->
            <!--                </select>-->
            <!--            </div>-->
            <!--            <div class="mb-4">-->
            <!--                <label for="tags" class="block">Tags</label>-->
            <!--                <select name="tags[]" id="tags" class="w-full p-2 border rounded" multiple>-->
            <!--                    @foreach ($tags as $tag)-->
            <!--                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>-->
            <!--                    @endforeach-->
            <!--                </select>-->
            <!--            </div>-->

            <!--            <div class="mb-4">-->
            <!--                <label for="image" class="block">Image</label>-->
            <!--                <input type="file" name="image" id="image" class="w-full p-2 border rounded">-->
            <!--            </div>-->
            <!--            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Article</button>-->
            <!--            <button type="button" onclick="closeModal('addArticleModal')"-->
            <!--                class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>-->
            <!--        </form>-->
            <!--    </div>-->
            <!--</div>-->
            <div id="addArticleModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white p-4 md:p-6 rounded-lg shadow-md w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3">
        <h2 class="text-lg md:text-xl font-semibold mb-4">Add New Article</h2>
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block">Title</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block">Content</label>
                <textarea name="content" id="content" class="w-full p-2 border rounded" rows="8" required></textarea>
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
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full md:w-auto">
                Add Article
            </button>
            <button type="button" onclick="closeModal('addArticleModal')"
                class="bg-gray-500 text-white px-4 py-2 rounded w-full md:w-auto mt-2 md:mt-0 md:ml-2">
                Cancel
            </button>
        </form>
    </div>
</div>

            <!-- Pending Articles Modal -->
            <div id="pendingArticlesModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-2/3">
                    <h2 class="text-xl font-semibold mb-4">Pending Articles</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2">Title</th>
                                <th class="border p-2">Author</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($pendingArticles) === 0)
                                <p>No pending articles found.</p>
                                {{-- @dd($pendingArticles) --}}
                                {{-- @dd(auth()->user()->role) --}}
                            @else
                                @foreach ($pendingArticles as $article)
                                    <tr class="text-center">
                                        <td class="border p-2">{{ $article->title }}</td>
                                        <td class="border p-2">{{ $article->user->name }}</td>
                                        <td class="border p-2">
                                            <span class="text-yellow-500 font-bold">Pending</span>
                                        </td>
                                        <td class="border p-2">
                                            <button onclick="openViewArticleModal({{ $article->id }})"
                                                class="bg-blue-500 text-white px-4 py-1 rounded">
                                                View
                                            </button>

                                            @can('approve-article')
                                                <form action="{{ route('admin.articles.approve', $article->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-green-500 text-white px-4 py-1 rounded">Approve</button>
                                                </form>

                                                <form action="{{ route('admin.articles.deactivate', $article->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-1 rounded">Reject</button>
                                                </form>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    <button type="button" onclick="closeModal('pendingArticlesModal')"
                        class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
                </div>
            </div>


            <!-- View Article Modal -->
            <div id="viewArticleModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-1/2">
                    <h2 id="modalArticleTitle" class="text-xl font-semibold mb-4"></h2>
                    <p><strong>Author:</strong> <span id="modalArticleAuthor"></span></p>
                    <p><strong>Category:</strong> <span id="modalArticleCategory"></span></p>
                    <p><strong>Content:</strong></p>
                    <div id="modalArticleContent" class="p-4 border rounded bg-gray-100"></div>
                    <p class="mt-2"><strong>Tags:</strong> <span id="modalArticleTags"></span></p>

                    <button type="button" onclick="closeModal('viewArticleModal')"
                        class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
                </div>
            </div>



            <!-- Edit Article Modals -->
            @foreach ($articles as $article)
                <div id="editArticleModal{{ $article->id }}"
                    class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                        <h2 class="text-xl font-semibold mb-4">Edit Article: {{ $article->title }}</h2>
                        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title Input -->
                            <div class="mb-4">
                                <label for="title" class="block">Title</label>
                                <input type="text" name="title" id="title"
                                    class="w-full p-2 border rounded" value="{{ old('title', $article->title) }}"
                                    required>
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
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                                <input type="file" name="image" id="image"
                                    class="w-full p-2 border rounded">
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update
                                Article</button>
                            <button type="button" onclick="history.back()"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        </form>

                    </div>
                </div>
            @endforeach
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
