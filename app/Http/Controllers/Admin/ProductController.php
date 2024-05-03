<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::select('id' ,'name', 'category_id', 'price')->latest()->get();

        return view('pages.admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::select('id', 'name')->latest()->get();

        return view('pages.admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
            "category_id" => 'required',
            "price" => 'required',
            "description" => 'required'
        ]);

        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);

            Product::create($data);

            return redirect()->route('admin.product.index')->with('success', 'Product Has Been Successfully Added');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Failed To Added Product');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $category = Category::select('id', 'name')->latest()->get();

        return view('pages.admin.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            "name" => 'required',
            "category_id" => 'required',
            "price" => 'required',
            "description" => 'required'
        ]);

        try {
            $product = Product::find($id);

            $data = $request->all();
            $data['slug'] = Str::slug($request->name);

            $product->update($data);

            return redirect()->route('admin.product.index')->with('success', 'Product Has Been Successfully Edited');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.product.index')->with('error', 'Failed To Edited Product');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            $product->delete();

            return redirect()->back()->with('success', "Product Has Been Successfully Deleted");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Failed To Delete Product");
        }
    }
}
