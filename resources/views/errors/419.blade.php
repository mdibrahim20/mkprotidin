{{-- resources/views/errors/419.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>419 - Page Expired</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500">419</h1>
        <p class="text-xl text-gray-700">Your session has expired. Please refresh and try again.</p>
        <a href="{{ url()->previous() }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Go Back
        </a>
    </div>
</body>
</html>
