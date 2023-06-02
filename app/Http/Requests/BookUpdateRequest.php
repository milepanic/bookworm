<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'google_id' => ['required', 'string', 'unique:books,google_id'],
            'title' => ['required', 'string', 'max:400'],
            'description' => ['string'],
            'published_at' => ['date'],
            'price' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'preview_link' => ['required', 'string', 'max:200'],
            'author_id' => ['integer', 'exists:authors,id'],
            'page_count' => ['integer'],
            'thumbnail' => ['required', 'string', 'max:400'],
            'language' => ['required', 'string', 'max:20'],
            'pdf' => ['string', 'max:100'],
        ];
    }
}
