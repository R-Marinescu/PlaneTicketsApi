<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
{

    public function toArray($request) {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'surname' => $this->last_name,
            'email' => $this->email,
        ];
    }
}
