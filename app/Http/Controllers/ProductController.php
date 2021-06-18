<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::limit(6)->get();
        foreach ($products as $product) {
            $product->images = Image::where('product_id', $product->id)->get();
        }
        return view('pages.home', ['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }

    public function filter(Request $request)
    {
        $categories = $request->input('categories');
        $brands = $request->input('brands');
        $price = $request->input('price');

        $category_ids = [];
        $brand_ids = [];

        if(isset($categories) && isset($brands)){
            foreach ($categories as $category) {
                array_push($category_ids, intval($category));
            }
            foreach ($brands as $brand) {
                array_push($brand_ids, intval($brand));
            }
            $products = Product::whereBetween('price', $price)
            ->whereIn('category_id', $category_ids)->whereIn('brand_id', $brand_ids)->get();
        }elseif(isset($categories)){
            foreach ($categories as $category) {
                array_push($category_ids, intval($category));
            }
            $products = Product::whereBetween('price', $price)
                ->whereIn('category_id', $category_ids)->get();
        }elseif(isset($brands)){
            foreach ($brands as $brand) {
                array_push($brand_ids, intval($brand));
            }
            $products = Product::whereBetween('price', $price)
            ->whereIn('brand_id', $brand_ids)->get();
        }else {
            $products = Product::whereBetween('price', $price)->get();
        }
        foreach ($products as $product) {
            $product->images = Image::where('product_id', $product->id)->get();
        }
        return response()->json($products);
    }

    public function cart(Request $request) {
        $ids = $request->input('cart');
        try {
            $products = Product::whereIn('id', $ids)->get();
            foreach ($products as $product){
                $product->image = Image::where('product_id', $product->id)->first();
            }
        } catch (\Error $error){
            return response()->json(['error' => $error->getMessage()]);
        }
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('pages.add-product', ['categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $price = intval($request->input('price'));
        $description = $request->input('description');
        $category_id = $request->input('category_id');
        $brand_id = $request->input('brand_id');
        $quantity = 0;

        $product = Product::create([
           'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id,
            'brand_id' => $brand_id,
            'quantity' => 0
        ]);

        $product_id = $product->id;

        $files = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
                $path = $file->store('product_images', 'public');
                Image::create([
                   'name' => $path,
                   'product_id' => $product_id
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::find($id);
        $product->images = Image::where('product_id', $id)->get();
        return view('pages.product', ['product' => $product, 'categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
