<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $subjectId = $this->route('subject')?->id;

        return [
            'name' => [
                'required',
                'string',
                $subjectId
                    ? 'unique:subjects,name,' . $subjectId
                    : 'unique:subjects,name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.unique'   => 'O assunto já está cadastrado.',
        ];
    }
}
