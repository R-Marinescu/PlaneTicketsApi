<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightDestinationRequest extends FormRequest
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
            'airport' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'country' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'city' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
        ];
    }

}
