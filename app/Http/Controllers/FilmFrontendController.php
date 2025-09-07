<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Film;

class FilmFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::query();

        if ($request->filled('q')) {
            $terms = preg_split('/\s+/', $request->input('q')); // split by spaces
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('title', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%")
                        ->orWhere('director', 'like', "%{$term}%")
                        ->orWhere('genres', 'like', "%{$term}%")
                        ->orWhere('actors', 'like', "%{$term}%");
                });
            }
        }

        if ($request->filled('sort_by') && $request->filled('direction')) {
            $query->orderBy($request->input('sort_by'), $request->input('direction'));
        }

        $films = $query->get();

        return view('films.index', compact('films'));
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {

        Film::create([
            'title' => $request->title,
            'genres' => isset($request->genres) ? explode(", ", $request->genres) : null,
            'description' => $request->description,
            'director' => $request->director,
            'actors' => isset($request->actors) ? explode(",", $request->actors) : null,
            'year' => $request->year,
            'runtime' => $request->runtime,
            'rating' => $request->rating,
        ]);

        return redirect()->route('films.index.page')->with('success', 'Film added successfully!');
    }

}

