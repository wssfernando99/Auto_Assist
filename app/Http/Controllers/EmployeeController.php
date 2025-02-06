<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function EmployeeDetails()
    {

        $data = Employee::join('users','users.userId','=','employees.userId')
            ->select('employees.*','users.name as userName')
            ->orderby('employees.id','desc')
            ->where('employees.isActive',1)
            ->get();

        return view('admin.employeeManagement.employeeDetails',compact('data'));
    }

    public function AddEmployee(Request $request){

        try{

            $request->validate([
                'name' => 'required',
                'email' => 'nullable|email|unique:employees,email',
                'contact' => 'required|digits:10|unique:employees|regex:/^[0-9]{10}$/',
                'address' => 'required',
                'nic' => 'required|min:10|max:12|unique:employees', 
                'gender' => 'required',
                'dob' => 'required',
                'emImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'position' => 'required',
                'salary' => 'numeric|required',
                'joiningDate' => 'required',
            ], [
                'name.required' => 'Please enter your name.',
                'email.email' => 'Please enter a valid email address.', 
                'email.unique' => 'This email is already in use.',
                'contact.required' => 'Please enter your contact number.',
                'contact.digits' => 'Please enter a 10-digit contact number.',
                'contact.unique' => 'This contact number is already in use.',
                'contact.regex' => 'Please enter a valid 10-digit contact number.',
                'address.required' => 'Please enter your address.',
                'nic.required' => 'Please enter your NIC number.',
                'nic.min' => 'Please enter a valid NIC number.',
                'nic.max' => 'Please enter a valid NIC number.',
                'nic.unique' => 'This NIC number is already in use.',
                'gender.required' => 'Please select your gender.',
                'dob.required' => 'Please enter your date of birth.',
                'emImage.image' => 'Please upload a valid image file.',
                'emImage.mimes' => 'Please upload a valid image file (JPEG, PNG, or JPG).',
                'emImage.max' => 'The image size should not exceed 2MB.',
                'position.required' => 'Please select your position.',
                'salary.numeric' => 'Please enter a valid salary amount.',
                'salary.required' => 'Please enter your salary.',
                'joiningDate.required' => 'Please enter your joining date.',
                
            ]);

            $userId = Auth::user()->userId;

            $employeeId = 'EM_' . random_int(1000000, 9999999);

            if(Employee::where('employeeId', $employeeId)->exists()) {

                $employeeId = 'EM_' . random_int(1000000, 9999999);
            }


            if(!empty($request->emImage)) {
                $imageName = $employeeId . '_' .$request->emImage->getClientOriginalName();
                $request->emImage->move(public_path('employeeImage'), $imageName);
            }else{
                $imageName = 'default.png';
            }

            $employee = new Employee();
            $employee->employeeId = $employeeId;
            $employee->userId = $userId;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->contact = $request->contact;
            $employee->address = $request->address;
            $employee->nic = $request->nic;
            $employee->gender = $request->gender;
            $employee->dob = $request->dob;
            $employee->emImage = $imageName;
            $employee->position = $request->position;
            $employee->salary = $request->salary;
            $employee->joiningDate = $request->joiningDate;
            $employee->isActive = 1;
            $employee->save();

            return redirect()->back()->with('message','Employee Added Successfully');


        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong');
        }
    }

    public function EditEmployee(Request $request){

        try{

            $request->validate([
                'ename' => 'required',
                'eemail' => 'nullable|email',
                'econtact' => 'required|digits:10|regex:/^[0-9]{10}$/',
                'eaddress' => 'required',
                'enic' => 'required|min:10|max:12', 
                'egender' => 'required',
                'edob' => 'required',
                'eemImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'eposition' => 'required',
                'esalary' => 'numeric|required',
                'ejoiningDate' => 'required',
            ], [
                'ename.required' => 'Please enter your name.',
                'eemail.email' => 'Please enter a valid email address.',
                'econtact.required' => 'Please enter your contact number.',
                'econtact.digits' => 'Please enter a 10-digit contact number.',
                'econtact.regex' => 'Please enter a valid 10-digit contact number.',
                'eaddress.required' => 'Please enter your address.',
                'enic.required' => 'Please enter your NIC number.',
                'enic.min' => 'Please enter a valid NIC number.',
                'enic.max' => 'Please enter a valid NIC number.',
                'egender.required' => 'Please select your gender.',
                'edob.required' => 'Please enter your date of birth.',
                'eemImage.image' => 'Please upload a valid image file.',
                'eemImage.mimes' => 'Please upload a valid image file (JPEG, PNG, or JPG).',
                'eemImage.max' => 'The image size should not exceed 2MB.',
                'eposition.required' => 'Please select your position.',
                'esalary.numeric' => 'Please enter a valid salary amount.',
                'esalary.required' => 'Please enter your salary.',
                'ejoiningDate.required' => 'Please enter your joining date.',
                
            ]);


            if(Employee::where('email', $request->eemail)->where('isActive',1)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'eemail' => 'The email you entered is already taken.',
                ]);

            }else if(Employee::where('contact', $request->econtact)->where('isActive',1)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'econtact' => 'The contact you entered is already taken.',
                ]);

            }else if(Employee::where('nic', $request->enic)->where('isActive',1)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'enic' => 'The NIC you entered is already taken.',
                ]);

            }else{

                $id = $request->id;

                $userId = Auth::user()->userId;

                $employee = Employee::find($id);

                $employeeId = $employee->employeeId;
    
                if(!empty($request->eemImage)) {
    
                    $imagePath = public_path('employeeImage/'. $employee->emImage);
    
                    if(file_exists($imagePath) && $employee->emImage !== 'default.png') {
    
                        unlink($imagePath);
                    }
    
                    $imageName = $employeeId . '_' .$request->eemImage->getClientOriginalName();
                    $request->eemImage->move(public_path('employeeImage'), $imageName);
                }else{
                    $imageName = $employee->emImage;
                }
    
                Employee::where(['id' => $id])->update([
                    'name' => $request->ename,
                    'email' => $request->eemail,
                    'position' => $request->eposition,
                    'contact' => $request->econtact,
                    'emImage' => $imageName,
                    'gender' => $request->egender,
                    'dob' => $request->edob,
                    'address' => $request->eaddress,
                    'nic' => $request->enic,
                    'salary' => $request->esalary,
                    'joiningDate' => $request->ejoiningDate,
                    'userId' => $userId,

                 ]);
                
                return redirect()->back()->with('message', 'Employee Details Edited Successfully');
            }

            

        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong');
        }
            
    }

    public function DeleteEmployee(Request $request){

        try {
            $id = $request->id;

            Employee::where(['id' => $id])->update([
                'isActive' => 0,

             ]);

             return redirect()->back()->with('message', 'Employee Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong');
        }
    }
}
 