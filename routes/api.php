<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["namespace" => "Api"], function () {
    Route::post('/register', 'Auth\AuthController@store');
    Route::group(['prefix' => 'webservice'], function () {
        Route::any('/cep', 'WebServiceController@cep');
    });

    Route::resource('/vehicles/photo', 'PhotoController')->only(['show']);

    Route::middleware('auth:api')->group(function () {
        Route::group(['prefix' => 'vehicles'], function () {            
            Route::resource('', 'VehicleController');
            Route::put('/update/{uuid}', 'VehicleController@update');
            Route::get('/{id}/type', 'VehicleController@type');
            Route::get('/{id}/brand', 'VehicleController@brand');
            Route::get('/{typeId}/{brandId}/model', 'VehicleController@model');
            Route::get('/{brandid}/{modelId}/version', 'VehicleController@version');
            Route::resource('/photo', 'PhotoController')->only(['store', 'update', 'destroy']);
        });
    });    
    
});
