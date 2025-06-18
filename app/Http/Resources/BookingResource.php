<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{

    public function toArray($request) {
        return [
            'id' => $this->id,
            'passenger_id' => $this->passenger_id,
            'flight_id' => $this->flight_id,
            'status' => $this->status,
        ];
    }
}
