<?php

namespace App\Http\Requests\Admin\Fruits;

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

            'title_1' => ['required', 'string', 'max:255'],
            'heading_title_1' => ['required', 'string', 'max:255'],
            'heading_description_1' => ['required', 'string', 'max:1000000'],

            'title_2' => ['required', 'string', 'max:255'],
            'heading_title_2' => ['required', 'string', 'max:255'],
            'heading_description_2' => ['required', 'string', 'max:1000000'],

            'title_3' => ['required', 'string', 'max:255'],
            'heading_title_3' => ['required', 'string', 'max:255'],
            'heading_description_3' => ['required', 'string', 'max:1000000'],

            'status' => ['nullable', 'in:1,2'],

            // 'status' => ['nullable' ,'regex:/^[0-9]*\.[0-9]+$/'],

            'images' => ['nullable', 'array'],
            'images.*' => ['bail', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120', new ImageMaliciousDetectionRule],

        ];
    }

    public function messages()
    {
        return [
            "images.*.required" => "The image :index should be an image.",
            "images.*.image" => "The image :index should be jpeg,png,jpg,gif.",
        ];
    }
}
