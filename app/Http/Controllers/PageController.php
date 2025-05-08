<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Salary;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\ArchPresets\Custom;

class PageController extends Controller
{
    public function AdminDashboard()
    {

        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $role = Auth::user()->role;

        $monthYear = date('m') . '-' . date('y');

        $employees = Employee::where('isActive', 1)->get();

        foreach ($employees as $emp) {
            $exists = Salary::where('employeeId', $emp->employeeId)
                            ->where('month', $monthYear)
                            ->exists();

            if (!$exists) {
                $salary = new Salary();
                $salary->employeeId = $emp->employeeId;
                $salary->month = $monthYear;
                $salary->salary = $emp->salary;
                $salary->bonus = 0;
                $salary->deduction = 0;
                $salary->leave = 0;
                $salary->total = $emp->salary;
                $salary->status = 0;
                $salary->isActive = 1;
                $salary->save();
            }
        }

        $vehicleCount = Vehicle::where('isActive', '=', 1)->count();

        $vehicleCheckCount = Vehicle::where('isActive', '=', 1)->where('checkIn', '=', 1)->count();

        $customerCount = Customer::where('isActive', '=', 1)->count();

        $employeeCount = Employee::where('isActive', '=', 1)->count();

        $unpaid = Salary::where('month', '=', date('m').'-'.date('y'))->where('status', '=', 0)->count();

        $paid = Salary::where('month', '=', date('m').'-'.date('y'))->where('status', '=', 1)->count();

        $paidAmount = Salary::where('month', '=', date('m').'-'.date('y'))->where('status', '=', 1)->sum('total');
        $unpaidAmount = Salary::where('month', '=', date('m').'-'.date('y'))->where('status', '=', 0)->sum('total');

        $totalincome = Invoice::where('isActive', '=', 1)->sum('subTotal');


        return view('admin.adminDashboard',compact('name', 'vehicleCount', 'customerCount', 'employeeCount', 'unpaid', 'paid', 'paidAmount', 'unpaidAmount', 'vehicleCheckCount'
    , 'totalincome'));
    }
}
