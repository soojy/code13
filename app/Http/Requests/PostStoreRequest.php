<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => [ 'required','string', 'max:500'],
            'video' => ['required', 'file', 'mimes:mp4'],
            'category_id' => ['required'],
        ];
    }
}
