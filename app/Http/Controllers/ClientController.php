<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveAppointment;
use App\Http\Requests\StoreClientVehicle;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\VehicleResource;
use App\Models\Appointment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends UserController
{
    public function reserve(ReserveAppointment $request)
    {
        $userId = Auth::user()->id;

        $appointment = Appointment::find($request->appointment_id);
        $userVehicles = Vehicle::where('user_id', $userId)->get();

        $userHasRequestVehicle = $userVehicles->contains('id', $request->vehicle_id);
        $isAppointmentReserved = $appointment->state === 'Reservado';


        if(!$userHasRequestVehicle){
            return response()->json(['error' => 'El usuario no tiene ese vehiculo'], 400);
        }
        
        if($isAppointmentReserved) {
            return response()->json(['error' => 'El turno ya se reservo'], 400);
        }
        
        $appointment->user_id = $userId;
        $appointment->vehicle_id = $request->vehicle_id;
        $appointment->service_id = $request->service_id;
        $appointment->state = 'Reservado';

        $appointment->save();

        return response()->json([
            'message' => 'Turno reservado con exito',
            'data' => new AppointmentResource($appointment)
        ], 200);
    }
    public function newVehicle(StoreClientVehicle $request){

        $userId = Auth::user()->id;
        
        $vehicle = Vehicle::create([
            'domain' => $request->domain,
            'user_id' => $userId,
            'type_id' => $request->type_id,
        ]);

        return response()->json(new VehicleResource($vehicle), 201);
    }
}
