<?php

namespace App\Http\Requests\Translator\Translation\Fruits;

use App\Rules\ImageMaliciousDetectionRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'language' => ['required', 'string'],

            'translated_title_1' => ['required', 'string', 'max:255'],
            'translated_heading_title_1' => ['required', 'string', 'max:255'],
            'translated_heading_description_1' => ['required', 'string', 'max:1000000'],

            'translated_title_2' => ['required', 'string', 'max:255'],
            'translated_heading_title_2' => ['required', 'string', 'max:255'],
            'translated_heading_description_2' => ['required', 'string', 'max:1000000'],

            'translated_title_3' => ['required', 'string', 'max:255'],
            'translated_heading_title_3' => ['required', 'string', 'max:255'],
            'translated_heading_description_3' => ['required', 'string', 'max:1000000'],

            'translated_status' => ['nullable', 'in:1,2'],

            'translated_images' => ['nullable', 'array'],
            'translated_images.*' => ['bail', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120', new ImageMaliciousDetectionRule],
        ];
    }

    public function messages()
    {
        return [
            "translated_images.*.required" => "The image :index should be an image.",
            "translated_images.*.image" => "The image :index should be jpeg,png,jpg,gif.",
        ];
    }
}
