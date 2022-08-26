<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
                'name' => 'required|max:250',
                'slug' => 'required|max:250|unique:post_categories',
            ];
        }
        return [
            'name' => 'required|max:250',
            'slug' => 'required|max:250',
        ];
    }
}
