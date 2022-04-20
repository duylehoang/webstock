<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required|unique:posts,title',
            'slug' => 'required|unique:posts,slug',
            'category_id' => 'required',
            'content' => 'required',
        ];

        $id = $this->route('id');
        if ($id) {
            $rules['title'] = 'required|unique:posts,title,' . $id;
            $rules['slug'] = 'required|unique:posts,slug,' . $id;
        } 

        return $rules;
    }
}
