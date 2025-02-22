<div class="container mt-4">
    <h3 class="text-center bg-dark text-white">VEHICLE CHECK AND SERVICES LOG</h3>

    <div class="row">
        <div class="col-md-12 mt-2">
            <h5><strong>Auto Assist</strong></h5>
        </div>
        <div class="col-md-12 mt-2">
            <h6><strong class="me-2">Vehicle Id:</strong>{{ $service->vehicleId }}</h6>
        </div>
        <div class="col-md-6 mt-2">
            
            <p><strong class="me-2">Service Id: </strong>{{ $service->serviceId }}</p>
            <p><strong class="me-2">Date : </strong>{{ $service->serviceDate }}</p>
            <p><strong class="me-2">Vehicle No: </strong>{{ $service->numberPlate }}</p>
        </div>
        <div class="col-md-6 mt-2">
            <p><strong class="me-2">Vehicle Brand:  </strong>{{ $service->vehicleBrand }}</p>
            <p><strong class="me-2">Vehicle Model: </strong>{{ $service->vehicleModel }}</p>
            <p><strong class="me-2">Vehicle Year: </strong>{{ $service->vehicleYear }}</p>
        </div>
    </div>
    <table class="table table-bordered mt-3">
        
        <thead class="table-dark text-white">
            <tr>
                <th>Inspection Items</th>
                <th>Check</th>
                <th>Deficiencies</th>
                <th>Services Performed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>WINDSHIELD WIPERS</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'windshield')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                    
                @endforeach
                
                </td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '0')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '0')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>MIRRORS</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'mirrors')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                    
                @endforeach
                
                </td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '1')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '1')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>INSTRUMENTS OPERATION</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'instruments')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '2')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '2')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>EMERGENCY BRAKE</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'emBrake')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '3')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '3')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>BRAKES</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'brakes')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '4')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '4')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>HORN</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'horn')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '5')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '5')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>STEERING & ALIGNMENT</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'alignment')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '6')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '6')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>ENGINE OIL LEVEL</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'oillevel')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '7')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '7')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>AIR CLEANER</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'aircleaner')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '8')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '8')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>ALL GLASS</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'allglass')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '9')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '9')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>AIR CONDITIONER</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'airconditioner')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '10')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '10')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>GENERAL ENGINE OPERATION</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'generalengine')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '11')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '11')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>COOLING SYSTEM</td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'coolingsystem')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '12')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '12')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>LEAKS OIL, FUEL & COOLANT</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'leaksOil')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '13')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '13')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>TIRES & TIRE PRESSURE</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'tires')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '14')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '14')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>BELTS</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'belts')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '15')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '15')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
            <tr>
                <td>STARTER & IGNITION</td>
                <td>
                @foreach ($serviceDetails as $detail )
                    @if ($detail->inspection == 'starter')
                    <input type="checkbox" value="windshield" checked>
                    @endif
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '16')
                    {{ $detail->Deficiencies }}
                    @endif
                    
                @endforeach
                </td>
                <td>
                    @foreach ($serviceDetails as $detail )
                    @if ($detail->checkId == '16')
                    {{ $detail->service }}
                    @endif
                    
                @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>