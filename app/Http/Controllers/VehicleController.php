<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    public function GetCheckOut($vehicleId){

        try{

            $vehicle = Vehicle::where('isActive',1)
                ->where('vehicleId',$vehicleId)
                ->where('checkIn',1)
                ->first();

            $invoiceId = Cache::get('invoiceId');

            if(empty($invoiceId)){
                $invoiceId = 'INV_'.random_int(10000000,99999999);
                Cache::put('invoiceId',$invoiceId);
            }


            $items = Cache::get('itemInvoiceData');

            $date = date('d-m-Y');

            $userName = Auth::user()->name;

            $customer = Customer::where('customerId',$vehicle->customerId)->first()->name;

            return view('admin.vehicleManagement.checkOutVehicle',compact('vehicle','items','date','userName','customer','invoiceId'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function ItemInvoice(Request $request){

        $request->validate([
            'description' => 'required',
            'quantity' => 'required|numeric|decimal:0',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ],[
            'description.required' => 'Description is required',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
            'quantity.decimal' => 'Invalid quantity',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.regex' => 'Price must be minimum 2 decimal',
            'discount.required' => 'Discount is required',
            'discount.numeric' => 'Discount must be a number',
            'discount.regex' => 'Discount must be minimum 2 decimal',
        ]);

        try{

            $id = uniqid();

            if($request->discount == 0){
                $discount = 0;
            }else{
                $discount = ($request->price* $request->quantity * $request->discount / 100);
            }

            $total = $request->quantity * $request->price - $discount;

            $check = [
                'id' => $id,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'discount' => $discount,
                'total' => $total,
            ];

            // Retrieve existing records or initialize an empty array
            $items = Cache::get('itemInvoiceData', []);

            // Append new record to the array
            $items[] = $check;

            // Store the updated array back in cache
            Cache::put('itemInvoiceData', $items);

            return redirect()->back()->with('message','Item added to Invoice.');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function CancelCheckOut(Request $request){

        Cache::forget('itemInvoiceData');
        Cache::forget('invoiceId');

        return redirect('/checkInVehicles');
    }

    public function RemoveItem($id){


      // Retrieve existing items from cache
    $items = Cache::get('itemInvoiceData', []);

    // Filter out the item with the given unique ID
    $updatedItems = array_filter($items, function ($item) use ($id) {
        return $item['id'] !== $id; // Keep only items that don't match the given ID
    });

   
    Cache::put('itemInvoiceData', array_values($updatedItems)); // Re-index and store
    

    return back()->with('message', 'Item removed successfully.');


    }
        
}
