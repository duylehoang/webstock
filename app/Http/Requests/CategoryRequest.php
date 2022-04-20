<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug'
        ];

        $id = $this->route('id');
        if ($id) {
            $rules = [
                'name' => 'required|unique:categories,name,'.$id,
                'slug' => 'required|unique:categories,slug,'.$id
            ];
        } 
        return $rules;
    }
}
