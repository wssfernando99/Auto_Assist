<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VehicleService
{
    /**
     * Fetch vehicle details by brand, model, and year.
     */
    public function getVehicleDetails($vin)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'car-api2.p.rapidapi.com',
            'X-RapidAPI-Key' => '6e5127c099mshf4cd7041a066cd5p18c9b4jsn573f75ed88c4',  // Replace with your RapidAPI Key
        ])->get("https://car-api2.p.rapidapi.com/api/vin/{$vin}");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
