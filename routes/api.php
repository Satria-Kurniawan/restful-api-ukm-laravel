<?php

use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\UKMController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ukms', [UKMController::class, 'getUkmData']);
Route::get('ukms/{id}', [UKMController::class, 'getUkmDataById']);
Route::post('ukms', [UKMController::class, 'postUkmData']);
Route::post('ukms/{id}', [UKMController::class, 'updateUkmData']);
Route::delete('ukms/{id}', [UKMController::class, 'deleteUkmData']);
Route::get('ukms/search/{ukm}', [UKMController::class, 'searchUkm']);

Route::get('anggotas', [AnggotaController::class, 'getDataAnggota']);
Route::get('anggotas/{id}', [AnggotaController::class, 'getDataAnggotaById']);
Route::post('anggotas', [AnggotaController::class, 'postDataAnggota']);
Route::post('anggotas/{id}', [AnggotaController::class, 'updateDataAnggota']);
Route::delete('anggotas/{id}', [AnggotaController::class, 'deleteDataAnggota']);
Route::get('anggotas/search/{nama}', [AnggotaController::class, 'searchAnggota']);
