<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryStoreRequest;
use App\Http\Requests\Backend\CategoryUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('backend.category.index', compact('categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::create([
                'category_name_en' => $request->category_name_en,
                'category_name_vi' => $request->category_name_vi,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->category_name_vi)),
                'category_icon' => $request->category_icon,
            ]);

            $notification = [
                'message' => 'Category Created Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Category Created Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('backend.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            Category::findOrFail($id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_vi' => $request->category_name_vi,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->category_name_vi)),
                'category_image' => $request->category_icon,
            ]);

            $notification = [
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('all.category')->with($notification);
            
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Category Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Category::findOrFail($id)->delete();
            DB::commit();

            return redirect()->back()->with([
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success',
            ]); 
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Category Deleted Failure',
                'alert-type' => 'error',
            ]);
        }
    }
}
