<?php

namespace App\Jobs;

use App\Models\Maintain;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\PredictionService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Prediction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $milage;
    protected $lastService;
    protected $lastBrake;
    protected $lastOil;
    protected $lastEngine;
    protected $lastTire;
    protected $engineType;
    protected $vehicleType;
    protected $vehicleId;
    protected $customerId;
    protected $today;

    public function __construct(
        $milage,
        $lastService,
        $lastBrake,
        $lastOil,
        $lastEngine,
        $lastTire,
        $engineType,
        $vehicleType,
        $vehicleId,
        $customerId,
        $today
    ) {
        $this->milage = $milage;
        $this->lastService = $lastService;
        $this->lastBrake = $lastBrake;
        $this->lastOil = $lastOil;
        $this->lastEngine = $lastEngine;
        $this->lastTire = $lastTire;
        $this->engineType = $engineType;
        $this->vehicleType = $vehicleType;
        $this->vehicleId = $vehicleId;
        $this->customerId = $customerId;
        $this->today = $today;
    }

    public function handle(PredictionService $predictionService): void
    {
        $data = [
            "Engine_Type" => (string) $this->engineType,
            "Vehicle_Type" => (string) $this->vehicleType,
            "Total_Mileage" => (float) $this->milage,
            "Last_Service_Mileage" => (float) $this->lastService,
            "Last_Brake_Maintenance_Mileage" => (float) $this->lastBrake,
            "Last_Engine_Checkup_Mileage" => (float) $this->lastEngine,
            "Last_Tire_Rotation_Mileage" => (float) $this->lastTire,
            "Last_Oil_Filter_Change_Mileage" => (float) $this->lastOil,
        ];

        $response = $predictionService->predict($data);

        $nextServiceMileage = $response['predictions']['Next Service Mileage'];
        $nextBrakeMaintenanceMileage = $response['predictions']['Next Brake Maintenance Mileage'];
        $nextEngineCheckupMileage = $response['predictions']['Next Engine Checkup Mileage'];
        $nextTireRotationMileage = $response['predictions']['Next Tire Rotation Mileage'];
        $nextOilFilterChangeMileage = $response['predictions']['Next Oil Filter Change Mileage'];

        $vehicleMaintenance = Maintenance::where('vehicleId', $this->vehicleId)->first();

        $perMileage = Vehicle::where('vehicleId', $this->vehicleId)->select('milagePer')->first();

        // Parse the date using Carbon
        $lastServiceDate = Carbon::parse($vehicleMaintenance->lServiceDate);
        $lastBrakeDate = Carbon::parse($vehicleMaintenance->lBrakeDate);
        $lastOilDate = Carbon::parse($vehicleMaintenance->lOilDate);
        $lastEngineDate = Carbon::parse($vehicleMaintenance->lEngineDate);
        $lastTireDate = Carbon::parse($vehicleMaintenance->lTireDate);

        // Get the difference in days
        $serviceDateCount = $lastServiceDate->diffInDays($this->today);
        $brakeDateCount = $lastBrakeDate->diffInDays($this->today);
        $oilDateCount = $lastOilDate->diffInDays($this->today);
        $engineDateCount = $lastEngineDate->diffInDays($this->today);
        $tireDateCount = $lastTireDate->diffInDays($this->today);

        $serviceMileageNow = $serviceDateCount * $perMileage->milagePer;
        $brakeMileageNow = $brakeDateCount * $perMileage->milagePer;
        $oilMileageNow = $oilDateCount * $perMileage->milagePer;
        $engineMileageNow = $engineDateCount * $perMileage->milagePer;
        $tireMileageNow = $tireDateCount * $perMileage->milagePer;

        $maintain = Maintain::where('vehicleId', $this->vehicleId)->where('lastService',$this->lastService)->first();

        if ($serviceMileageNow > $nextServiceMileage) {
            if(!$maintain){
                $maintain = new Maintain();
                $maintain->vehicleId = $this->vehicleId;
                $maintain->customerId = $this->customerId;
                $maintain->lastService = $this->lastService;
                $maintain->tMileage = $this->milage;
                $maintain->note = "Service Round";
                $maintain->nextService = $nextServiceMileage;
                $maintain->predictedDate = $this->today;
                $maintain->sendCount = 0;
                $maintain->save();
            }else{
                $maintain->update([
                    'predictedDate' => $this->today,
                ]);
            }
        }

        $maintain = Maintain::where('vehicleId', $this->vehicleId)->where('lastBrake',$this->lastBrake)->first();

        if ($brakeMileageNow > $nextBrakeMaintenanceMileage) {
            if(!$maintain){
                $maintain = new Maintain();
                $maintain->vehicleId = $this->vehicleId;
                $maintain->customerId = $this->customerId;
                $maintain->lastBrake = $this->lastBrake;
                $maintain->tMileage = $this->milage;
                $maintain->note = "Brake Maintenance Round";
                $maintain->nextBrake = $nextBrakeMaintenanceMileage;
                $maintain->predictedDate = $this->today;
                $maintain->sendCount = 0;
                $maintain->save();
            }else{
                $maintain->update([
                    'predictedDate' => $this->today,
                ]);
            }
        }

        $maintain = Maintain::where('vehicleId', $this->vehicleId)->where('lastOil',$this->lastOil)->first();

        if ($oilMileageNow > $nextOilFilterChangeMileage) {
            if(!$maintain){
                $maintain = new Maintain();
                $maintain->vehicleId = $this->vehicleId;
                $maintain->customerId = $this->customerId;
                $maintain->lastOil = $this->lastOil;
                $maintain->tMileage = $this->milage;
                $maintain->note = "Oil Filter Change Round";
                $maintain->nextOil = $nextOilFilterChangeMileage;
                $maintain->predictedDate = $this->today;
                $maintain->sendCount = 0;
                $maintain->save();
            }else{
                $maintain->update([
                    'predictedDate' => $this->today,
                ]);
            }
        }

        $maintain = Maintain::where('vehicleId', $this->vehicleId)->where('lastEngine',$this->lastEngine)->first();

        if ($engineMileageNow > $nextEngineCheckupMileage) {
            if(!$maintain){
                $maintain = new Maintain();
                $maintain->vehicleId = $this->vehicleId;
                $maintain->customerId = $this->customerId;
                $maintain->lastEngine = $this->lastEngine;
                $maintain->tMileage = $this->milage;
                $maintain->note = "Engine Checkup Round";
                $maintain->nextEngine = $nextEngineCheckupMileage;
                $maintain->predictedDate = $this->today;
                $maintain->sendCount = 0;
                $maintain->save();
            }else{
                $maintain->update([
                    'predictedDate' => $this->today,
                ]);
            }
        }

        $maintain = Maintain::where('vehicleId', $this->vehicleId)->where('lastTire',$this->lastTire)->first();

        if ($tireMileageNow > $nextTireRotationMileage) {
            if(!$maintain){
                $maintain = new Maintain();
                $maintain->vehicleId = $this->vehicleId;
                $maintain->customerId = $this->customerId;
                $maintain->lastTire = $this->lastTire;
                $maintain->tMileage = $this->milage;
                $maintain->note = "Tire Rotation Round";
                $maintain->nextTire = $nextTireRotationMileage;
                $maintain->predictedDate = $this->today;
                $maintain->sendCount = 0;
                $maintain->save();
            }else{
                $maintain->update([
                    'predictedDate' => $this->today,
                ]);
            }
        }
    }
}


