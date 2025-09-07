@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Film</h1>

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('films.store.page') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Title</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Director</label>
        <input type="text" name="director" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-semibold">Year</label>
        <input type="number" name="year" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border rounded p-2"></textarea>
    </div>

    <div>
        <label class="block font-semibold">Genres (comma separated)</label>
        <input type="text" name="genres" class="w-full border rounded p-2" placeholder="Action, Comedy, Sci-Fi">
    </div>

    <div>
        <label class="block font-semibold">Actors (comma separated)</label>
        <input type="text" name="actors" class="w-full border rounded p-2" placeholder="Chris Pratt, Zoe Saldana">
    </div>

    <div>
        <label class="block font-semibold">Runtime (minutes)</label>
        <input type="number" name="runtime" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block font-semibold">Rating</label>
        <input type="number" step="0.1" name="rating" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Add Film
    </button>
</form>
@endsection

