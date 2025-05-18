{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500">404</h1>
        <p class="text-xl text-gray-700">Oops! The page you're looking for doesn't exist.</p>
        <a href="{{ url()->previous() }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Go Back Home
        </a>
    </div>
</body>
</html>
