<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
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
            'title'             => ['nullable'],
            'description'       => ['nullable','string'],
            'price'             => ['nullable','numeric'],
            'image_file'        => ['nullable','image'],
            'menu_section_id'   => ['nullable','exists:menu_sections,id']
        ];
    }
}
