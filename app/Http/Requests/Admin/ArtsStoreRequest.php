<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ArtsStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' =>['required','image','max:3000'],
            'thb_image' =>['required','image','max:3000'],
            'title' =>['required','string','max:255','unique:arts,title'],
            'category' =>['required','integer'],
            'location' =>['required','integer'],
            'address' => ['required','string','max:255'],
            'phone' => ['required','string','max:10'],
            'email' => ['required','email','max:255'],
            'website' => ['url','nullable'],
            'fb_link' => ['url','nullable'],
            'x_link' => ['url','nullable'],
            'insta_link' => ['url','nullable'],
            'attachment' =>['mimes:png,jpg,pdf,jpeg','nullable','max:10000'],
            'amenities.*' =>['integer','nullable'],
            'description' =>['nullable'],
            'google_map'=> ['nullable'],
            'seo_title' => ['nullable','string','max:255'],
            'seo_description' => ['nullable','string','max:255'],
            'status' => ['required','boolean'],
            'is_featured' => ['required','boolean'],
            'is_verified' => ['required','boolean']
        ];
    }
}
