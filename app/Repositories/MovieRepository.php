<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAll()
    {
        $query = Movie::latest();

        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                  ->orWhere('sinopsis', 'like', '%' . request('search') . '%');
        }

        return $query->paginate(6)->withQueryString();
    }

    public function paginate()
    {
        return Movie::latest()->paginate(10);
    }

    public function findById($id)
    {
        return Movie::findOrFail($id);
    }

    public function create(array $data)
    {
        return Movie::create($data);
    }

    public function update($id, array $data)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($data);

        return $movie;
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);

        return $movie->delete();
    }
}