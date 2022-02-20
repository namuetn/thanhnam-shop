<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandStoreRequest;
use App\Http\Requests\Backend\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.index', compact('brands'));
    }

    public function store(BrandStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $image = $request->file('image');
            $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $saveUrl = 'upload/brand/' . $nameGenerate;
            Image::make($image)->resize(300, 300)->save($saveUrl);

            Brand::insert([
                'name_en' => $request->name_en,
                'name_vi' => $request->name_vi,
                'slug_en' => strtolower(str_replace(' ', '-', $request->slug_en)),
                'slug_vi' => strtolower(str_replace(' ', '-', $request->slug_vi)),
                'image' => $saveUrl,
            ]);

            $notification = [
                'message' => 'Brand Created Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Brand Created Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('backend.brand.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        $oldImage = $request->old_image;

        DB::beginTransaction();

        try {
            $image = $request->file('image');
            if ($image) {
                $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $saveUrl = 'upload/brand/' . $nameGenerate;
                Image::make($image)->resize(300, 300)->save($saveUrl);
            }

            Brand::findOrFail($id)->update([
                'name_en' => $request->name_en,
                'name_vi' => $request->name_vi,
                'slug_en' => strtolower(str_replace(' ', '-', $request->slug_en)),
                'slug_vi' => strtolower(str_replace(' ', '-', $request->slug_vi)),
                'image' => $image ? $saveUrl : $oldImage,
            ]);

            $image ? unlink($request->old_image) : '';

            $notification = [
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('all.brand')->with($notification);
            
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Brand Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $brand = Brand::findOrFail($id);
            unlink($brand->image);
            $brand->delete();
            DB::commit();

            return redirect()->back()->with([
                'message' => 'Brand Deleted Successfully',
                'alert-type' => 'success',
            ]); 
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Brand Deleted Failure',
                'alert-type' => 'error',
            ]);
        }
        
    }
}
