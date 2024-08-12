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
        if($this->state === 'Reservado') {
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $this->hour,
                'user' => $this->user->name ?? null,
                'service' => $this->service->service_name ?? null,
                'vehicle' => [
                    'domain' => $this->vehicle->domain ?? null,
                    'type' => $this->vehicle->typeOfVehicle->description ?? null
                ],
            ];
        } elseif($this->state === 'Disponible') {   
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $this->hour
            ];
        } elseif($this->state === 'Reservado') {
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $this->hour,
                'user' => $this->user->name ?? null,
                'service' => $this->service->service_name ?? null,
                'vehicle' => [
                    'domain' => $this->vehicle->domain ?? null,
                    'type' => $this->vehicle->typeOfVehicle->description ?? null
                ],
            ];
        }

    }
}
