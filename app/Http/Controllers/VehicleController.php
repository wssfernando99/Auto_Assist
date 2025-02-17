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

    public function CheckIn(Request $request){
        try{

            Vehicle::where(['vehicleId' => $request->vehicleId])->update([
                'checkIn' => 1,
            ]);

            return redirect()->back()->with('message','Vehicle checked in successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function CheckInVehicles(){

        try{

            $data = Vehicle::where('isActive',1)
                ->where('checkIn',1)
                ->orderby('id','desc')
                ->get();

            return view('admin.vehicleManagement.checkInVehicles',compact('data'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function CancelCheckIn(Request $request){
        try{

            Vehicle::where(['vehicleId' => $request->vehicleId])->update([
                'checkIn' => 0,
            ]);

            return redirect()->back()->with('message','Canceled Check in successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
