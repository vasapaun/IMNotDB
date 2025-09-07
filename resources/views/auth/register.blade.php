@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Register</h1>

    @if($errors->any())
        <div class="text-red-500 mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name" class="border p-2 w-full" required>
        <input type="email" name="email" placeholder="Email" class="border p-2 w-full" required>
        <input type="password" name="password" placeholder="Password" class="border p-2 w-full" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="border p-2 w-full" required>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Register</button>
    </form>
@endsection
