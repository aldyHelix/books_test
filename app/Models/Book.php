<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title' , 'author', 'total_page', 'rating', 'isbn', 'publisher', 'available_from', 'available_until', 'published_date','price', 'is_available', 'description'];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'book_category', 'book_id', 'category_id');
    }

    public function genre()
    {
        return $this->belongsToMany('App\Models\Genre', 'book_genre', 'book_id', 'genre_id');
    }
}
