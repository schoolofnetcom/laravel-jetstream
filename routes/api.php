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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/token_abilities', function(Request $request){
        $abilities = [];

        if ($request->user()->tokenCan('read')) {
            array_push($abilities, 'posso ler');
        }

        if ($request->user()->tokenCan('create')) {
            array_push($abilities, 'posso criar');
        }

        if ($request->user()->tokenCan('delete')) {
            array_push($abilities, 'posso deletar');
        }

        if ($request->user()->tokenCan('update')) {
            array_push($abilities, 'posso atualizar');
        }

        return $abilities;
    });
});
