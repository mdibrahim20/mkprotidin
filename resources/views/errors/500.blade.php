{{-- resources/views/errors/500.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>500 - Server Error</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500">500</h1>
        <p class="text-xl text-gray-700">Oops! Something went wrong on our servers.</p>
        <a href="{{ url()->previous() }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Go Back Home
        </a>
    </div>
</body>
</html>
