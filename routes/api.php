<?php

use App\Http\Controllers\api\NeracaDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeracaController;
use App\Http\Controllers\api\NeracaDataControllerInterface;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/dataProduksi', NeracaController::class,);
Route::resource('/dataNeraca', NeracaDataController::class);
