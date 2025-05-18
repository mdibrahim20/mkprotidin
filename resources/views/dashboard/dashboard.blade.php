<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Laravel Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
    

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64">
            <!-- Navbar -->
            @include('dashboard.nav')
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
                    <h2 class="text-xl font-semibold">Categories</h2>
                    <p class="text-2xl font-bold mt-2">{{ $totalCategories }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Views</h2>
                    <p class="text-2xl font-bold mt-2">{{ $totalViews }}</p>
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
