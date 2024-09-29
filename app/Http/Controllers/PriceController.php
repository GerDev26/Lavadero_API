<?php

namespace App\Http\Controllers;

use App\Http\Resources\PriceResource;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function getAll(Request $request) {

        $prices = Price::select();

        switch (strtolower($request->query('vehicleType'))) {
            case 'auto':
                $vehicleType = 1;
                $prices->where('type_of_vehicle_id', $vehicleType);
                break;
            case 'moto':
                $vehicleType = 2;
                $prices->where('type_of_vehicle_id', $vehicleType);
                break;
            case 'camioneta':
                $vehicleType = 3;
                $prices->where('type_of_vehicle_id', $vehicleType);
                break;
            
            default:
                
                break;
        }
        switch (strtolower($request->query('service'))) {
            case 'lavado estandar':
                $service = 1;
                $prices->where('service_id', $service);
                break;
            case 'lavado premium':
                $service = 2;
                $prices->where('service_id', $service);
                break;
            case 'motor':
                $service = 3;
                $prices->where('service_id', $service);
                break;
            case 'tapizado':
                $service = 4;
                $prices->where('service_id', $service);
                break;
            
            default:
                # code...
                break;
        }
        
        return PriceResource::collection($prices->get());
    }
}
