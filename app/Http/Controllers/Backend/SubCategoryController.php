<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SubCategoryStoreRequest;
use App\Http\Requests\Backend\SubCategoryUpdateRequest;
use App\Http\Requests\Backend\SubSubCategoryStoreRequest;
use App\Http\Requests\Backend\SubSubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name_en')->get(); 
        $subCategories = SubCategory::latest()->get();

        return view('backend.category.sub_index', compact('subCategories', 'categories'));
    }

    public function store(SubCategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            SubCategory::create([
                'category_id' => $request->category_id,
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_name_vi' => $request->subcategory_name_vi,
                'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'subcategory_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->subcategory_name_vi)),
            ]);

            $notification = [
                'message' => 'Sub Category Created Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Category Created Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function edit($id)
    {
        $categories = Category::orderBy('category_name_en')->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.category.sub_edit', compact('subcategory', 'categories'));
    }

    public function update(SubCategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            SubCategory::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_name_vi' => $request->subcategory_name_vi,
                'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'subcategory_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->subcategory_name_vi)),
            ]);

            $notification = [
                'message' => 'Sub Category Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('all.subcategory')->with($notification);
            
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Category Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            SubCategory::findOrFail($id)->delete();
            DB::commit();

            return redirect()->back()->with([
                'message' => ' Sub Category Deleted Successfully',
                'alert-type' => 'success',
            ]); 
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Category Deleted Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function subIndex()
    {
        $categories = Category::orderBy('category_name_en')->get(); 
        $subsubCategories = SubSubCategory::latest()->get();

        return view('backend.category.sub_sub_index', compact('subsubCategories', 'categories'));
    }

    public function getSubCategoryJson($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)->orderBy('subcategory_name_en')->get();

        return response()->json($subCategories);
    }

    public function subStore(SubSubCategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            SubSubCategory::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_name_vi' => $request->subsubcategory_name_vi,
                'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
                'subsubcategory_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->subsubcategory_name_vi)),
            ]);

            $notification = [
                'message' => 'Sub Sub Category Created Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Sub Category Created Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function subEdit($id)
    {
        $categories = Category::orderBy('category_name_en')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_sub_edit', compact('subcategories', 'categories', 'subsubcategory'));
    }

    public function subUpdate(SubSubCategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            SubSubCategory::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_name_vi' => $request->subsubcategory_name_vi,
                'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
                'subsubcategory_slug_vi' => mb_strtolower(str_replace(' ', '-', $request->subsubcategory_name_vi)),
            ]);

            $notification = [
                'message' => 'Sub Sub Category Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('all.subsubcategory')->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Sub Category Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function subDestroy($id)
    {
        DB::beginTransaction();
        try {
            SubSubCategory::findOrFail($id)->delete();
            DB::commit();

            return redirect()->back()->with([
                'message' => 'Sub Sub Category Deleted Successfully',
                'alert-type' => 'success',
            ]); 
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Sub Sub Category Deleted Failure',
                'alert-type' => 'error',
            ]);
        }
    }
}
