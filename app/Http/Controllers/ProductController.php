<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if(request()->has('search') && request()->search) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
        $products = $query->latest()->paginate(7);
        return view("product.product-list", compact("products"));
    }
    public function create()
    {
        $categories = Category::all();
        return view('product.create-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'Quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,in-active',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->Quantity = $request->Quantity;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        return view('product.show-product', compact('product'));
    }


    public function edit($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $categories = Category::all();
        return view('product.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'Quantity' => 'required|integer',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|in:active,in-active',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product = Product::withTrashed()->findOrFail($id);

    $product->name = $request->name;
    $product->description = $request->description;
    $product->Quantity = $request->Quantity;
    $product->price = $request->price;

    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    $product->status = $request->status;
    $product->category_id = $request->category_id;
    $product->save();

    if($product->deleted_at) {
        return redirect()->route('show-deleted-product')->with('success', 'Product updated successfully.');
    }
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


    public function showDeletedProducts(Request $request)
    {
        $query = Product::onlyTrashed();
    
        if ($request->has('search') && $request->search) {
            $search = $request->input('search');
    
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
    
        $deletedProducts = $query->latest()->paginate(7);
        return view('product.show-deleted-product', compact('deletedProducts'));
    }
    



    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('show-deleted-product')->with('success', 'Product restored successfully.');
    }


    public function destroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->forceDelete();
        return redirect()->route('show-deleted-product')->with('success', 'Product permanently deleted successfully.');
    }
}
