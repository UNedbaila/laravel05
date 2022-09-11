<?php

namespace App\Http\Requests;

use App\Rules\SeriaRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => '1234567890',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() // Правила валидации
    {
        return [
            'name' => 'required|min:3|max:5',
            'slug' => ['required',new SeriaRule()],
        ];
    }

    public function messages()  // позволяет редактировать, модифицировать сообщения при нарушении валидации
    {
        return [
            'name.min' => 'Поле :attribute не должно быть короче :min-х символов!',
            'name.required' => 'ОБЯЗАТЕЛЬНОЕ ПОЛЕ',
            'name.max' => 'НЕ БОЛЕЕ :max СИМВОЛОВ!!!'
        ];
    }
    public function  attributes()
    {
        return [
            'name' => 'НАЗВАНИЕ КАТЕГОРИИ'
        ];
    }
}
