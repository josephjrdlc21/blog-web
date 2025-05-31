<?php

namespace App\Laravel\Requests\Api\Backoffice;

use App\Laravel\Requests\ApiRequestManager;

class ProfileRequest extends ApiRequestManager
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
        $id = auth('backoffice')->user()->id ?? 0;

        $rules = [];

        if (request()->path() === 'api/backoffice/profile/edit'){    
            $rules = [
                'firstname' => "required",
                'middlename' => "nullable",
                'lastname' => "required",
                'suffix' => "nullable",
                'username' => "required|username_format|unique_username:{$id},user",
                'email' => "required|email:rfc,dns|unique_email:{$id},user",
                'image' => "nullable|mimes:png,jpg,jpeg|min:1|max:2048",
            ];
        }

        if (request()->path() === 'api/backoffice/profile/edit-password'){
            $rules = [
                'current_password' => "required|current_password:{$id},user",
                'password' => "required|confirmed|password_format|is_new_password:{$id},user",
                'password_confirmation' => "required",
            ];
        }

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
            'image.min' => "The file must be at least 1 KB.",
            'image.max' => "The file may not be greater than 2 MB.",
            'password_format' => "Password must contain at least 8 characters, including uppercase, lowercase, numbers, and special characters.",
        ];
    }
}