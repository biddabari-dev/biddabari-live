<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required',
//            'email' => 'required|email',
            'password'  => 'required|min:5',
            'mobile'    => ['required', 'unique:users', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/']
//            'mobile'    => 'required|unique:users|regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'errors'      => $validator->errors()
            ]));
        } else {
            parent::failedValidation($validator); // TODO: Change the autogenerated stub
        }
    }
}
