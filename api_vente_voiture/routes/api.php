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

Route::group(['prefix' => 'params'], function () {

    //listing category vehicule
    Route::get('/type-vehicule', [OperationController::class,'getTypeVehicule']);

    //listing marque vehicule
    Route::get('/marques',  [OperationController::class,'getMarque']);

    //listing modele vehicule
    Route::get('/models',  [OperationController::class,'getModele']);

});//end params

Route::group(['prefix' => 'offer'], function () {

    //save vehicule
    Route::post('/save-vehicule', [OperationController::class,'saveVehicule']);

    //listing all vehicule
    Route::get('/vehicules',  [OperationController::class,'getVehicules']);

    //update vehicule
    Route::post('/update-vehicule',  [OperationController::class,'updateVehicule']);

    Route::post('/delete-vehicule',  [OperationController::class,'deleteVehicule']);

});//end params

