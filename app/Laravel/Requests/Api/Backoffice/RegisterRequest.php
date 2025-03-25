<?php

namespace App\Laravel\Requests\Api\Backoffice;

use App\Laravel\Requests\ApiRequestManager;

class RegisterRequest extends ApiRequestManager
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
            'username' => "required|username_format|unique_username:{$id},user",
            'email' => "required|email:rfc,dns|unique_email:{$id},user",
            'password' => "required|confirmed|password_format",
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
            'confirmed' => "Password mismatch.",
			'password_format' => "Password must be atleast 8 characters long, should contain atleast 1 uppercase, 1 lowercase, 1 numeric and 1 special character.",
        ];
    }
}