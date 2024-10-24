<?php

namespace App\Http\Requests\Backend\CourseManagement;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseCategoryFormRequest extends FormRequest
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
            'slug'  => 'required',
            'parent_id' => '',
            'note'  => 'required',
            'icon'  => '',
            'image' => 'nullable|image',
            'meta_title'    => '',
            'meta_description'  => '',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            throw new HttpResponseException(response()->json([
                'status'   => 'error',
//                'success'   => false,
//                'message'   => 'Validation errors',
                'errors'      => $validator->errors()
            ]));
        } else {
            parent::failedValidation($validator); // TODO: Change the autogenerated stub
        }
    }
}
