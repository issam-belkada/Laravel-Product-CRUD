<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategorysController extends Controller
{
    public function index()
    {
        return view('category.category-list');
    }

    public function create()
    {
        return view('category.create-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,in-active',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
}
