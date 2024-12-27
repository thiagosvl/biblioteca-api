<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublisherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $publisherId = $this->route('publisher')?->id;

        return [
            'name' => [
                'required',
                'string',
                $publisherId
                    ? 'unique:publishers,name,' . $publisherId
                    : 'unique:publishers,name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.unique'   => 'A editora já está cadastrada.',
        ];
    }
}
