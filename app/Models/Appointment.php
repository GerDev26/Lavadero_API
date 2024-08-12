<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $attributes = [
        'state' => 'Disponible' //Reservado y Completado
    ];

    protected $fillable = [
        'date_id',
        'hour',
        'state',
        'price',
        'user_id',
        'service_id',
        'vehicle_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function dates(){
        return $this->belongsTo(Date::class, 'date_id', 'id');
    }
}
