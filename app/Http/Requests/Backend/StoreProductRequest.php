<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required|string|max:255',
            'product_name_vi' => 'required|string|max:255',
            // 'product_slug_en' => 'required|unique:products',
            // 'product_slug_vi' => 'required|unique:products',
            'product_code' => 'required',
            'product_quanlity' => 'required',
            'product_tags_en' => 'required',
            'product_tags_vi' => 'required',
            'product_size_en' => 'nullable',
            'product_size_vi' => 'nullable',
            'product_color_en' => 'required',
            'product_color_vi' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'nullable',
            'short_description_en' => 'required|string|max:1000',
            'short_description_vi' => 'required|string|max:1000',
            'long_description_en' => 'required|string|max:10000',
            'long_description_vi' => 'required|string|max:10000',
            'product_thumnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hot_deals' => 'nullable',
            'featured' => 'nullable',
            'special_offer' => 'nullable',
            'special_deals' => 'nullable',
            // 'status' => 'required',
            'multi_image' => 'required',
        ];
    }
}
