<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'content' => 'required|min:50',
            'image' => 'file|size:2, mimes:jpg,jpeg,png'
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'Название :attribute не должно быть короче :min символов',
            'name.max' => 'Название :attribute не должно быть длиннее :max символов',
            'name.required' => 'Обязательное поле для заполнения',
            'content.min' => 'Текст статьи не должнен быть меньше :min символов',
            'image.file' => 'Размер :attribute не должнен быть более 2-х Мегабайт',
            'image.mimes' => 'Неверный формат :attribute (допустимый формат файла: *.jpg, *.jpeg, *.png)'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'статьи',
            'image' => 'файла'
        ];
    }
}
