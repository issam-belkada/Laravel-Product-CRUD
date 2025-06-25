<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
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
}
