<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'role_name' => $this->isMethod('POST') ? 'required|string|in:admin,passenger|max:255|unique:roles,role_name' : 'sometimes|string|in:admin,passenger|max:255|unique:roles,role_name,' . $this->route('role'),
        ];
    }
}
