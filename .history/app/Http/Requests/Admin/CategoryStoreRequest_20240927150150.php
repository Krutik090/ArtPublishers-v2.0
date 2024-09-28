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
            'name' => ['required','image','max:255'],
            'show_at_home' => ['required','],




        ];
    }
}
