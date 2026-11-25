<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'          => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'author'         => ['sometimes', 'required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'published_year' => ['sometimes', 'required', 'integer', 'min:1800', 'max:' . date('Y')],
            'category_id'    => ['sometimes', 'required', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.min'            => 'El título debe tener al menos 3 caracteres.',
            'category_id.exists'   => 'La categoría seleccionada no existe.',
            'published_year.max'   => 'El año no puede ser posterior al año actual.',
        ];
    }
}
