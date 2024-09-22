<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable','image','max:2000'],
            'banner' => ['nullable','image','max:2000'],
            'name' => ['required','max:255'],
            'email' => ['required','max:255','email'],
            'phone' => ['required','max:50'],
            'address' => ['required','max:255'],
            'about' => ['max:300'],
            'website' => ['nullable','url'],
            'fb_link' => ['nullable','url'],
            'x_link' => ['nullable','url'],
            'in_link' => ['nullable','url'],
            'wp_link' => ['nullable','url'],
            'insta_link' => ['nullable','url']

        ];
    }
}
