<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OperationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



    // Vos routes d'API nécessitant un accès cross-origin ici
    Route::group(['prefix' => 'params'], function () {

        //listing category vehicule
        Route::get('/vehicle-type', [OperationController::class,'getVehicleType']);

        //listing marque vehicule
        Route::get('/brand',  [OperationController::class,'getBrand']);

        //listing modele vehicule
        Route::get('/models',  [OperationController::class,'getModel']);

        Route::post('/create-model',  [OperationController::class,'createModel']);

        Route::post('/delete-model',  [OperationController::class,'deleteModel']);
        Route::post('/update-model',  [OperationController::class,'updateModel']);

        Route::post('/create-brand',  [OperationController::class,'createBrand']);
        Route::post('/delete-brand',  [OperationController::class,'deleteBrand']);
        Route::post('/update-brand',  [OperationController::class,'updateBrand']);

        Route::post('/create-category',  [OperationController::class,'createCategory']);

    });//end params





Route::group(['prefix' => 'offer'], function () {

    //save vehicule
    Route::post('/save-vehicle', [OperationController::class,'saveVehicle']);

    //listing all vehicule
    Route::get('/vehicles',  [OperationController::class,'getVehicles']);

    //update vehicule
    Route::post('/update-vehicle',  [OperationController::class,'updateVehicle']);

    Route::post('/delete-vehicle',  [OperationController::class,'deleteVehicle']);

    Route::post('/detail-vehicle',  [OperationController::class,'detailVehicle']);




});//end params

