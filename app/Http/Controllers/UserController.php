<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);


        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1])) {

                $id = Auth::user()->id;
                $name = Auth::user()->name;
                $userId = Auth::user()->userId;
                $role = Auth::user()->role;
                session()->put('id', $id);
                session()->put('userId', $userId);
                session()->put('name',$name);
                session()->put('role', $role);

                return redirect('/adminDashboard');
                
            } else if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 0])){

                return redirect()->back()->withInput($request->only('email'))->with('error', "Sorry! you can't access the system");
            }

            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid login credentials');
        } catch (Exception $e) {

            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid login credentials');
        }
    }

    public function Logout()
    {

        try {
            session()->forget('role');
            session()->forget('id');
            session()->forget('userId');
            session()->flush();

            return redirect('/');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function userProfile()
    {
        try {
            $id = session('id');
            $data = User::find($id);

            return view('admin.profile.adminUserProfile', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function EditProfile(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required',
                'contact' => 'required|digits:10|regex:/^[0-9]{10}$/',
            ],[
                'contact.required' => 'The contact number is required.',
                'contact.digits' => 'The contact number must be exactly 10 digits.',
                'contact.regex' => 'The contact number must contain only numbers (0-9).',
                'name.required' => 'The Name requied.',
            ]);

            $id = session('id');

            User::where(['id' => $id])->update([
                'name' => $request->name,
                'contact' => $request->contact,
            ]);
            return redirect()->back()->with('message', 'Your User Details Edited Successfully');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function ChangePasswordView()
    {
        try {
            return view('admin.profile.changePasswordPage');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function ChangePassword(Request $request)
    {
        try {
            $userId = session('id');
            $currentPassword = $request->cPwd;

            $request->validate([
                'newPwd' => 'required|min:6',
                'cPwd' => 'required',
            ], [
                'newPwd.min' => 'The new password field must be at least 6 characters.',
                'newPwd.required' => 'Pleace enter your new password.',
                'cPwd.required' => 'Pleace enter your old password.',
            ]);

            $newPassword = $request->newPwd;

            $user = User::find($userId);

            if (!$user) {
                return redirect()->back()->withErrors(['User not found.']);
            }

            if (Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
                $user->save();

                return redirect()->back()->with('message', 'Password changed successfully!');
            } else {
                return redirect()->back()->withErrors(['Your current password does not match the password you provided. Please try again.']);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function UserManagement()
    {
        try{

            $id = session('id');

            $data = User::whereNot('id',$id)->get();

            return view('admin.userManagement.userManagement',compact('data'));

        }catch (Exception $e){
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function AddUser(Request $request)
    {

        try {

            $request->validate([
                'profileImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'contact' => 'required|digits:10|unique:users|regex:/^[0-9]{10}$/',
                'role' => 'required',
                'password' => 'required|min:6',
            ],[
                'profileImage.image' => 'The image must be a valid image file.',
                'profileImage.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
                'profileImage.max' => 'The image may not be greater than 2 MB.',
                'contact.required' => 'The contact number is required.',
                'contact.digits' => 'The contact number must be exactly 10 digits.',
                'contact.unique' => 'The contact number has already been taken.',
                'contact.regex' => 'The contact number must contain only numbers (0-9).',
                'name.required' => 'The Name requied.',
                'role.required' => 'The Role requied.',
                'email.required' => 'The Email requied.',
                'email.email' => 'The email must be a valid email address.',
                'email.unique' => 'The email has already been taken.',
                'password.required' => 'The Password requied.',
                'password.min' => 'The password must be at least 6 characters.',
            ]);

            
            $userId = Str::random(7);

            if(User::where('userId',$userId)->exists()){
                $userId = Str::random(7);
            }

            if(!empty($request->profileImage)) {
                $imageName = $userId . '_' .$request->profileImage->getClientOriginalName();
                $request->profileImage->move(public_path('userProfileImage'), $imageName);
            }else{
                $imageName = 'default.png';
            }

             

            $user = new User();
            $user->userId = $userId;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->isActive = 1;
            $user->profileImage = $imageName;
            $user->save();

           

            return redirect()->back()->with('message', 'User Added Successfully !');

        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function EditUser(Request $request)
    {

        try {

            $id = $request->id;

            $request->validate([
                'eprofileImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'ename' => 'required',
                'eemail' => 'required|email',
                'econtact' => 'required|digits:10|regex:/^[0-9]{10}$/',
                'erole' => 'required',
            ],[
                'eprofileImage.image' => 'The image must be a valid image file.',
                'eprofileImage.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
                'eprofileImage.max' => 'The image may not be greater than 2 MB.',
                'econtact.required' => 'The contact number is required.',
                'econtact.digits' => 'The contact number must be exactly 10 digits.',
                'econtact.regex' => 'The contact number must contain only numbers (0-9).',
                'ename.required' => 'The Name requied.',
                'erole.required' => 'The Role requied.',
                'eemail.required' => 'The Email requied.',
                'eemail.email' => 'The email must be a valid email address.',
            ]);


            if(User::where('email', $request->eemail)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'eemail' => 'The email you entered is already taken.',
                ]);

            }else if(User::where('contact', $request->econtact)->whereNotIn('id', [$request->id])
            ->exists()){

                return back()->withErrors([
                    'econtact' => 'The contact you entered is already taken.',
                ]);

            }else{
                $user = User::find($id);

                $userId = $user->userId;
    
                if(!empty($request->eprofileImage)) {
    
                    $imagePath = public_path('userProfileImage'. $user->profileImage);
    
                    if(file_exists($imagePath)){
    
                        unlink($imagePath);
                    }
    
                    $imageName = $userId . '_' .$request->eprofileImage->getClientOriginalName();
                    $request->eprofileImage->move(public_path('userProfileImage'), $imageName);
                }else{
                    $imageName = $user->profileImage;
                }
    
                User::where(['id' => $id])->update([
                    'name' => $request->ename,
                    'email' => $request->eemail,
                    'role' => $request->erole,
                    'contact' => $request->econtact,
                    'profileImage' => $imageName,
                 ]);
                
                return redirect()->back()->with('message', 'User Details Edited Successfully');
            }

            

           
        }catch (ValidationException $e) {
            throw $e;
        }catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function DisableUser($id)
    {
        try {
            User::where('id' , $id)->update([
                'isActive' => 0
            ]);

            $user = User::find($id);
            
            return redirect()->back()->with('message', 'User Disabled Successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function ReactiveUser($id)
    {
        try {
            User::where('id', $id)->update([
                'isActive' => 1
            ]);


            return redirect()->back()->with('message', 'User Reactivated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function ResetPassword(Request $request)
    {

        try {
            $id = $request->id;

            User::where(['id' => $id])->update([
                'password' => Hash::make($request->pwd)
            ]);
            
            return redirect()->back()->with('message', 'Password Reset Successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }

    public function DeleteUser(Request $request)
    {

        try {
            $id = $request->id;

            $user = User::find($id);

            $user->delete();
            
            return redirect()->back()->with('message', 'Deleted successfully.');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Something Went Wrong']);
        }
    }
}
