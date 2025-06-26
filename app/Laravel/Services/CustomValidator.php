<?php

namespace App\Laravel\Services;

use App\Laravel\Models\{User,Category,Page};

use Illuminate\Validation\Validator;

use Hash;

class CustomValidator extends Validator
{
    public function validateUsernameFormat($attribute, $value, $parameters)
    {
        return preg_match(("/^(?=.*)[A-Za-z\d][a-z\d._+]{6,20}$/"), $value);
    }

    public function validatePasswordFormat($attribute, $value, $parameters)
    {
        return preg_match(("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{8,}$/"), $value);
    }

    public function validateUniqueUsername($attribute, $value, $parameters)
    {
        $account_id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "";
        $account_type = (is_array($parameters) and isset($parameters[1])) ? $parameters[1] : "user";
        $username = strtolower($value);

        switch (strtolower($account_type)) {
            case '':
               
                break;
            default:
                return User::whereRaw("LOWER(username) = '{$username}'")
                    ->where('id', '<>', $account_id)
                    ->count() ? false : true;
                
                break;
        }
    }

    public function validateUniqueEmail($attribute, $value, $parameters)
    {
        $email = strtolower($value);
        $id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "0";
        $type = (is_array($parameters) and isset($parameters[1])) ? $parameters[1] : "user";

        switch (strtolower($type)) {
            case '':

                break;
            default:
                return  User::where('email', $email)
                    ->where('id', '<>', $id)
                    ->count() ? false : true;

                break;
        }
    }

    public function validateUniqueCategory($attribute, $value, $parameters)
    {
        $category = strtoupper($value);
        $id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "0";

        return Category::where('name', $category)->where('id', '<>', $id)->count() ? false : true;
    }

    public function validateUniquePage($attribute, $value, $parameters)
    {
        $page = strtolower($value);
        $id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "0";

        return Page::where('page', $page)->where('id', '<>', $id)->count() ? false : true;
    }

    public function validateCurrentPassword($attribute, $value, $parameters)
    {
        $account_id   = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "";
        $account_type = (is_array($parameters) and isset($parameters[1])) ? $parameters[1] : "user";

        switch (strtolower($account_type)) {
            case '':

                break;
            default:
                $user = User::find($account_id);

                return Hash::check($value, $user->password);

                break;
        }
    }

    
    public function validateIsNewPassword($attribute, $value, $parameters)
    {
        $account_id   = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "";
        $account_type = (is_array($parameters) and isset($parameters[1])) ? $parameters[1] : "user";

        switch (strtolower($account_type)) {
            case '':

                break;
            default:
                $user = User::find($account_id);

                return !Hash::check($value, $user->password);

                break;
        }
    }
}
