<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['category'] = Category::all();
        return view('category.index', $data);
    }

    public function add()
    {
        return view('category.add-edit', ['edit' => false]);
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required'
        ]);
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index')->withSuccess('Category Added');
    }

    public function edit($id)
    {
         $data['category'] = Category::findOrFail($id);
        return view('category.add-edit', ['edit' => true], $data);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validateData = $request->validate([
            'category_name' => 'required'
        ]);
        $data = $request->all();
        $category->update($data);
        return redirect()->route('category.index')->withSuccess('Category Updated');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->withSuccess('Category Deleted');
    }
}
