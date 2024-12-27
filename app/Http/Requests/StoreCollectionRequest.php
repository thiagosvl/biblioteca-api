<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $collectionId = $this->route('collection')?->id;

        return [
            'name' => [
                'required',
                'string',
                $collectionId
                    ? 'unique:collections,name,' . $collectionId
                    : 'unique:collections,name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.unique'   => 'A coleção já está cadastrada.',
        ];
    }
}
