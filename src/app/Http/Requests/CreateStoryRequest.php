<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoryRequest extends FormRequest
{
    /**
     * Определяет, может ли пользователь делать этот запрос
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Возвращает, правила валидации
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'tags'    => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Заголовок обязателен для заполнения.',
            'title.max'        => 'Заголовок не должен превышать 255 символов.',
            'content.required' => 'Текст истории обязателен.',
            'tags.string'      => 'Поле тегов должно быть текстом.',
        ];
    }
}
