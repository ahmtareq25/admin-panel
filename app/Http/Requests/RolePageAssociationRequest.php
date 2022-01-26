<?php

namespace App\Http\Requests;


class RolePageAssociationRequest extends BaseRequest
{

    public function rules()
    {
        if (!request()->isMethod('get')){

            $rules['role_id'] = 'required|gt:0';
            $rules['page_ids'] = 'required|array';
            return $rules;

        }
        return [];
    }

}
