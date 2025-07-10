<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */

    public function rules() {
        return [
            'first_name' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'last_name' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'email' => $this->isMethod('POST')
                ? 'required|email:rfc,dns|max:255|unique:users,email'
                : 'sometimes|email:rfc,dns|max:255|unique:users,email,' . $this->route('passenger'),
            'password' => $this->isMethod('POST') ? 'required|string|min:5' : 'sometimes|string|min:5',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Invalid input',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );
    }
}
