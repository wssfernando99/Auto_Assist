<?php
namespace App\Jobs;

use App\Models\Maintain;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Http\Controllers\SMSController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMaintenanceSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $maintainId;

    public function __construct($maintainId)
    {
        $this->maintainId = $maintainId;
    }

    public function handle()
    {
        $maintain = Maintain::find($this->maintainId);

        if (!$maintain) return;

        $vehicle = Vehicle::where('vehicleId', $maintain->vehicleId)->first();
        $customer = Customer::where('customerId', $maintain->customerId)->first();

        if (!$customer || !$vehicle) return;

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

        $smsController = new SMSController();
        $result = $smsController->sendSMS($message, $number);

        if ($result) {
            $maintain->update([
                'sentCount' => $maintain->sentCount + 1,
                'sendby' => 'email',
                'lastSentDate' => now(),
                'send' => 1,
            ]);
        }
    }
}
