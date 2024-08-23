<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Service;
use App\Models\TypeOfVehicle;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

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

    public function Store(StoreVehicleRequest $request)
    {
        $user = Auth::user();

        switch ($user->role->description) {
            
            case 'administrador' | 'empleado':
                $vehicle = Vehicle::where('domain', $request->vehicleDomain)->where('user_id', $request->user_id)->first();
        
                if($vehicle){
                    return response()->json(['message' => 'Ya tienes este vehiculo cargado'], 400);
                }

                $vehicle = Vehicle::create([
                    'domain' => $request->vehicleDomain,
                    'user_id' => $request->user_id,
                    'type_id' => $request->vehicleType,
                ]);
        
                return response()->json(new VehicleResource($vehicle), 201);
                
            case 'cliente':
                $vehicle = Vehicle::where('domain', $request->vehicleDomain)->where('user_id', $user->id)->first();
        
                if($vehicle){
                    return response()->json(['message' => 'Ya tienes este vehiculo cargado'], 400);
                }
                
                $vehicle = Vehicle::create([
                    'domain' => $request->vehicleDomain,
                    'user_id' => $user->id,
                    'type_id' => $request->vehicleType,
                ]);
        
                return response()->json(new VehicleResource($vehicle), 201);
            
            default:
                
        }
    }
    public function Destroy($id)
    {
        $user = Auth::user();
        $userRole = $user->role->description;
        $vehicle = Vehicle::find($id);
    
        if (!$vehicle) {
            return response()->json(['error' => 'No se encontró un vehículo con ese ID'], 400);
        }
    
        switch ($userRole) {
            case 'cliente':
                if ($user->id != $vehicle->user_id) {
                    return response()->json(['error' => 'Ese vehículo no te pertenece'], 401);
                }
                break;
    
            case 'administrador':
                    //code...
                break;
    
            case 'empleado':
                    //code...
                break;
    
            default:
                return response()->json(['error' => 'Rol inexistente'], 401);
        }
    
        if (!$vehicle->delete()) {
            return response()->json(['error' => 'No se pudo eliminar el registro'], 400);
        }
    
        return response()->json(['mensaje' => 'Se eliminó el registro'], 200);
    }    
    public function Update($id, UpdateVehicleRequest $request){
        $user = Auth::user();
        $userRole = $user->role->description;
        
        $vehicle = Vehicle::find($id);
        if(!$vehicle) {
            return response()->json(['error' => 'No existe un vehiculo con ese id'], 400);
        }



        switch ($userRole) {
            case 'administrador':
                //code..
                break;

            case 'empleado':
                //code...
                break;

            case 'cliente':
                $userId = $user->id;
                if($userId != $vehicle->user_id) {
                    return response()->json(['error' => 'Este no es tu vehiculo'], 401);
                }
                break;

            default:
                return response(['error' => 'Rol inexistente'], 401);
                break;
        }

        $vehicle->domain = $request->vehicleDomain ?? $vehicle->domain;
        $vehicle->type_id = $request->vehicleType ?? $vehicle->type_id;
        $isSaved = $vehicle->save();

        if(!$isSaved) {
            return response()->json(['error' => 'No se pudo actualizar'], 400);
        }

        return response()->json(new VehicleResource($vehicle) , 200);
    }
    public function getAllTypeOfVehicles(){
        return TypeOfVehicle::all();
    }
    public function getAllServices(){
        return Service::all();
    }
}
