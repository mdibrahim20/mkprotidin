<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Management</title>
    <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
 

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64">
            @include('dashboard.nav')
            <header class="bg-white shadow-md rounded-lg p-4 mb-6">
                <h1 class="text-xl font-semibold">Comment Management</h1>
            </header>

            <!-- Comments Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Pending Comments</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">User</th>
                            <th class="border p-2">Article</th>
                            <th class="border p-2">Comment</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr class="text-center">
                                <td class="border p-2">{{ $comment->user->name ?? 'Anonymous' }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('admin.articles.index', ['id' => $comment->article->id]) }}" class="text-blue-500 underline">
                                        {{ $comment->article->title }}
                                    </a>
                                </td>
                                <td class="border p-2">{{ $comment->comment }}</td>
                                <td class="border p-2">
                                    <span class="{{ $comment->is_approved ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="border p-2">
                                    @if (!$comment->is_approved)
                                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded">Approve</button>
                                        </form>
                                    @endif
                                    @if(auth()->user() && auth()->user()->isAdmin()) 
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline">
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
                    {{ $comments->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
