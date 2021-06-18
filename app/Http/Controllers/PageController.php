<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function shop()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('pages.shop', ['categories' => $categories, 'brands' => $brands]);
    }
}
