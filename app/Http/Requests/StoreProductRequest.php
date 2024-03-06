<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'product_brand' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_ingredient' => 'required|string|max:255',
            'product_stock' => 'required|integer',
            'category_id' => [
                'nullable',
                Rule::in(Auth::user()->memberships->pluck('id')),
                // exists('categories', 'id')->where(function ($query) {
                //     $query->where('creator_id', Auth::id());
                // }),
            ],
            //
        ];
    }
}
