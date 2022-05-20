<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'country_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Thông tin không được để trống',
            'name.min' => 'Thông tin nhập không nhỏ hơn 2 ký tự',
            'name.max' => 'Thông tin nhập không lớn hơn 255 ký tự',
            'avatar.image' => 'Phải là ảnh ',
            'avatar.mimes' => 'Ảnh phải là jpeg,jpg,png,gif',
            'avatar.max' => 'Kích thước ảnh nhỏ hơn 2048 kb',
            'country_id.required' => 'Thông tin không được để trống',
        ];
    }
}