<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('pesantopup', 'Api\PesanTopUpController@index');
Route::get('pesantopup/{id}', 'Api\PesanTopUpController@show');
Route::post('pesantopup', 'Api\PesanTopUpController@store');
Route::put('pesantopup/{id}', 'Api\PesanTopUpController@update');
Route::delete('pesantopup/{id}', 'Api\PesanTopUpController@destroy');

Route::get('tambahnominal', 'Api\TambahNominalController@index');
Route::get('tambahnominal/{id}', 'Api\TambahNominalController@show');
Route::post('tambahnominal', 'Api\TambahNominalController@store');
Route::put('tambahnominal/{id}', 'Api\TambahNominalController@update');
Route::delete('tambahnominal/{id}', 'Api\TambahNominalController@destroy');
