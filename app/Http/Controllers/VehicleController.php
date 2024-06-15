<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getAll(){
        $vehicles = Vehicle::with('user', 'typeOfVehicle')->orderBy('created_at', 'desc')->get();

        return VehicleResource::collection($vehicles);
    }
    public function getById($id){
        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicleFormatted = new VehicleResource($vehicle);
            return response()->json(['status' => true, 'message' => 'Ok!', 'data' => $vehicleFormatted]);
            }
        return response()->json(['status' => false, 'message' => 'Invalid id', 'data' => '']);
    }

    public function Store(StoreVehicleRequest $request){

        $vehicle = Vehicle::create([
            'domain' => $request->domain,
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
        ]);

        $formattedVehicle = new VehicleResource($vehicle);

        return response()->json($formattedVehicle, 201);
    }
}
