<?php

namespace App\Http\Requests\UserRequest;

use App\Traits\CommonApiResponseTrait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserStoreRequest extends FormRequest
{
    use CommonApiResponseTrait;
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
        if (!request()->isMethod('get')){
            return [
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone_number' => 'required',
                'password' => 'required|confirmed|min:8'
            ];
        }
        return [];

    }

    protected function failedValidation(Validator $validator)
    {

        if (request()->wantsJson()){

            return $this->sendFailResponse(config('BASIC_VALIDATION_FAILED.CODE'),
                config('BASIC_VALIDATION_FAILED.MESSAGE'), $validator->errors(), 'USER ADD' );

        }else{
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }


    }
}
