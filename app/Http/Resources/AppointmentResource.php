<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $date = Carbon::parse($this->date);
        $hour = Carbon::parse($this->hour);
        if($this->state === 'Reservado') {
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $hour->format('H:m'),
                'date' => $date->format('d-m-Y'),
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
                'hour' => $hour->format('H:m'),
                'date' => $date->format('d-m-Y'),
            ];
        } elseif($this->state === 'Completado') {
            return [
                'Turno completo'
            ];
        }

    }
}
