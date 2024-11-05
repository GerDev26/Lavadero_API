<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
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
            case 'lavado estandar y motor':
                $service = 5;
                $prices->where('service_id', $service);
                break;
            case 'lavado estandar y tapizado':
                $service = 6;
                $prices->where('service_id', $service);
                break;
            case 'motor y tapizado':
                $service = 7;
                $prices->where('service_id', $service);
                break;
            default:
                // Código para manejar un servicio no encontrado
                break;
        }
        
        
        return PriceResource::collection($prices->get());
    }
    public function store(StorePriceRequest $request)
    {
        $price = Price::create([
            'type_of_vehicle_id' => $request->vehicleType,
            'service_id' => $request->service_id,
            'value' => $request->value
        ]);
    
        return response()->json(new PriceResource($price), 200);
    }
    public function update(UpdatePriceRequest $request, $id)
    {

        $price = Price::findOrFail($id);
        $price->update([
            'type_of_vehicle_id' => $request->vehicleType ?? $price->type_of_vehicle_id,
            'service_id' => $request->service_id ?? $price->service_id,
            'value' => $request->value ?? $price->value
        ]);

        return response()->json(new PriceResource($price), 200);
    }



}
