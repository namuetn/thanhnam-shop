<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.index', compact('brands'));
    }

    public function store(BrandStoreRequest $request)
    {
        # code...
    }
}
