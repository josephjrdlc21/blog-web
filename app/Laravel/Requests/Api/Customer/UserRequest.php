<?php

namespace App\Laravel\Requests\Api\Customer;

use App\Laravel\Requests\ApiRequestManager;

class UserRequest extends ApiRequestManager
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
            'firstname' => "required",
            'middlename' => "nullable",
            'lastname' => "required",
            'suffix' => "nullable",
            'type' => "required",
            'username' => "required|username_format|unique_username:{$id},user",
            'email' => "required|email:rfc,dns|unique_email:{$id},user",
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => "Field is required.",
            'email.email' => "Invalid email address.",
            'email.unique_email' => "Email address is already used.",
            'username.username_format' => "Invalid username format.",
            'username.unique_username' => "Username already used.",
        ];
    }
}