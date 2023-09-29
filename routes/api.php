<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/* 
 Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json([ 'valid' => auth()->check() ]);
});  */


/*
 Route::middleware('auth:api')->group( function () {
    Route::post('logout', [UserController::class, 'logoutUser']);
}); 

*/




Route::controller(UserController::class)->group(function(){

    Route::post('register','createUser');
    Route::post('login','loginUser');

});
 
 

Route::controller(UserController::class)->group(function(){

    Route::post('logout','logoutUser');
    Route::get('user','getUserDetail');
    

})->middleware('auth:api');


/******Inventory Route  *******/

Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index')
    ->middleware('auth:api');

Route::get('inventory/{id}', [InventoryController::class, 'show'])->name('inventory.show')
    ->middleware('auth:api');

Route::post('inventory', [InventoryController::class, 'store'])->name('inventory.store')
    ->middleware('auth:api');

Route::patch('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update')
    ->middleware('auth:api');

/******Store Route  *******/

Route::get('store', [StoreController::class, 'index'])->name('store.index')
    ->middleware('auth:api');

Route::get('store/{id}', [StoreController::class, 'show'])->name('store.show')
    ->middleware('auth:api');

Route::post('store', [StoreController::class, 'store'])->name('store.store')
    ->middleware('auth:api');
    
Route::patch('store/{id}', [StoreController::class, 'update'])->name('store.update')
    ->middleware('auth:api'); 


/******Customer Route  *******/
Route::get('customer', [CustomerController::class, 'index'])->name('customer.index')
    ->middleware('auth:api');

Route::get('customer/{id}', [CustomerController::class, 'show'])->name('customer.show')
    ->middleware('auth:api');

Route::post('customer', [CustomerController::class, 'store'])->name('customer.store')
    ->middleware('auth:api');
    
Route::patch('customer/{id}', [CustomerController::class, 'update'])->name('customer.update')
    ->middleware('auth:api');
    
    
/****** order Route  *******/
Route::get('order', [OrderController::class, 'index'])->name('order.index')
    ->middleware('auth:api');

Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show')
    ->middleware('auth:api');

Route::post('order', [OrderController::class, 'store'])->name('order.store')
    ->middleware('auth:api');
    
Route::patch('order/{id}', [OrderController::class, 'update'])->name('order.update')
    ->middleware('auth:api');

/****** order Route  *******/
Route::get('report', [ReportController::class, 'index'])->name('report.index')
->middleware('auth:api');