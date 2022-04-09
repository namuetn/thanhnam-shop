<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SliderStoreRequest;
use App\Http\Requests\Backend\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        
        return view('backend.silder.index', compact('sliders'));
    }

    public function store(SliderStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $image = $request->file('slider_image');
            $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $saveUrl = 'upload/slider/' . $nameGenerate;
            Image::make($image)->resize(870, 370)->save($saveUrl);

            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'slider_image' => $saveUrl,
            ]);

            $notification = [
                'message' => 'Slider Created Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Slider Created Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.silder.edit', compact('slider'));
    }

    public function update(SliderUpdateRequest $request, $id)
    {
        $oldImage = $request->old_image;

        DB::beginTransaction();

        try {
            $image = $request->file('slider_image');
            if ($image) {
                $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $saveUrl = 'upload/slider/' . $nameGenerate;
                Image::make($image)->resize(870, 370)->save($saveUrl);
            }

            Slider::findOrFail($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_image' => $image ? $saveUrl : $oldImage,
            ]);

            $image ? unlink($oldImage) : '';

            $notification = [
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('slider.index')->with($notification);
            
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Slider Updated Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $slider = Slider::findOrFail($id);
            unlink($slider->slider_image);
            $slider->delete();
            DB::commit();

            return redirect()->back()->with([
                'message' => 'Slider Deleted Successfully',
                'alert-type' => 'success',
            ]); 
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Slider Deleted Failure',
                'alert-type' => 'error',
            ]);
        }
    }

    public function active($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        return redirect()->back()->with([
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function inactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        return redirect()->back()->with([
            'message' => 'Slider Active Successfully',
            'alert-type' => 'success',
        ]);
    }
}
