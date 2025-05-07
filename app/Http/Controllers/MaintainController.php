<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Jobs\Prediction;
use App\Models\Maintain;
use Illuminate\Support\Facades\DB;
use App\Mail\Notification;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SMSController;
use App\Jobs\SendMaintenanceSMS;

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
            ->select('maintains.*', 'customers.name', 'customers.email', 'customers.contact', 'vehicles.numberPlate')
            ->where('maintains.predictedDate', now()->toDateString())
            ->where(function ($query) {
                $query->whereNull('maintains.send')
                    ->orWhere('maintains.send', 1);
            })
            ->latest()
            ->get();

        return response()->json($maintains);
    }

    public function AllPredictions(){

        $predictions = Maintain::join('customers', 'maintains.customerId', '=', 'customers.customerId')
        ->join('vehicles', 'maintains.vehicleId', '=', 'vehicles.vehicleId')
        ->select('maintains.*', 'customers.name', 'customers.email', 'customers.contact', 'vehicles.numberPlate')
        ->get();

        return view('admin.MaintainManagement.allPredictions', compact('predictions'));

    }

    public function Ignore(Request $request){

        try{

            $id = $request->id;

            $maintain = Maintain::find($id);

            $maintain->send = 3;
            $maintain->save();

            return redirect()->back()->with('message', 'Notification Ignored');

        }catch(\Exception $e){

            return redirect()->back()->with('error', 'Something went wrong');

        }
    }


    public function sendNotification(Request $request)
    {

        $notificationMethod = $request->notificationMethod;
        $id = $request->id;

        if (!$notificationMethod || !$id) {
            return redirect()->back()->with('error', 'Invalid request data');
        }

        try {
            if ($notificationMethod === 'email') {
                $result = $this->sendByEmail($id);

                if ($result) {
                    return redirect()->back()->with('message', 'Email sent successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to send email');
                }

            } elseif ($notificationMethod === 'mobile') {
                // $result = $this->sendBySMS($id);

                $result = SendMaintenanceSMS::dispatch($id);

               if ($result) {
                    return redirect()->back()->with('message', 'SMS sent successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to send SMS');
                }


            }

            return redirect()->back()->with('error', 'Unsupported notification method');

        } catch (\Exception $e) {
            // Log the error if needed: \Log::error($e);
            return redirect()->back()->with('error', 'An error occurred while sending notification');
        }
    }

    private function sendByEmail($id): bool
    {
        $maintain = Maintain::find($id);

        $vehicle = Vehicle::where('vehicleId', $maintain->vehicleId)->first();

        if (!$maintain) {
            return false;
        }

        $customer = Customer::where('customerId', $maintain->customerId)->first();

        if (!$customer || !filter_var($customer->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        Mail::to($customer->email)->queue(new Notification($customer, $maintain, $vehicle));

        // Update maintain record
        $count = $maintain->sentCount + 1;

        $maintain->update([
            'sentCount' => $count,
            'sendby' => 'email',
            'lastSentDate' => now(),
            'send' => 1,
        ]);
        return true;
    }

    private function sendBySMS($id)
    {
        $maintain = Maintain::find($id);

        if (!$maintain) {
            return false;
        }

        $vehicle = Vehicle::where('vehicleId', $maintain->vehicleId)->first();
        $customer = Customer::where('customerId', $maintain->customerId)->first();

        if (!$customer || !$vehicle) {
            return false;
        }

        // Default message
        $message = "Dear {$customer->name}, ";

        switch ($maintain->Note) {
            case 'Service Round':
                $message .= "if your vehicle {$vehicle->numberPlate} has exceeded {$maintain->nextService} miles. Please schedule a regular service to keep your vehicle in top condition.";
                break;
            case 'Brake Maintenance Round':
                $message .= "if your vehicle {$vehicle->numberPlate} has exceeded {$maintain->nextBrake} miles. Please have the brakes inspected and serviced for your safety.";
                break;
            case 'Oil Filter Change Round':
                $message .= "if your vehicle {$vehicle->numberPlate} has exceeded {$maintain->nextOil} miles. It's time to change the oil filter to ensure your engine runs smoothly.";
                break;
            case 'Engine Checkup Round':
                $message .= "if your vehicle {$vehicle->numberPlate} has exceeded {$maintain->nextEngine} miles. It's recommended to perform an engine checkup to prevent potential issues.";
                break;
            case 'Tire Rotation Round':
                $message .= "if your vehicle {$vehicle->numberPlate} has exceeded {$maintain->nextTire} miles. It's time to rotate the tires to ensure even wear and extend tire life.";
                break;
            default:
                $message .= "please check your vehicle's maintenance schedule.";
        }

        $number = '+94' . ltrim($customer->contact, '0');

        // Send the SMS
        $smsController = new SMSController();
        $result = $smsController->sendSMS($message, $number);

        if ($result) {
            $count = $maintain->sentCount + 1;

            $maintain->update([
                'sentCount' => $count,
                'sendby' => 'email',
                'lastSentDate' => now(),
                'send' => 1,
            ]);

            return true;

        } else {
            return false;
        }

    }

}
