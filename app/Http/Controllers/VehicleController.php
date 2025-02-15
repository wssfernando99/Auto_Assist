<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class VehicleController extends Controller
{
    public function VehicleDetails(){

        try{

            $data = Vehicle::where('isActive',1)
                ->orderby('id','desc')
                ->get();

            return view('admin.vehicleManagement.vehicleDetails',compact('data'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
