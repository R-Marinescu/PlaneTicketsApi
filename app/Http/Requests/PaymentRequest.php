<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
    public function rules() {

        return [
            'booking_id' => $this->isMethod('POST') ? 'required|exists:bookings,id' : 'sometimes|exists:bookings,id',
            'amount' => $this->isMethod('POST') ? 'required|numeric|min:0.5' : 'sometimes|numeric|min:0.5',
            'currency' => $this->isMethod('POST') ? 'nullable|string' : 'sometimes|string',
            'status' => $this->isMethod('POST') ? 'nullable|in:pending,completed,failed' : 'sometimes|in:pending,completed,failed',
        ];
    }
}
