<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.create', compact('categories', 'brands'));
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $image = $request->file('product_thumnail');
            $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $saveUrl = 'upload/products/thumbnail/' . $nameGenerate;
            Image::make($image)->resize(917, 1000)->save($saveUrl);

            $product = Product::create([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_vi' => $request->product_name_vi,
                'product_slug_en' => mb_strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->product_name_vi)),
                'product_code' => $request->product_code,
                'product_quanlity' => $request->product_quanlity,
                'product_tags_en' => $request->product_tags_en,
                'product_tags_vi' => $request->product_tags_vi,
                'product_size_en' => $request->product_size_en,
                'product_size_vi' => $request->product_size_vi,
                'product_color_en' => $request->product_color_en,
                'product_color_vi' => $request->product_color_vi,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_description_en' => $request->short_description_en,
                'short_description_vi' => $request->short_description_vi,
                'long_description_en' => $request->long_description_en,
                'long_description_vi' => $request->long_description_vi,
                'product_thumnail' => $saveUrl,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'status' => 1,
            ]);

            // Upload multiple image
            $multiImage = $request->file('multi_image');

            foreach ($multiImage as $image) {
                $multiNameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $saveMultiUrl = 'upload/products/multi-image/' . $multiNameGenerate;
                Image::make($image)->resize(917, 1000)->save($saveMultiUrl);

                ImageProduct::insert([
                    'product_id' => $product->id,
                    'photo_name' => $saveMultiUrl,
                    'created_at' => Carbon::now(),
                ]);
            }

            DB::commit();

            return redirect()->route('product.index')->with([
                'message' => 'Product Insert Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Product Insert Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function index()
    {
        $products = Product::latest()->get();

        return view('backend.product.index', compact('products'));
    }

    public function edit($id)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subsubCategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);

        return view('backend.product.edit', compact('categories', 'brands', 'subCategories', 'subsubCategories', 'product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            Product::findOrFail($id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_vi' => $request->product_name_vi,
                'product_slug_en' => mb_strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->product_name_vi)),
                'product_code' => $request->product_code,
                'product_quanlity' => $request->product_quanlity,
                'product_tags_en' => $request->product_tags_en,
                'product_tags_vi' => $request->product_tags_vi,
                'product_size_en' => $request->product_size_en,
                'product_size_vi' => $request->product_size_vi,
                'product_color_en' => $request->product_color_en,
                'product_color_vi' => $request->product_color_vi,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_description_en' => $request->short_description_en,
                'short_description_vi' => $request->short_description_vi,
                'long_description_en' => $request->long_description_en,
                'long_description_vi' => $request->long_description_vi,
                // 'product_thumnail' => $saveUrl,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'status' => 1,
            ]);

            DB::commit();

            return redirect()->route('product.index')->with([
                'message' => 'Product Updated Without Image Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Product Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }
}
