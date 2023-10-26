<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DeptGroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/campus',[CampusController::class, 'index']);
Route::get('/dept_group',[DeptGroupController::class, 'index'])->name('dept_group.index');
Route::delete('dept_group/{dept_grp}','App\Http\Controllers\DeptGroupController@destroy')->name('dept_group.destroy');
Route::put('dept_group/{dept_grp}','App\Http\Controllers\DeptGroupController@update')->name('dept_group.update');
Route::post('dept_group', [DeptGroupController::class, 'store'])->name('dept_group.store');
