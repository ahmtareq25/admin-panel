<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingRequest extends FormRequest
{
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
            return [
                'site_title' => 'required|min:5|max:100',
                'fav_icon' => 'required|image|mimes:jpeg,png,jpg|max:512',
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
        }
        return [];
    }
}
