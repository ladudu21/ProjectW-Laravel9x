<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|string',
            'img' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => [
                Rule::unique('products', 'slug')->ignore($this->route('product')),
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Tên sản phẩm đã tồn tại',
        ];
    }
}
