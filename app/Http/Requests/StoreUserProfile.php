<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfile extends FormRequest
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
            'name' => 'required|min:4|max:20',
            'email' =>'required|email|unique:users',
            'password' =>'required|same:confirm_password|min:8|max:10',
            'confirm_password' =>'required',
            'status' =>'required|numeric',
            'phone' => 'digits:10',
            'thumbnail' => 'mimes:png,jpeg|max:5120',
        ];
    }

    public function messages()
    {
        return [
            // 'name.regex' => 'Title is an Only Letter {A-a to Z-b}',
            'name.required' => 'Name is a Required Field.',
            'name.min' => 'User Name is 4 Letter',
            'name.max' => 'User Name Should not be Greater than 20 Letter',
            // 'slug.required'  => 'Slug is Required Field',
            'password.min' => 'Password Should be minimum 8 Characters',
            'password.max' => 'Password Should not be Greater than 10 Characters',
            'password.same' => 'Password Should be Match',
            // 'description.max' => 'Maximum Description is 255 Letter Only',
            // 'price.required' => 'Price is Required Field',
            // 'price.numeric' => 'Price is Only Number',
            // 'thumbnail.required'  => 'Photo is Required Field',
            'thumbnail.mimes' => 'Only Jpg,png Photo Allow',
            'thumbnail.max' => 'Photo Size Maximum 5MB',
            // 'category_id.required' => 'Atleast One Categories Have to Choose',
        ];
    }
}
