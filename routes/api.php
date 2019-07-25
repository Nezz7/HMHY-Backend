<?php

use Illuminate\Http\Request;

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


Route::get('email/verify/{id}', [
        'uses'=>'VerificationApiController@verify'
])->name('verificationapi.verify');;
Route::get('email/resend', [
        'uses'=>'VerificationApiController@resend'
]);
Route::post('login', 'UsersApiController@login');
Route::post('register', 'UsersApiController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UsersApiController@details')->middleware('verified');
}); // will work only when user has verified the email