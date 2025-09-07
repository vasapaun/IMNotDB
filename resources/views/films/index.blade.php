@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <form method="GET" action="{{ route('films.index.page') }}" class="mb-6 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search films..." class="border rounded px-3 py-2 flex-1">
        <select name="sort_by" class="border rounded px-3 py-2">
            <option value="">Sort by</option>
            <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>Rating</option>
            <option value="runtime" {{ request('sort_by') == 'runtime' ? 'selected' : '' }}>Runtime</option>
            <option value="year" {{ request('sort_by') == 'year' ? 'selected' : '' }}>Year</option>
        </select>
        <select name="direction" class="border rounded px-3 py-2">
            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Asc</option>
            <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Desc</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-400 rounded">Apply</button>
    </form>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach($films as $film)
            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-xl font-semibold">{{ $film->title }}</h2>
                <p class="text-sm text-gray-600">Directed by {{ $film->director }} ({{ $film->year }})</p>
                <p class="mt-2 text-gray-700">{{ $film->description }}</p>
                <p class="mt-2 text-sm text-gray-500">Genres: {{ implode(', ', $film->genres ?? []) }}</p>
                <p class="mt-2 text-sm text-gray-500">Actors: {{ implode(', ' , $film->actors ?? []) }}</p>
                <p class="mt-2 text-sm text-gray-500">Runtime: {{ floor($film->runtime/60) }}h {{ $film->runtime%60 }}m </p>
                <p class="mt-2 font-bold">Rating: {{ $film->rating }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

