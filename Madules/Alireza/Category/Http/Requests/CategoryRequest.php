<?php

namespace Alireza\Category\Http\Requests;

use Alireza\Category\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() === true;
    }


    public function rules()
    {
        $rules = [
            'parent_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|min:3|max:190|unique:categories,id',
            'keywords'=> 'nullable|string|min:3|max:255',
            'description' => 'nullable|string|min:3',
            'status' => ['required', 'string', Rule::in(Category::$statuses)],
        ];
        if (request()->method === 'PATCH'){
            $rules['title'] = 'required|string|min:3|max:190|unique:categories,id' . request();
        }
        return $rules;
    }
}
