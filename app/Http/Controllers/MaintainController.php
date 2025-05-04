<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Jobs\Prediction;
use App\Models\Maintain;
use Illuminate\Support\Facades\DB;
use App\Mail\Notification;

class MaintainController extends Controller
{
    public function AllMaintains(){

        return  view('admin.MaintainManagement.allMaintains');
    }

    public function Prediction(){

        $vehicles = Vehicle::join('maintenances', 'vehicles.vehicleId', '=', 'maintenances.vehicleId')
        ->select('vehicles.*', 'maintenances.lastService', 'maintenances.lastBrake', 'maintenances.lastOil', 'maintenances.lastEngine', 'maintenances.lastTire')
        ->where('vehicles.isActive', 1)
        ->where('vehicles.check', 1)
        ->get();

        $today = now()->toDateString();


        foreach ($vehicles as $vehicle) {

            Prediction::dispatch(
                $vehicle->milage,
                $vehicle->lastService,
                $vehicle->lastBrake,
                $vehicle->lastOil,
                $vehicle->lastEngine,
                $vehicle->lastTire,
                $vehicle->engineType,
                $vehicle->vehicleType,
                $vehicle->vehicleId,
                $vehicle->customerId,
                $today
            );

        }

        return redirect('/maintainManagement');
    }

    public function fetchLatest()
    {
        $maintains = Maintain::join('customers', 'maintains.customerId', '=', 'customers.customerId')
            ->join('vehicles', 'maintains.vehicleId', '=', 'vehicles.vehicleId')
            ->select('maintains.*', 'customers.name','customers.email', 'customers.contact', 'vehicles.numberPlate')
            ->where('maintains.predictedDate', now()->toDateString())
            ->latest()
            ->get();

        return response()->json($maintains);
    }

    public function SendNotification(Request $request)
    {
        $notificationMethod = $request->notificationMethod;
        $id = $request->id;

        if ($notificationMethod == 'email') {
            $this->SendByEmail($id);
        } elseif ($notificationMethod == 'sms') {
            $this->SendBySMS($id);
        }
    }

    public function SendByEmail($id)
    {
        // Logic for sending email notification using the ID
    }

    public function SendBySMS($id)
    {
        // Logic for sending SMS notification using the ID
    }
}
