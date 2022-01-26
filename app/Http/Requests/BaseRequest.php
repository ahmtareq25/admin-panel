<?php

namespace App\Http\Requests;

use App\Traits\CommonResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    use CommonResponseTrait;

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
