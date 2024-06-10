<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfVehicle extends Model
{
    public $table = 'type_of_vehicles';

    public $timestamps = false;
    use HasFactory;
}
