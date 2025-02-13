<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function CustomerDetails(){

        try{

            $data = Customer::join('users','customers.userId','=','users.userId')
                ->select('customers.*','users.name as userName')
                ->orderby('customers.id','desc')
                ->where('customers.isActive','=',1)
                ->get();

        return view('admin.customerManagement.customerDetails',compact('data'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }

    }

    public function AddCustomer(Request $request){

        try{

            $request->validate([
                'name' => 'required',
                'email' => 'nullable|email|unique:customers,email',
                'contact' => 'required|unique:customers,contact:digits:10|regex:/^[0-9]{10}$/',
                'address' => 'required',
                'brand' => 'required',
                'modelName' => 'required',
                'year' => 'required|numeric|digits:4|',
                'type' => 'required',
                'engine' => 'required',
                'numberPlate' => 'required',
                'milage' => 'required|numeric',
                'perMilage' => 'required|numeric',
            ],[
                'name.required' => 'Pleace enter vehicle Name',
                'email.email' => 'Email is not valid',
                'email.unique' => 'Email already exist',
                'contact.required' => 'Pleace enter contact',
                'contact.unique' => 'Contact already exist',
                'contact.digits' => 'Pleace enter valid contact',
                'contact.regex' => 'Pleace enter valid contact',
                'address.required' => 'Pleace enter address',
                'brand.required' => 'Pleace enter vehicle brand',
                'modelName.required' => 'Pleace enter vehicle model',
                'year.required' => 'Pleace enter vehicle year',
                'year.numeric' => 'Year must be numeric',
                'year.digits' => 'Pleace enter valid year',
                'type.required' => 'Pleace select vehicle type',
                'engine.required' => 'Pleace select vehicle engine type',
                'numberPlate.required' => 'Pleace enter vehicle number plate',
                'milage.required' => 'Pleace enter vehicle milage',
                'milage.numeric' => 'Milage must be numeric',
                'perMilage.required' => 'Pleace enter vehicle per milage',
                'perMilage.numeric' => 'Per milage must be numeric',

            ]);

            $customerId = 'CU_'.random_int(1000000, 9999999);

            if(Customer::where('customerId','=',$customerId)->exists()){

                $customerId = 'CU_'.random_int(1000000, 9999999);
            }


            $userId = Auth::user()->userId;

            $customer = new Customer();
            $customer->customerId = $customerId;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->contact = $request->contact;
            $customer->address = $request->address;
            $customer->isActive = 1;
            $customer->userId = $userId;
            $customer->check = 1;
            $customer->save();

            $vehicleId = 'VE_'.random_int(1000000, 9999999);

            if(Vehicle::where('vehicleId','=',$vehicleId)->exists()){
                $vehicleId = 'VE_'.random_int(1000000, 9999999);
            }

            $vehicle = new Vehicle();
            $vehicle->customerId = $customerId;
            $vehicle->vehicleId = $vehicleId;
            $vehicle->vehicleBrand = $request->brand;
            $vehicle->vehicleModel = $request->modelName;
            $vehicle->vehicleYear = $request->year;
            $vehicle->vehicleType = $request->type;
            $vehicle->engineType = $request->engine;
            $vehicle->numberPlate = $request->numberPlate;
            $vehicle->milage = $request->milage;
            $vehicle->milagePer = $request->perMilage;

            if($request->has('check')){
                $vehicle->check = 1;
            }else{
                $vehicle->check = 0;
            }
            $vehicle->isActive = 1;
            $vehicle->save();

            $maintenance = new Maintenance();
            $maintenance->vehicleId = $vehicleId;
            $maintenance->totalMilage = $request->milage;
            $maintenance->lastService = $request->milage;
            $maintenance->lastBrake = $request->milage;
            $maintenance->lastOil = $request->milage;
            $maintenance->lastEngine = $request->milage;
            $maintenance->isActive = 1;
            $maintenance->save();

            return redirect()->back()->with('message','Customer added successfully');



        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
        
    }

    public function EditCustomer(Request $request){
        try{

            $request->validate([
                'ename' => 'required',
                'eemail' => 'nullable|email',
                'econtact' => 'required|digits:10|regex:/^[0-9]{10}$/',
                'eaddress' => 'required',
            ],[
                'ename.required' => 'Pleace enter vehicle Name',
                'eemail.email' => 'Email is not valid',
                'econtact.required' => 'Pleace enter contact',
                'econtact.digits' => 'Pleace enter valid contact',
                'econtact.regex' => 'Pleace enter valid contact',
                'eaddress.required' => 'Pleace enter address',
            ]);

            if(Customer::where('email', $request->eemail)->where('isActive',1)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'eemail' => 'The email you entered is already taken.',
                ]);

            }else if(Customer::where('contact', $request->econtact)->where('isActive',1)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'econtact' => 'The contact you entered is already taken.',
                ]);

            }else{

                Customer::where(['id' => $request->id])->update([
                    'name' => $request->ename,
                    'email' => $request->eemail,
                    'contact' => $request->econtact,
                    'address' => $request->eaddress,
                ]);

                return redirect()->back()->with('message','Customer details edited successfully');
            }

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
