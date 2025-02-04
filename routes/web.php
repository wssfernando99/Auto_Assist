<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.loginPage');
})->name('login');

Route::post('/login', [UserController::class, 'Login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/logout', [UserController::class, 'Logout']);
    Route::get('/adminDashboard', [PageController::class, 'AdminDashboard']);

    //Profile

    Route::get('/userProfile', [UserController::class, 'UserProfile']);
    Route::post('/editProfile', [UserController::class, 'EditProfile']);
    Route::get('/changePasswordView', [UserController::class, 'changePasswordView']);
    Route::post('/changePassword', [UserController::class, 'ChangePassword']);

    //user
    Route::get('/userManagement', [UserController::class, 'UserManagement']);
    Route::post('/addUser', [UserController::class, 'AddUser'])->name('addUser');
    Route::post('/editUser', [UserController::class, 'EditUser']);
    Route::post('/disableUser/{id}', [UserController::class, 'DisableUser']);
    Route::post('/enableUser/{id}', [UserController::class, 'ReactiveUser']);
    Route::post('/resetPassword', [UserController::class, 'ResetPassword']);
    Route::post('/deleteUser/{id}', [UserController::class, 'DeleteUser']);

    //employee
    Route::get('/employeeManagement', [EmployeeController::class, 'EmployeeDetails']);
    
});