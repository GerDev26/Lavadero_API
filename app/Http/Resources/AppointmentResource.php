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
        $isActive = $this->state === 1 ? true : false;

        $createdAtFormated = formatDatetime($this->created_at);
        $updatedAtFormated = formatDatetime($this->updated_at);

        
        return [
            'id' => $this->id,
            'isActive' => $isActive,
            'user' => $this->user->name,
            'service' => $this->service->description,
            'vehicle' => $this->vehicle->domain,
            'created_date' => $createdAtFormated['date'],
            'created_time' => $createdAtFormated['time'],
            'updated_date' => $updatedAtFormated['date'],
            'updated_time' => $updatedAtFormated['time'],
        ];
    }
}
