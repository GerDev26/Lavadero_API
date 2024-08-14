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
        $fullName = $this->user->name. " ". $this->user->lastname;
        return [
            'id' => $this->id,
            'user' => $fullName,
            'vehicleDomain' => $this->domain,
            'vehicleType' => $this->typeOfVehicle->description,
        ];
    }
}
