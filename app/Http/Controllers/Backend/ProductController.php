<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.create', compact('categories', 'brands'));
    }
}
