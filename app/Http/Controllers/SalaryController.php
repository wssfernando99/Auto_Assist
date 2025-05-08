<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function AllSalaries(){

        try{

            $data = Salary::join('employees', 'employees.employeeId', '=', 'salaries.employeeId')
                ->select('salaries.*', 'employees.name', 'employees.employeeId')
                ->where('salaries.month', '=', date('m').'-'.date('y'))->get();


            return view('admin.salaryManagement.allSalaries', compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }

    public function UpdateSalary(Request $request){

        $request->validate([
            'bonus'     => ['required', 'regex:/^\d+(\.\d{2,})?$/'],
            'deduction' => ['required', 'regex:/^\d+(\.\d{2,})?$/'],
            'leave'     => ['required', 'integer'],
        ],[
            'bonus.required' => 'Bonus is required',
            'bonus.decimal' => 'Bonus must be a decimal number',
            'deduction.required' => 'Deduction is required',
            'deduction.decimal' => 'Deduction must be a decimal number',
            'leave.required' => 'Leave is required',
            'leave.integer' => 'Leave must be an integer',
        ]);

        try{

            $salary = Salary::where('id', $request->id)->first();

            $deduct = 0;

            if($request->leave != $salary->leave){
                if($request->leave > 3){

                    $addi = $request->leave - 3;
                    $deduct = $addi * 500;

                }else{
                    $deduct = 0;
                }
            }

            $addde = 0;

            if($salary->leave > 3){

                $addde = ($salary->leave-3) *500;
            }



            if($request->bonus != $salary->bonus){

                $addbonus = $request->bonus - $salary->bonus;
            }

            else{
                $addbonus = 0;
            }

            if($request->deduction != $salary->deduction){

                $adddeduction = $request->deduction - $salary->deduction;
            }
            else{
                $adddeduction = 0;
            }

            Salary::where('id', $request->id)->update([
                'bonus' => $request->bonus,
                'deduction' => $request->deduction,
                'leave' => $request->leave,
                'total' => $salary->total + $addbonus + $addde - $adddeduction - $deduct,
            ]);

            return redirect()->back()->with('success', 'Salary updated successfully!');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function Paid($id){

        try{

            Salary::where('id', $id)->update([
                'status' => 1,
            ]);

            return redirect()->back()->with('message', 'Salary marked as paid successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function UnPaid($id){
        try{

            Salary::where('id', $id)->update([
                'status' => 0,
            ]);

            return redirect()->back()->with('message', 'Salary marked as unpaid successfully!');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function ViewAllSalary(){

        try{

            $data = Salary::join('employees', 'employees.employeeId', '=', 'salaries.employeeId')
                ->select('salaries.*', 'employees.name', 'employees.employeeId')->get();

        return view('admin.salaryManagement.viewAllSalary', compact('data'));

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
