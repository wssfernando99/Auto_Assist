<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PredictionService
{
    protected $endpoint = 'http://127.0.0.1:8080/predict';

    public function predict(array $data)
    {
        $response = Http::post($this->endpoint, $data);

        if ($response->successful()) {
            return $response->json(); // Return parsed JSON
        }

        return [
            'error' => 'Failed to get prediction',
            'details' => $response->body()
        ];
    }
}
