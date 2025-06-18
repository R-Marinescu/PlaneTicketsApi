<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightDestinationResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'airport' => $this->airport,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }

}
