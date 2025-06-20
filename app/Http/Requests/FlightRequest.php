<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'flight_number' => $this->isMethod('POST') ? 'required|string|max:255' : 'sometimes|string|max:255',
            'origin_id' => $this->isMethod('POST') ? 'required|exists:flight_origins,id' : 'sometimes|exists:flight_origins,id',
            'destination_id' => $this->isMethod('POST') ? 'required|exists:flight_destinations,id' : 'sometimes|exists:flight_destinations,id',
        ];
    }
}
