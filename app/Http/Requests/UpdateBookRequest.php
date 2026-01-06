<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
        // id الكتاب من الراوت
        $bookId = $this->route('book');
        // إذا اسم الراوت مختلف (مثلاً books)، عدلو

        return [
            'ISBN' => [
                'required',
                'string',
                'size:13',
                Rule::unique('books', 'ISBN')->ignore($bookId),
            ],

            'title' => 'required|string|max:70',

            'price' => 'sometimes|numeric|min:0|max:99.99',

            'mortgage' => 'sometimes|numeric|min:0|max:9999.99',

            'authorship_date' => 'sometimes|date',

            'category_id' => 'required|exists:categories,id',
        ];
    }
}
