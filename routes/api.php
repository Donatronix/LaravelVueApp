<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\StudentsController;
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

Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
Route::get('/classes', [ClassesController::class, 'index']);
Route::get('/sections', [SectionsController::class, 'index']);

Route::delete('student/delete/{student}', [StudentsController::class, 'destroy']);
Route::delete('students/massDestroy/{students}', [StudentsController::class, 'massDestroy']);

Route::get('students/export/{students}', [StudentsController::class, 'export']);
