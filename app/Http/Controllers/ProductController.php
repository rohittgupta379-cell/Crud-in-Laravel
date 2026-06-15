<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'desc')->get();

        return view('products.index', ['products' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric',
            'status' => 'required',
            // 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        dd();

        if ($validator->fails()) {
            return redirect(route('products.create'))
                ->withErrors($validator)
                ->withInput();
        }

        dd();

        $product = new Product;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time().'_'.$image->getClientOriginalName();
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
            $product->save();

        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $oldImage = $product->image;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // dd();
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // update fields
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;

        // image update
        if ($request->hasFile('image')) {

            // delete old image
            if (! empty($oldImage) && File::exists(public_path('uploads/products/'.$oldImage))) {
                File::delete(public_path('uploads/products/'.$oldImage));
            }

            // upload new image
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();

            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted successfully');
}
}
