<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $attributes = [
        'state' => 1
    ];
    protected $fillable = [
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
}
