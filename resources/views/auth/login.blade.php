@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Login</h1>

    @if($errors->any())
        <div class="text-red-500 mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email" class="border p-2 w-full" required>
        <input type="password" name="password" placeholder="Password" class="border p-2 w-full" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>

        <a href="{{ route('register') }}"
        class="ml-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">
        Register
        </a>
    </form>
@endsection
