<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'catNames' => 'required|json|max:' . config('global.catNameLength'),
            'title' => 'required|string|max:' . config('global.titleLength'),
            'image' => 'sometimes|required|image|max:' . config('global.imageSize'),
            'amount' => 'required|string|max:' . config('global.integerDefaultLength'),
            'qty' => 'required|string|max:' . config('global.integerDefaultLength'),
            'content' => 'required|string|max:' . config('global.contentLength'),
            'phone' => 'required|string|max:' . config('global.phoneLength'),
            'city' => 'required|json|max:' . config('global.cityLength'),
            'address' => 'required|string|max:' . config('global.stringDefaultLength'),
        ];
    }
}
