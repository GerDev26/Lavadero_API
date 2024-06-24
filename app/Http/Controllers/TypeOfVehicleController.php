<?php

namespace App\Http\Controllers;

use App\Models\TypeOfVehicle;
use Illuminate\Http\Request;

class TypeOfVehicleController extends Controller
{
    public function getAll(){
        return TypeOfVehicle::all();
    }
}
