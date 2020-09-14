<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Category;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['book'] = Book::all();
        return view('book.index', $data);
    }

    public function add()
    {
        $data['genre'] = Genre::all();
        $data['category'] = Category::all();
        return view('book.add-edit', ['edit' => false], $data);
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'total_page' => 'required',
            'rating' => 'required',
            'isbn' => 'required',
            'publisher' => 'required',
            'published_date' => 'required',
            'price' => 'required',
            'is_available' => 'required',
            'daterange' => 'required',
            'description' => 'required'
        ]);

        $data =  $request->except(['daterange', 'category', 'genre']);
        $available_date = explode('-', $request->daterange);
        $data['available_from'] = date_format(date_create($available_date[0]), 'Y-m-d');
        $data['available_until']= date_format(date_create($available_date[1]), 'Y-m-d');

        $insert_book = Book::create($data);
        $insert_book->category()->attach($request->category);
        $insert_book->genre()->attach($request->genre);

        return redirect()->route('book.index')->withSuccess('Book Added');
    }

    public function detail($id)
    {
        $data['book'] = Book::findOrFail($id);
        return view('book.detail', $data);
    }

    public function edit($id)
    {
        $data['book'] = Book::findOrFail($id);
        $data['genre'] = Genre::all();
        $data['category'] = Category::all();
        return view('book.add-edit', ['edit' => true], $data);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'total_page' => 'required|numeric',
            'rating' => 'required|numeric',
            'isbn' => 'required|numeric|min:10',
            'publisher' => 'required',
            'published_date' => 'required|date',
            'price' => 'required',
            'is_available' => 'required',
            'daterange' => 'required'
        ]);

        $data =  $request->except(['daterange', 'category', 'genre']);
        $available_date = explode('-', $request->daterange);
        $data['available_from'] = date('Y-m-d', strtotime($available_date[0]));
        $data['available_until']= date('Y-m-d', strtotime($available_date[1]));

        $update_book = Book::findOrFail($id);
        $update_book->category()->sync($request->category);
        $update_book->genre()->sync($request->genre);
        $update_book->update($data);

        return redirect()->route('book.index')->withSuccess('Book Updates');
    }

    public function delete($id)
    {
        $delete_book = Book::findOrFail($id);
        $delete_book->category()->detach();
        $delete_book->genre()->detach();
        $delete_book->delete();
        return redirect()->route('book.index')->withSuccess('Book Updates');
    }
}
