<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if (request()->method() == 'POST') {
            return [
                'title' => 'required|max:250',
                'short_text' => 'required|max:250',
                'text' => 'required',
                'post_category_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp',
                'slug' => 'required|max:250|unique:posts',
            ];
        }
        return [
            'title' => 'required|max:250',
            'short_text' => 'required|max:250',
            'text' => 'required',
            'post_category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp',
            'slug' => 'required|max:250',
        ];
    }
}
