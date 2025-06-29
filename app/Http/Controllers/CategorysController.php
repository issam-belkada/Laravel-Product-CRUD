<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategorysController extends Controller
{
    public function index()
    {
        $query = Category::query();
        if (request()->has('search') && request()->search) {
            $search = request()->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->latest()->paginate(7);

        return view('category.category-list', compact('categories'));
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

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit-category', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,in-active',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->status = $request->status;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function showDeletedCategories(Request $request)
{
    $query = Category::onlyTrashed();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', '%' . $search . '%');
    }

    $deletedCategories = $query->latest()->paginate(7);
    return view('category.deleted-categories', compact('deletedCategories'));
}


    public function destroy($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('show-deleted-categories')->with('success','category permanently deleted successfully.');
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('show-deleted-categories')->with('success', 'Category restored successfully.');
    }


    public function showCategoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $query = $category->products();
        $products = $query->latest()->paginate(7);
        return view('category.category-products', compact(['category', 'products']));
    }
        
}
