<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'flight_number' => $this->flight_number,
            'origin_id' => $this->origin_id,
            'destination_id' => $this->destination_id,
        ];
    }
}
