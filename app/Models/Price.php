<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_of_vehicle_id',
        'service_id',
        'value'
    ];
    public function typeOfVehicle(){
        return $this->belongsTo(TypeOfVehicle::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
