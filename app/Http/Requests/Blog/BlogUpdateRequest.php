<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BlogUpdateRequest extends FormRequest
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
            'catNames' => 'required|string|max:' . config('global.catNameLength'),
            'title' => 'required|string|max:' . config('global.titleLength'),
            'image' => 'sometimes|required|image|max:' . config('global.imageSize'),
            'content' => 'required|string|max:' . config('global.contentLength'),
        ];
    }
}
