<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'user_id' => $this->isMethod('POST') ? 'required|exists:passengers,id' : 'sometimes|exists:passengers,id',
            'flight_id' => $this->isMethod('POST') ? 'required|exists:flights,id' : 'sometimes|exists:flights,id',
            'status' => $this->isMethod('POST') ? 'nullable|in:pending,confirmed,cancelled' : 'sometimes|in:pending,confirmed,cancelled',
        ];
    }

}
