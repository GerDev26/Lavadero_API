<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $attributes = [
        'state' => 1
    ];

    protected $fillable = [
        'state',
        'type_id',
        'domain',
        'user_id'
    ];

    public function typeOfVehicle(){
        return $this->belongsTo(TypeOfVehicle::class, 'type_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
