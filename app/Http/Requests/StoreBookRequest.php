<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookId = $this->route('book')?->id;

        return [
            'title' => 'required',
            'classification' => 'required',
            'shelf' => 'required',
            'country' => 'required',
            'city' => 'required',
            'edition' => 'required',
            'quantity' => 'required|numeric',
            'language' => 'required',
            'page_count' => 'required|numeric',
            'year' => 'required|numeric',
            'isbn' => 'required',
            'entry_date' => 'required|date',
            'tomb_date' => 'required|date',
            'observations' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'book_type_id' => 'required',
            'subject_id' => 'required',
            'collection_id' => '',
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
