<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'sometimes|required|string|max:255',
            'product_type' => 'sometimes|required|string|max:255',
            'product_brand' => 'sometimes|required|string|max:255',
            'product_price' => 'sometimes|required|numeric',
            'product_ingredient' => 'sometimes|required|string|max:255',
            'product_stock' => 'sometimes|required|integer',
            'category_id' => [
                'nullable',
                Rule::exists('categories','id')->where(function ($query){
                    $query->where('creator_id', Auth::id());
                })
            ],
        ];
    }
}
