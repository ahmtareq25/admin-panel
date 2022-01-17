<?php

namespace App\Http\Requests;

use App\Traits\CommonResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RolePageAssociationRequest extends FormRequest
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

            $rules['role_id'] = 'required|gt:0';
            $rules['page_ids'] = 'required|array';
            return $rules;

        }
        return [];
    }
    protected function failedValidation(Validator $validator)
    {


        if ($this->wantsJson()){

            return $this->sendFailJsonResponse(config('BASIC_VALIDATION_FAILED.CODE'),
                config('BASIC_VALIDATION_FAILED.MESSAGE'), $validator->errors(),
                'ROLE PAGE ASSOCIATION');

        }else{
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }


    }
}
