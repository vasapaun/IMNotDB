<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Filters\FilmFilter;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Film::query();

        $films = (new FilmFilter($request, $query))->apply()->get();

        return response()->json($films);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $film = Film::create($request->all());
        return response()->json($film, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        return response()->json($film);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $film->update($request->all());
        return response()->json($film);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return response()->json(null, 204);
    }

    public function search(Request $request){
        $query = Film::query();

        if($request->has('q')) {
            $words = preg_split("/\s+/", trim($request->q));

            foreach ($words as $word) {
                $query->where(function ($subquery) use ($word) {
                    $subquery->where('title', 'LIKE', "%$word%")
                        ->orWhere('description', 'LIKE', "%$word%")
                        ->orWhere('director', 'LIKE', "%$word%")
                        ->orWhere('genres', 'LIKE', "%$word%")
                        ->orWhere('actors', 'LIKE', "%$word%");
                });
            }
        }

        return response()->json($query->get());
    }
}
