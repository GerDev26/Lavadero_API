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
                'hour' => $hour->format('H:i'),
                'date' => $date->format('d-m-Y'),
                'user' => $this->user ?? null,
                'service' => $this->service->service_name ?? null,
                'vehicle' => new VehicleResource($this->vehicle)
            ];
        } elseif($this->state === 'Disponible') {   
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $hour->format('H:i'),
                'date' => $date->format('d-m-Y'),
            ];
        } elseif($this->state === 'Completo') {
            return [
                'id' => $this->id,
                'state' => $this->state,
                'hour' => $hour->format('H:i'),
                'date' => $date->format('d-m-Y'),
                'user' => $this->user ?? null,
                'service' => $this->service->service_name ?? null,
                'vehicle' => new VehicleResource($this->vehicle)
            ];
        }

    }
}
