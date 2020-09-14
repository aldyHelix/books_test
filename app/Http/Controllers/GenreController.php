<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['genre'] = Genre::all();
        return view('genre.index', $data);
    }

    public function add()
    {
        return view('genre.add-edit', ['edit' => false]);
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'genre_name' => 'required'
        ]);
        $data = $request->all();
        Genre::create($data);
        return redirect()->route('genre.index')->withSuccess('Genre Added');
    }

    public function edit($id)
    {
        $data['genre'] = Genre::findOrFail($id);
        return view('genre.add-edit', ['edit' => true], $data);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $validateData = $request->validate([
            'genre_name' => 'required'
        ]);
        $data = $request->all();
        $genre->update($data);
        return redirect()->route('genre.index')->withSuccess('Genre Updated');
    }

    public function delete($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('genre.index')->withSuccess('Genre Deleted');
    }
}
