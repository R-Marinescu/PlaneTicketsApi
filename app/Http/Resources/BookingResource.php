<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{

    public function toArray($request) {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'flight_id' => $this->flight_id,
            'status' => $this->status,
        ];
    }
}
