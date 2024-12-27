<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $authorId = $this->route('author')?->id;

        return [
            'full_name' => [
                'required',
                'string',
                $authorId
                    ? 'unique:authors,full_name,' . $authorId
                    : 'unique:authors,full_name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'O campo Nome Completo é obrigatório.',
            'full_name.unique'   => 'O nome do autor já está cadastrado.',
        ];
    }
}
