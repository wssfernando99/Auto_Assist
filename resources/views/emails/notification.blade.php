<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Maintenance Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <h2 style="color: #333;">Dear Customer,</h2>

        <p style="font-size: 16px; color: #555;">
            This is a reminder regarding your Next {{ $maintain->Note}}
        </p>

        <p>
            This is a reminder regarding your vehicle with number plate <strong>{{ $vehicle->numberPlate }}</strong>.
        </p>

        @if($maintain->Note == 'Oil Filter Change Round')
            <p>
                If your vehicle's mileage has exceeded <strong>{{ $maintain->nextOil }}</strong> miles, it's time to change the oil filter to ensure your engine runs smoothly.
            </p>
        @elseif ($maintain->Note == 'Service Round')
            <p>
                If your vehicle's mileage has exceeded <strong>{{ $maintain->nextService }}</strong> miles, please schedule a regular service to keep your vehicle in top condition.
            </p>
        @elseif ($maintain->Note == 'Engine Checkup Round')
            <p>
                If your vehicle's mileage has exceeded <strong>{{ $maintain->nextEngine }}</strong> miles, it's recommended to perform an engine checkup to prevent potential issues.
            </p>
        @elseif ($maintain->Note == 'Brake Maintenance Round')
            <p>
                If your vehicle's mileage has exceeded <strong>{{ $maintain->nextBrake }}</strong> miles, please have the brakes inspected and serviced for your safety.
            </p>
        @elseif ($maintain->Note == 'Tire Rotation Round')
            <p>
                If your vehicle's mileage has exceeded <strong>{{ $maintain->nextTire }}</strong> miles, it's time to rotate the tires to ensure even wear and extend tire life.
            </p>
        @endif


        <p style="font-size: 16px; color: #555;">
            If you have any questions or need to reschedule, please contact our service center.
        </p>

        <p style="margin-top: 30px; font-size: 14px; color: #999;">
            &copy; {{ date('Y') }} AutoAssist. All rights reserved.
        </p>
    </div>
</body>
</html>
