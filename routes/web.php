<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/{filter?}", [ProjectController::class, "projects"]);
/*Route::get("/", function () {
    return view('vue');
});*/
Route::post("createproject", [ProjectController::class, "createProject"])->name("createProject");

Route::get("/project/{id}", [ProjectController::class, "project"]);
Route::post("updateproject", [ProjectController::class, "updateProject"])->name("updateProject");
Route::post("deleteproject", [ProjectController::class, "deleteProject"])->name("deleteProject");