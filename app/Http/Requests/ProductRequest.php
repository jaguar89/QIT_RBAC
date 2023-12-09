<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
            'category_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $category = Category::find($value);

                    if ($category && $category->subcategories()->exists()) {
                        $fail("The category cannot have subcategories.");
                    }
                },
            ],
        ];
    }
}
