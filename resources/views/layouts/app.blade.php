<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IMNotDB')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
<nav class="bg-white shadow p-4 flex justify-between">
    <div>
        <a href="{{ route('films.index') }}" class="font-bold text-lg">IMNotDB</a>
    </div>
    <div>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400">Logout</button>
            </form>
            <form method="GET" action="{{ route('films.create') }}" class="inline">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">Add Film</button>
            </form>

        @else
            <a href="{{ route('login') }}" class="mr-4">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</nav>
<div class="container mx-auto p-6">
    @yield('content')
</div>
</body>
</html>
