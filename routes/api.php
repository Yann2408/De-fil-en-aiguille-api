<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TissuController;

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

// Route::get('/test', [TestController::class, 'test']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });

Route::group(
    [
        'middleware' => ['auth:sanctum'],
    ],
    function ($router) {

        Route::group(
            ['prefix' => '/home'],
            function ($router) {
                Route::get('/', [HomeController::class, 'home']);
            }
        );

        Route::group(
            ['prefix' => '/tissus'],
            function ($router) {
                Route::get('/', [TissuController::class, 'getTissus']);
            }
        );
    }
);

