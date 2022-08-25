<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/items', function(){
    return "Items";
});

Route::prefix('/response/type')->group(function(){
    Route::get('/view', function(){
        return response()
            ->view('hello', ['name'=>'Raka Santang Rabbani']);
    });
    Route::get('/json', function(){
        $body = ['firstName'=>'Ahmad', 'lastName'=>'Budi'];
        return response()->json($body);
    });
});