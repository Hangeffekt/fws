<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;

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

Route::get("/vues", [ItemController::class, "index"]);
Route::prefix("/vue")->group (function () {
    Route::post("/vue", [ItemController::class, "store"]);
    Route::put("/{id}", [ItemController::class, "update"]);
    Route::delete("/{id}", [ItemController::class, "destroy"]);
});
