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

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::get('email/verify/{id}', 'Api\VerificationApiController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'Api\VerificationApiController@resend')->name('verificationapi.resend');

Route::group(['middleware' => 'auth:api'],function(){
    Route::get('pesantopup', 'Api\PesanTopUpController@index');
    Route::get('pesantopup/{id}', 'Api\PesanTopUpController@show');
    Route::get('berlangganan', 'Api\BerlanggananController@index');
    Route::get('berlangganan/{id}', 'Api\BerlanggananController@show');
    Route::get('tambahnominal', 'Api\TambahNominalController@index');
    Route::get('tambahnominal/{id}', 'Api\TambahNominalController@show');
    
    Route::get('detailuser','Api\AuthController@detailUser');
    Route::put('updateuser','Api\AuthController@update');
    Route::get('logout','Api\AuthController@logout');
    
    Route::post('details', 'Api\AuthController@details')->middleware('verified');
    
    Route::post('pesantopup', 'Api\PesanTopUpController@store');
    Route::post('berlangganan', 'Api\BerlanggananController@store');
    Route::post('tambahnominal', 'Api\TambahNominalController@store');
    Route::put('pesantopup/{id}', 'Api\PesanTopUpController@update');
    Route::put('berlangganan/{id}', 'Api\BerlanggananController@update');
    Route::put('tambahnominal/{id}', 'Api\TambahNominalController@update');
    Route::put('pesantopup/confirm/{id}', 'Api\PesanTopUpController@confirm');
    Route::put('berlangganan/confirm/{id}', 'Api\BerlanggananController@confirm');
    
    Route::delete('pesantopup/{id}', 'Api\PesanTopUpController@destroy');
    Route::delete('berlangganan/{id}', 'Api\BerlanggananController@destroy');
    Route::delete('tambahnominal/{id}', 'Api\TambahNominalController@destroy');
    
   
});
