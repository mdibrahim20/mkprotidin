<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Laravel Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-6">News Dashboard</h2>
            <nav class="bg-gray-800 text-white p-4">
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.articles.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Articles</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Categories</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.seo.index') }}" class="block py-2 px-4 rounded">SEO Settings</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.ads.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Manage Ads</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Manage Users</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.comments.index') }}" class="block py-2 px-4  rounded">
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
                <h1 class="text-xl font-semibold">Welcome, {{ auth()->user()->role }}</h1>
                <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </header>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Articles</h2>
                    <p class="text-2xl font-bold mt-2">{{ $totalArticles }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Active Users</h2>
                    {{-- <p class="text-2xl font-bold mt-2">{{ $activeUsers }}</p> --}}
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Categories</h2>
                    <p class="text-2xl font-bold mt-2">{{ $totalCategories }}</p>
                </div>
            </div>

            <!-- Recent Articles -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Recent Articles</h2>
                <ul>
                    @foreach($recentArticles as $article)
                        <li class="border-b py-2">
                            <a href="{{ url('articles/'.$article->slug) }}">
                                {{ $article->title }} ({{ $article->views }} views)
                            </a>
                        </li>
                    @endforeach
                </ul>
                
            </div>
        </main>
    </div>
</body>
</html>
