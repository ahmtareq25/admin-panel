<?php

namespace App\Http\Requests;

use App\Traits\CommonResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
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

            if (request()->routeIs(config('routename.ROLE_EDIT'))){
                $rules['name'] = 'required|min:5|max:100|unique:roles,name,'.$this->id;

            }else{
                $rules['name'] = 'required|min:5|max:100|unique:roles,name';
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
                $this->routeIs(config('routename.ROLE_EDIT')) ? 'ROLE UPDATE' :'ROLE ADD' );

        }else{
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }


    }
}
