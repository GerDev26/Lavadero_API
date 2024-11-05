<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveAppointment;
use App\Http\Requests\StoreClientVehicle;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\VehicleResource;
use App\Models\Appointment;
use App\Models\Price;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends UserController
{
    public function reserve(ReserveAppointment $request)
    {
        $userId = Auth::user()->id;

        $appointment = Appointment::find($request->appointment_id);
        $userVehicle = Vehicle::find($request->vehicle_id);

        $userHasRequestVehicle = $userVehicle->user_id == $userId;
        $isAppointmentReserved = $appointment->state == 'Reservado';


        if(!$userHasRequestVehicle) {
            return response()->json(['error' => 'El usuario no tiene ese vehiculo'], 400);
        }
        
        if($isAppointmentReserved) {
            return response()->json(['error' => 'El turno ya se reservo'], 400);
        }
        
        $price = Price::where('service_id', $request->service_id)->where('type_of_vehicle_id', $userVehicle->type_id)->first();

        if(!$price){
            return response()->json(['error' => 'No existe un precio para ese servicio y vehiculo', $userVehicle], 400);
        }
        $appointment->user_id = $userId;
        $appointment->vehicle_id = $request->vehicle_id;
        $appointment->service_id = $request->service_id;
        $appointment->price = $price->value;
        $appointment->state = 'Reservado';

        $appointment->save();

        return response()->json([
            'message' => 'Turno reservado con exito',
            'data' => new AppointmentResource($appointment)
        ], 200);
    }
}
