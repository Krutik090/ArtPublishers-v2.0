<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon_image' => ['required','image','max:3000'],
            'bg_image' => ['required','image','max:3000'],
            'name' => ['required','string','max:255','uniqq'],
            'show_at_home' => ['required','boolean'],
            'status' => ['required','boolean']

        ];
    }
}
