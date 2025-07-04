<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Maintenance;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Vehicle;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\VehicleService;
use Pest\ArchPresets\Custom;

class VehicleController extends Controller
{

    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

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

            Cache::flush();

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

            $maintenance = Maintenance::where('vehicleId',$vehicleId)
                ->where('isActive',1)
                ->first();

            $invoiceId = Cache::get('invoiceId');
            $serviceId = Cache::get('serviceId');

            if(empty($invoiceId)){
                $invoiceId = 'INV_'.random_int(10000000,99999999);
                Cache::put('invoiceId',$invoiceId);
            }

            if(empty($serviceId)){
                $serviceId = 'SVE_'.random_int(10000000,99999999);
                Cache::put('serviceId',$serviceId);
            }


            $items = Cache::get('itemInvoiceData');

            $date = date('d-m-Y');

            $userName = Auth::user()->name;

            $customer = Customer::where('customerId',$vehicle->customerId)->first();

            return view('admin.vehicleManagement.checkOutVehicle',compact('vehicle','items','date','userName','customer','invoiceId','maintenance','serviceId'));

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

            $items = Cache::get('itemInvoiceData', []);

            // Filter out the item with the given unique ID
            $updatedItems = array_filter($items, function ($item) use ($id) {
                return $item['id'] !== $id; // Keep only items that don't match the given ID
            });


            Cache::put('itemInvoiceData', array_values($updatedItems)); // Re-index and store


            return back()->with('message', 'Item removed successfully.');

    }

    public function CompleteCheckOut(Request $request){

        // dd($request->all());

        $request->validate([
            'milage' => 'required|numeric',
            'lService' => 'required|numeric',
            'lBrake' => 'required|numeric',
            'lOil' => 'required|numeric',
            'lEngine' => 'required|numeric',
        ],[
            'milage.required' => 'Pleace enter total Milage',
            'lService.required' => 'Pleace enter last Service Milage',
            'lBrake.required' => 'Pleace enter last Brake Milage',
            'lOil.required' => 'Pleace enter last Oil Milage',
            'lEngine.required' => 'Pleace enter last Engine Milage',
        ]);

        Vehicle::where(['vehicleId' => $request->vehicleId])->update([
            'checkIn' => 0,
            'milage' => $request->milage,
        ]);

        $maintenance = Maintenance::where('vehicleId', $request->vehicleId)->first();

        $updateData = [
            'totalMilage' => $request->milage,
        ];

        // Check and update each field only if it has changed
        if ($request->lService != $maintenance->lastService) {
            $updateData['lastService'] = $request->lService;
            $updateData['lServiceDate'] = now();
        }

        if ($request->lBrake != $maintenance->lastBrake) {
            $updateData['lastBrake'] = $request->lBrake;
            $updateData['lBrakeDate'] = now();
        }

        if ($request->lOil != $maintenance->lastOil) {
            $updateData['lastOil'] = $request->lOil;
            $updateData['lOilDate'] = now();
        }

        if ($request->lEngine != $maintenance->lastEngine) {
            $updateData['lastEngine'] = $request->lEngine;
            $updateData['lEngineDate'] = now();
        }

        if ($request->lTire != $maintenance->lastTire) {
            $updateData['lastTire'] = $request->lTire;
            $updateData['lTireDate'] = now();
        }

        // Finally update only what changed
        $maintenance->update($updateData);

        $items = Cache::get('itemInvoiceData');

        $invoiceId = Cache::get('invoiceId');
        $serviceId = Cache::get('serviceId');


        $invoice = new Invoice();
        $invoice->invoiceId = $invoiceId;
        $invoice->invoiceDate = $request->invoiceDate;
        $invoice->vehicleId = $request->vehicleId;
        $invoice->customerId = $request->customerId;
        $invoice->serviceId = $serviceId;
        $invoice->subTotal = $request->subTotal;
        $invoice->isActive = 1;
        $invoice->save();


        if(!empty($items)){

            foreach($items as $item){

                $detail = new InvoiceDetail();
                $detail->invoiceId = $invoiceId;
                $detail->description = $item['description'];
                $detail->quantity = $item['quantity'];
                $detail->price = $item['price'];
                $detail->discount = $item['discount'];
                $detail->total = $item['total'];
                $detail->save();
            }
        }

        $service = new Service();
        $service->serviceId = $serviceId;
        $service->vehicleId = $request->vehicleId;
        $service->customerId = $request->customerId;
        $service->serviceDate = $request->invoiceDate;
        $service->isActive = 1;
        $service->save();



        if (!empty($request->check)) {
            foreach ($request->check as $index => $check) {
                // Check if the corresponding deficiencies and service exist
                $deficiency = $request->deficiencies[$index] ?? null;
                $servicePerformed = $request->service[$index] ?? null;

                $serviceDetail = new ServiceDetail();
                $serviceDetail->serviceId = $service->serviceId;
                $serviceDetail->inspection = $check;
                $serviceDetail->Deficiencies = $deficiency;
                $serviceDetail->service = $servicePerformed;
                $serviceDetail->checkId = $index;
                $serviceDetail->save();
            }
        }

        Cache::flush();


         return redirect('/printCheckOut/'.$invoice->invoiceId .'/'.$service->serviceId)->with('message','Checkout Complete');

    }

    public function PrintCheckOut($invoiceId, $serviceId){

        $invoice = Invoice::join('customers','invoices.customerId','=','customers.customerId')
            ->join('vehicles','invoices.vehicleId','=','vehicles.vehicleId')
            ->select('invoices.*','customers.name','vehicles.numberPlate')
            ->where('invoices.isActive',1)
            ->where('invoices.invoiceId',$invoiceId)
            ->first();

        $invoiceItems = InvoiceDetail::where('invoiceId',$invoiceId)
                ->orderby('id','desc')
                ->get();

        // $service = Service::join('vehicles','services.vehicleId','=','services.vehicleId')
        //         ->select('services.*','vehicles.*')
        //         ->where('services.isActive',1)
        //         ->where('services.serviceId',$serviceId)
        //         ->first();

        $service = Service::where('isActive',1)
                ->where('serviceId',$serviceId)
                ->first();

        $vehicle = Vehicle::where('vehicleId',$service->vehicleId)
        ->first();

        $serviceDetails = ServiceDetail::where('serviceId',$serviceId)
                ->orderby('id','desc')
                ->get();

        return view('admin.VehicleManagement.printCheckOut',compact('invoice','invoiceItems','service','serviceDetails','vehicle'));

    }

    public function getVehicleDetails($id)
    {

        $vehicle = Vehicle::where('id',$id)
            ->first();

        $vin = $vehicle->vin;

        $data = $this->vehicleService->getVehicleDetails($vin);

        return view('admin.VehicleManagement.vehicleSpecs', ['response' => $data , 'vehicle' => $vehicle]);
    }

    public function PastRecords($vehicleId){

        // $data = Service::where('isActive',1)
        //     ->where('vehicleId',$vehicleId)
        //     ->orderby('created_at','desc')
        //     ->get();

        $data = Service::join('invoices','services.serviceId','=','invoices.serviceId')
            ->select('services.*','invoices.invoiceId')
            ->where('services.isActive',1)
            ->where('services.vehicleId',$vehicleId)
            ->orderby('services.created_at','desc')
            ->get();


        $vehicle = Vehicle::join('customers','vehicles.customerId','=','customers.customerId')
            ->select('vehicles.*','customers.name')
            ->where('vehicleId',$vehicleId)
            ->first();

        return view('admin.VehicleManagement.VehiclePastRecords',compact('data', 'vehicle'));
    }

    public function GetServiceRecord($serviceId){

        // $service = Service::join('vehicles','services.vehicleId','=','services.vehicleId')
        //         ->select('services.*','vehicles.*')
        //         ->where('services.isActive',1)
        //         ->where('services.serviceId',$serviceId)
        //         ->first();

        $service = Service::where('isActive',1)
                ->where('serviceId',$serviceId)
                ->first();

        $vehicle = Vehicle::where('vehicleId',$service->vehicleId)
        ->first();

        $serviceDetails = ServiceDetail::where('serviceId',$serviceId)
                ->orderby('id','desc')
                ->get();



        return view('admin.VehicleManagement.serviceRecord',compact('service','serviceDetails','vehicle'));


    }

    public function GetWithInvoice($invoiceId, $serviceId){

        $invoice = Invoice::join('customers','invoices.customerId','=','customers.customerId')
            ->join('vehicles','invoices.vehicleId','=','vehicles.vehicleId')
            ->select('invoices.*','customers.name','vehicles.numberPlate')
            ->where('invoices.isActive',1)
            ->where('invoices.invoiceId',$invoiceId)
            ->first();

        $invoiceItems = InvoiceDetail::where('invoiceId',$invoiceId)
                ->orderby('id','desc')
                ->get();

        // $service = Service::join('vehicles','services.vehicleId','=','services.vehicleId')
        //         ->select('services.*','vehicles.*')
        //         ->where('services.isActive',1)
        //         ->where('services.serviceId',$serviceId)
        //         ->first();

        $service = Service::where('isActive',1)
                ->where('serviceId',$serviceId)
                ->first();

        $vehicle = Vehicle::where('vehicleId',$service->vehicleId)
        ->first();

        $serviceDetails = ServiceDetail::where('serviceId',$serviceId)
                ->orderby('id','desc')
                ->get();

        return view('admin.VehicleManagement.printCheckOutCopy',compact('invoice','invoiceItems','service','serviceDetails','vehicle'));

    }

}
