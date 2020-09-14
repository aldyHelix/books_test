<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Category;
use App\Models\User;
use App\Models\BookCategory;
use App\Models\BookGenre;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['category'] = Category::select('category_name')->pluck('category_name');
        $data['genre'] = Genre::select('genre_name')->pluck('genre_name');
        $data['book_category'] = BookCategory::select(\DB::raw("COUNT(*) as count"))
            ->groupBy('category_id')
            ->pluck('count');
        $data['book_genre'] = Genre::withCount('hasBook')->pluck('has_book_count', 'genre_name');
        return view('dashboard', $data);
    }
}
