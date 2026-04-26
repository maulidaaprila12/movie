<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Interfaces\MovieRepositoryInterface;

class MovieService
{
    protected $movieRepo;

    public function __construct(MovieRepositoryInterface $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    public function getAllMovies()
    {
        return $this->movieRepo->getAll();
    }

    public function getPaginatedMovies()
    {
        return $this->movieRepo->paginate();
    }

    public function getMovieById($id)
    {
        return $this->movieRepo->findById($id);
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function createMovie($request)
    {
        $data = $request->validate([
            'id' => 'required|string|max:255|unique:movies,id',
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
        $fileName = Str::uuid()->toString() . '.' . $fileExtension;

        $request->file('foto_sampul')->move(public_path('images'), $fileName);

        $data['foto_sampul'] = $fileName;

        return $this->movieRepo->create($data);
    }

    public function updateMovie($request, $id)
    {
        $movie = $this->movieRepo->findById($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto_sampul')) {
            $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
            $fileName = Str::uuid()->toString() . '.' . $fileExtension;

            $request->file('foto_sampul')->move(public_path('images'), $fileName);

            if ($movie->foto_sampul && File::exists(public_path('images/' . $movie->foto_sampul))) {
                File::delete(public_path('images/' . $movie->foto_sampul));
            }

            $data['foto_sampul'] = $fileName;
        }

        return $this->movieRepo->update($id, $data);
    }

    public function deleteMovie($id)
    {
        $movie = $this->movieRepo->findById($id);

        if ($movie->foto_sampul && File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        return $this->movieRepo->delete($id);
    }
}