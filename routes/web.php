<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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
    Route::post('/addEmployee', [EmployeeController::class, 'AddEmployee']);
    Route::post('/editEmployee', [EmployeeController::class, 'EditEmployee']);
    Route::post('/deleteEmployee/{id}', [EmployeeController::class, 'DeleteEmployee']);

    //customer
    Route::get('/customerManagement', [CustomerController::class, 'CustomerDetails']);
    Route::post('/addCustomer', [CustomerController::class, 'AddCustomer']);
    Route::post('/editCustomer', [CustomerController::class, 'EditCustomer']);
    Route::get('/customerDetail/{customerId}', [CustomerController::class, 'ViewAll']);
    Route::post('/anotherVehicle', [CustomerController::class, 'AnotherVehicle']);
    Route::post('/editVehicle', [CustomerController::class, 'EditVehicle']);
    Route::post('/updateMaintenance', [CustomerController::class, 'UpdateMaintenance']);
    Route::post('/deleteVehicle', [CustomerController::class, 'DeleteVehicle']);
    Route::post('/deleteCustomer', [CustomerController::class, 'DeleteCustomer']);

    //Vehicle
    Route::get('/vehicleManagement', [VehicleController::class, 'VehicleDetails']);
    Route::post('/checkIn', [VehicleController::class, 'CheckIn']);
    Route::get('/checkInVehicles', [VehicleController::class, 'CheckInVehicles']);
    Route::post('/cancelCheckIn', [VehicleController::class, 'CancelCheckIn']);
    Route::get('/getcheckOutVehicle/{vehicleId}', [VehicleController::class, 'GetCheckOut']);
    Route::get('/vehicleDetails/{id}', [VehicleController::class, 'getVehicleDetails']);
    Route::get('/pastRecords/{vehicleId}', [VehicleController::class, 'PastRecords']);
    Route::get('/pastServiceLog/{serviceId}', [VehicleController::class, 'GetServiceRecord']);
    Route::get('/getWithInvoice/{vehicleId}/{serviceId}', [VehicleController::class, 'GetWithInvoice']);

    //CheckOut Invoice
    Route::post('/itemInvoice', [VehicleController::class, 'ItemInvoice']);
    Route::get('/cancelCheckOut', [VehicleController::class, 'CancelCheckOut']);
    Route::get('/removeItem/{id}', [VehicleController::class, 'RemoveItem']);
    Route::post('/completeCheckOut', [VehicleController::class, 'CompleteCheckOut']);
    Route::get('/printCheckOut/{vehicleId}/{serviceId}', [VehicleController::class, 'PrintCheckOut']);

    //Inventory
    Route::get('/inventoryManagement', [InventoryController::class, 'ViewAllInventory']);
    Route::get('/allCategories', [InventoryController::class, 'ViewAllCategory']);
    Route::get('/allTransactions', [InventoryController::class, 'ViewAllTransactions']);
    Route::get('/allSuppliers', [InventoryController::class, 'ViewAllSuppliers']);
    Route::post('/addCategory', [InventoryController::class, 'AddCategory']);
    Route::post('/editCategory', [InventoryController::class, 'EditCategory']);
    Route::post('/deleteCategory', [InventoryController::class, 'DeleteCategory']);
    Route::post('/addSupplier', [InventoryController::class, 'AddSupplier']);
    Route::post('/editSupplier', [InventoryController::class, 'EditSupplier']);
    Route::post('/deleteSupplier', [InventoryController::class, 'DeleteSupplier']);
    Route::post('/addInventory', [InventoryController::class, 'AddInventory']);
    Route::post('/editInventory', [InventoryController::class, 'EditInventory']);
    Route::post('/deleteInventory', [InventoryController::class, 'DeleteInventory']);
    Route::post('/makeTransaction', [InventoryController::class, 'MakeTransaction']);

    //Maintain
    Route::get('/maintainManagement', [MaintainController::class, 'AllMaintains']);
    Route::get('/prediction', [MaintainController::class, 'Prediction']);
    Route::get('/maintains/latest', [MaintainController::class, 'fetchLatest']);

});
