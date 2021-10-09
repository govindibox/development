<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transaction extends FormRequest
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
        return [
            'name' => 'bail|required|max:25',
            'email' => 'bail|required|email',
            'mobile' => 'bail|required|numeric|regex:/[0-9]{10}/',
            'amount' => 'bail|required|regex:/^\d*(\.\d{2})?$/',
        ];
    }
}
