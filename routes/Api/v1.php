<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Branch\MenuItemBranchController;
use App\Http\Controllers\Api\Branch\TableBranchController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\Employee\ReceptionistController;
use App\Http\Controllers\Api\Employee\WaiterController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\KitchenController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\MealItemController;
use App\Http\Controllers\Api\MenuSectionController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\TableSeatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('register',[AuthController::class,'register'])->name('register');

Route::middleware('auth:sanctum')
->group(function(){

    // Auth
    Route::put('update',[AuthController::class,'update']);

    // Manager
    Route::middleware('role:manager')->group(function(){ 
        Route::apiResource('restaurant',RestaurantController::class);
        Route::apiResource('branch',BranchController::class);
        Route::apiResource('employee',EmployeeController::class);
        Route::apiResource('kitchen',KitchenController::class);
        Route::apiResource('table',TableController::class);
        Route::apiResource('tableseat',TableSeatController::class);
        Route::apiResource('menu',MenuController::class);
        Route::apiResource('menusection',MenuSectionController::class);
        Route::apiResource('menuitem',MenuItemController::class);
        Route::apiResource('customer',CustomerController::class);
    }); 

    // Branch
    Route::get('branch/show/tables',TableBranchController::class);
    Route::get('branch/show/menuitem',MenuItemBranchController::class);

    // Receptionist 
    Route::middleware(['role:manager|receptionist'])->group(function(){
        Route::get('receptionist/customer',[ReceptionistController::class ,'searchCustomer']);
        Route::post('receptionist/customer',[CustomerController::class ,'store']);
        Route::get('receptionist/reserve',[ReceptionistController::class ,'showReservations']);
        Route::post('receptionist/reserve',[ReceptionistController::class ,'reserveTable']);
    });

    //customer
    Route::middleware(['role:manager|customer'])->group(function(){
        Route::post('receptionist/reserve',[ReceptionistController::class ,'reserveTable']);
    });

    // Waiter
    Route::middleware('role:manager|waiter')
    ->controller(WaiterController::class) 
    ->group(function(){
        Route::get('waiter/orders','showOrders');
        Route::post('waiter/order','addOrder');
        Route::post('waiter/meal','addMeal');
        Route::delete('waiter/meal','removeMeal');
        Route::post('waiter/item','addItem');
        Route::delete('waiter/item','removeItem');
    });


});


