<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Models\Address\Address;


Route::get('/search-address', [AddressController::class, 'search']);
Route::post('/save',[AddressController::class, 'store']);
Route::put('/update/{id}',[AddressController::class, 'update']);
Route::delete('/delete/{id}',[AddressController::class, 'destroy']);
route::get('/search/{id}',[AddressController::class, 'show']);
route::get('/',[AddressController::class, 'index']); 



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


