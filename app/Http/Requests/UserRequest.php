<?php

namespace App\Http\Requests;


class UserRequest extends BaseRequest
{

    public function rules()
    {
        if (!request()->isMethod('get')){
            $rules = [
                'name' => 'required|min:5|max:100',
                'phone_number' => 'required',
                'roles' => 'required|array|min:1',
                'email' => 'required|unique:users',
            ];

            if (request()->routeIs(config('routename.USER_EDIT'))){
                $rules['email'] = 'required|unique:users,email,'.$this->id;
                if (isset($this->password)){
                    $rules['password'] = 'required|confirmed|min:8';
                }
            }else{
                $rules['email'] = 'required|unique:users';
                $rules['password'] = 'required|confirmed|min:8';
            }
            return $rules;
        }
        return [];

    }


}
