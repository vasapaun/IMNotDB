<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FilmFilter {
    protected Request $request;
    protected Builder $query;

    public function __construct(Request $request, Builder $query) {
        $this->request = $request;
        $this->query = $query;
    }

    public function apply(): Builder
    {
        return $this
            ->filterByTitle()
            ->filterByGenres()
            ->filterByDescription()
            ->filterByDirector()
            ->filterByActors()
            ->filterByYear()
            ->filterByRuntime()
            ->filterByRating()
            ->applySorting()
            ->query;
    }

    protected function filterByTitle(): self {
        if($this->request->has('title')) {
            $this->query->where('title', 'like', '%'.$this->request->input('title').'%');
        }
        return $this;
    }

    protected function filterByGenres(): self {
        if($this->request->has('genre')) {
            $this->query->whereJsonContains('genres', $this->request->input('genre'));
        }
        return $this;
    }

    protected function filterByDescription(): self {
        if($this->request->has('description')) {
            $this->query->where('description', 'like', '%'.$this->request->input('description').'%');
        }
        return $this;
    }

    protected function filterByDirector(): self {
        if($this->request->has('director')) {
            $this->query->where('director', 'like', '%'.$this->request->input('director').'%');
        }
        return $this;
    }

    protected function filterByActors(): self {
        if($this->request->has('actor')) {
            $this->query->whereJsonContains('actors', $this->request->input('actor'));
        }
        return $this;
    }

    protected function filterByYear(): self {
        if($this->request->has('year')) {
            $this->query->where('year',$this->request->input('year'));
        }
        if($this->request->has('year_lt')) {
            $this->query->where('year', '<', $this->request->input('year_lt'));
        }
        if($this->request->has('year_gt')) {
            $this->query->where('year', '>', $this->request->input('year_gt'));
        }
        return $this;
    }

    protected function filterByRuntime(): self {
        if($this->request->has('runtime_lt')) {
            $this->query->where('runtime', '<', $this->request->input('runtime_lt'));
        }
        if($this->request->has('runtime_gt')) {
            $this->query->where('runtime', '>', $this->request->input('runtime_gt'));
        }
        return $this;
    }

    protected function filterByRating(): self {
        if($this->request->has('rating_lt')) {
            $this->query->where('rating','<',$this->request->input('rating_lt'));
        }
        if($this->request->has('rating_gt')) {
            $this->query->where('rating','>',$this->request->input('rating_gt'));
        }
        return $this;
    }

    protected function applySorting(): self {
        $sortBy = request()->input('sort_by', 'id');
        $direction = request()->input('direction', 'asc');

        if(in_array($sortBy,['year', 'runtime', 'rating'])) {
            $this->query->orderBy($sortBy, $direction);
        }
        return $this;
    }
}
