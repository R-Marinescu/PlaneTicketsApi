<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'iata_code' => $this->isMethod('POST') ? 'required|string|max:255|unique:airports,iata_code' : 'sometimes|string|max:255|unique:airports,iata_code',
            'country' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'city' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
        ];
    }

}
