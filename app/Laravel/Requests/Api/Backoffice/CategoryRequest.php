<?php

namespace App\Laravel\Requests\Api\Backoffice;

use App\Laravel\Requests\ApiRequestManager;

class CategoryRequest extends ApiRequestManager
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
        $id = $this->id ?? 0;

        $rules = [
            'category' => "required|unique_category:{$id}"
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => "Field is required.",
            'unique_category' => "Category is already taken."
        ];
    }
}