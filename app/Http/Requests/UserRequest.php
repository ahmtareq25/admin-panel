<?php

namespace App\Http\Requests;

use App\Traits\CommonResponseTrait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
{
    use CommonResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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

    protected function failedValidation(Validator $validator)
    {


        if ($this->wantsJson()){

            return $this->sendFailJsonResponse(config('BASIC_VALIDATION_FAILED.CODE'),
                config('BASIC_VALIDATION_FAILED.MESSAGE'), $validator->errors(),
                $this->routeIs(config('routename.USER_EDIT')) ? 'USER UPDATE' :'USER ADD' );

        }else{
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }


    }
}
