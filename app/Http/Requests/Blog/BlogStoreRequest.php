<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'catName' => 'required|string|max:' . config('global.catNameLength'),
            'title' => 'required|string|max:' . config('global.titleLength'),
            'image' => 'required|image|max:' . config('global.imageLength'),
            'content' => 'required|string|max:' . config('global.contentLength'),
        ];
    }

}
