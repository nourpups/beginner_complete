<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsArticleRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required|min:3',
            'image' => 'nullable|image|max:2048', //dimensions:ratio=1/1
        ];
    }
}
