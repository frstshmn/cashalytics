<?php

use App\Models\Point;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware(['auth'])->group(function () {
//    Route::get('/points', "App\Http\Controllers\PointController@pointsList")->name("points");
//    Route::get('/points/{id}', "App\Http\Controllers\PointController@singlePoint")->name("point");
//    Route::post('/points', "App\Http\Controllers\PointController@create");
//    Route::put('/points/{id}', "App\Http\Controllers\PointController@update");
//
//    Route::post('/pointgroups', "App\Http\Controllers\PointGroupController@create");
//
//    Route::get('/rates', "App\Http\Controllers\RateController@ratesList")->name("rates");
//    Route::post('/rates', "App\Http\Controllers\RateController@setRates");
//
//    Route::post('/currency-pairs', "App\Http\Controllers\CurrencyPairController@create");
//    Route::put('/currency-pairs/{id}', "App\Http\Controllers\CurrencyPairController@update");
//    Route::delete('/currency-pairs/{id}', "App\Http\Controllers\CurrencyPairController@delete");

//    Route::get('/employees', "App\Http\Controllers\UserController@employeesList")->name("employees");

//    Route::get('/analytics/total', function () {
//        return view('users.manager.analytics.dashboard');
//    });
//    Route::get('/analytics/points', function () {
//        return view('users.manager.analytics.points');
//    })->middleware("role:manager");

    Route::get('/exchange', "App\Http\Controllers\PointController@getExchangePage")->name("exchange")->middleware("role:cashier");
    Route::get('/points', "App\Http\Controllers\PointController@pointsLoginList")->name("points")->middleware("role:cashier");
    Route::post('/point-login', "App\Http\Controllers\PointController@login")->name("point-login")->middleware("role:cashier");
    Route::post('/point-logout', "App\Http\Controllers\PointController@logout")->name("point-logout")->middleware("role:cashier");

    Route::post('/cash-income', "App\Http\Controllers\PointCashController@income")->name("cash-income")->middleware("role:cashier");
    Route::post('/cash-withdraw', "App\Http\Controllers\PointCashController@withdraw")->name("cash-withdraw")->middleware("role:cashier");

    Route::get('/confirm-exchange', "App\Http\Controllers\PointCashController@confirmPage")->name("confirm-exchange")->middleware("role:cashier");
    Route::post('/refresh-exchange', "App\Http\Controllers\PointCashController@refreshExchange")->name("refresh-exchange")->middleware("role:cashier");
    Route::post('/cash-exchange', "App\Http\Controllers\PointCashController@exchange")->name("cash-exchange")->middleware("role:cashier");

    Route::get('/operations', "App\Http\Controllers\OperationController@getCashierPage")->name("operations")->middleware("role:cashier");
    Route::get('/cancel-operations', "App\Http\Controllers\OperationController@cancelOperation")->name("cancel-operation")->middleware("role:manager");


//    Route::get('/exchange', function () {
//        return view('users.cashier.dashboard');
//    })->middleware("role:cashier");

//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    });
});

require __DIR__.'/auth.php';
