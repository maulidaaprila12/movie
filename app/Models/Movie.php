<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Movie extends Model
{
    protected $fillable = [
        'id',
        'judul',
        'category_id',
        'sinopsis',
        'tahun',
        'pemain',
        'foto_sampul',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}