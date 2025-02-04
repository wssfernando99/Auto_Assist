<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function EmployeeDetails()
    {

        $data = Employee::all();

        return view('admin.employeeManagement.employeeDetails',compact('data'));
    }
}
 