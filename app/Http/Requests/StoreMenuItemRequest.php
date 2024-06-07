<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'             => ['required'],
            'description'       => ['nullable','string'],
            'price'             => ['required','numeric'],
            'image_file'        => ['required','image'],
            'menu_section_id'   => ['required','exists:menu_sections,id']
        ];
    }
}
