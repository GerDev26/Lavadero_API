<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->state === 1 ? true : false;

        $createdAtFormated = formatDatetime($this->created_at);
        $updatedAtFormated = formatDatetime($this->updated_at);

        $fullName = $this->user->name. " ". $this->user->lastname;

        
        return [
            'id' => $this->id,
            'status' => $status,
            'user' => $fullName,
            'vehicleDomain' => $this->domain,
            'vehicleType' => $this->typeOfVehicle->description,
            'datetime' => [
                'created_date' => $createdAtFormated['date'],
                'created_time' => $createdAtFormated['time'],
                'updated_date' => $updatedAtFormated['date'],
                'updated_time' => $updatedAtFormated['time'],
            ]
        ];
    }
}
