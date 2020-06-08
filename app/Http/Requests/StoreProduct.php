<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreProduct extends FormRequest
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
            'title' => 'bail|regex:/(^[A-Za-z ]+$)+/|required|min:2|max:200',
            'slug' => 'bail|required|min:2|max:200',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            // 'discount_price' => 'numeric',
            'thumbnail' => 'required|mimes:png,jpeg|max:5120',
            'featured' => 'numeric',
            'status' => 'required|numeric',
            'category_id'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.regex' => 'Title is an Only Letter {A-a to Z-b}',
            'title.required' => 'Title is a Required Field.',
            'title.min' => 'Minimum Title is 2 Letter',
            'title.max' => 'Maximum Title is 200 Letter Only',
            'slug.required'  => 'Slug is Required Field',
            'slug.min' => 'Minimum Slug is 2 Letter',
            'slug.max' => 'Maximum Slug is 200 Letter Only',
            'description.required' => 'Description is Required Field',
            'description.max' => 'Maximum Description is 255 Letter Only',
            'price.required' => 'Price is Required Field',
            'price.numeric' => 'Price is Only Number',
            'thumbnail.required'  => 'Photo is Required Field',
            'thumbnail.mimes' => 'Only Jpg,png Photo Allow',
            'thumbnail.max' => 'Photo Size Maximum 5MB',
            'category_id.required' => 'Atleast One Categories Have to Choose',
        ];
    }
}
