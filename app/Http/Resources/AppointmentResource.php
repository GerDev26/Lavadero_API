<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray($request)

    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'user' => $this->user->name,
            'service' => $this->service->description,
            'vehicle' => $this->vehicle->domain,
            'price' => $this->price,
            'date' => $this->date,
            'time' => $this->time,
        ];
    }
}
