<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookTypeId = $this->route('bookType')?->id;

        return [
            'name' => [
                'required',
                'string',
                $bookTypeId
                    ? 'unique:book_types,name,' . $bookTypeId
                    : 'unique:book_types,name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.unique'   => 'O tipo de livro já está cadastrado.',
        ];
    }
}
