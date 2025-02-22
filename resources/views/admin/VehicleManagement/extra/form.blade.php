<div class="container mt-4">
    <h3 class="text-center bg-dark text-white">VEHICLE CHECK AND SERVICES LOG</h3>

    <div class="row">
        <div class="col-md-12 mt-2">
            <h5><strong>Auto Assist</strong></h5>
        </div>
        <div class="col-md-12 mt-2">
            <h6><strong class="me-2">Vehicle Id:</strong>{{ $vehicle->vehicleId }}</h6>
        </div>
        <div class="col-md-6 mt-2">
            
            <p><strong class="me-2">Service Id: </strong>{{ $serviceId }}</p>
            <p><strong class="me-2">Date : </strong>{{ $date }}</p>
            <p><strong class="me-2">Vehicle No: </strong>{{ $vehicle->numberPlate }}</p>
        </div>
        <div class="col-md-6 mt-2">
            <p><strong class="me-2">Vehicle Brand:  </strong>{{ $vehicle->vehicleBrand }}</p>
            <p><strong class="me-2">Vehicle Model: </strong>{{ $vehicle->vehicleModel }}</p>
            <p><strong class="me-2">Vehicle Year: </strong>{{ $vehicle->vehicleYear }}</p>
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
                <td><input type="checkbox" value="windshield" name="check[0]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[0]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[0]" disabled></textarea></td>
            </tr>
            <tr>
                <td>MIRRORS</td>
                <td><input type="checkbox" value="mirrors" name="check[1]" onclick="toggleFields(this)" ></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[1]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[1]" disabled></textarea></td>
            </tr>
            <tr>
                <td>INSTRUMENTS OPERATION</td>
                <td><input type="checkbox"  value="instruments" name="check[2]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[2]" disabled ></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[2]" disabled></textarea></td>
            </tr>
            <tr>
                <td>EMERGENCY BRAKE</td>
                <td><input type="checkbox"  value="emBrake" name="check[3]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[3]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[3]" disabled></textarea></td>
            </tr>
            <tr>
                <td>BRAKES</td>
                <td><input type="checkbox"  value="brakes" name="check[4]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[4]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[4]" disabled></textarea></td>
            </tr>
            <tr>
                <td>HORN</td>
                <td><input type="checkbox"  value="horn" name="check[5]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[5]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[5]" disabled></textarea></td>
            </tr>
            <tr>
                <td>STEERING & ALIGNMENT</td>
                <td><input type="checkbox"  value="alignment" name="check[6]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[6]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[6]" disabled></textarea></td>
            </tr>
            <tr>
                <td>ENGINE OIL LEVEL</td>
                <td><input type="checkbox"  value="oillevel" name="check[7]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[7]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[7]" disabled></textarea></td>
            </tr>
            <tr>
                <td>AIR CLEANER</td>
                <td><input type="checkbox"  value="aircleaner" name="check[8]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[8]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[8]" disabled></textarea></td>
            </tr>
            <tr>
                <td>ALL GLASS</td>
                <td><input type="checkbox"  value="allglass" name="check[9]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[9]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[9]" disabled></textarea></td>
            </tr>
            <tr>
                <td>AIR CONDITIONER</td>
                <td><input type="checkbox"  value="airconditioner" name="check[10]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[10]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[10]" disabled></textarea></td>
            </tr>
            <tr>
                <td>GENERAL ENGINE OPERATION</td>
                <td><input type="checkbox"  value="generalengine" name="check[11]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[11]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[11]" disabled></textarea></td>
            </tr>
            <tr>
                <td>COOLING SYSTEM</td>
                <td><input type="checkbox"  value="coolingsystem" name="check[12]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[12]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[12]" disabled></textarea></td>
            </tr>
            <tr>
                <td>LEAKS OIL, FUEL & COOLANT</td>
                <td><input type="checkbox"  value="leaksOil" name="check[13]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[13]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[13]" disabled></textarea></td>
            </tr>
            <tr>
                <td>TIRES & TIRE PRESSURE</td>
                <td><input type="checkbox"  value="tires" name="check[14]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[14]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[14]" disabled></textarea></td>
            </tr>
            <tr>
                <td>BELTS</td>
                <td><input type="checkbox"  value="belts" name="check[15]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[15]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[15]" disabled></textarea></td>
            </tr>
            <tr>
                <td>STARTER & IGNITION</td>
                <td><input type="checkbox"  value="starter" name="check[16]" onclick="toggleFields(this)"></td>
                <td><textarea class ="form-control" rows="1" name="deficiencies[16]" disabled></textarea></td>
                <td><textarea class ="form-control" rows="1" name="service[16]" disabled></textarea></td>
            </tr>
        </tbody>
    </table>
</div>