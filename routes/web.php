<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DeptGroupController;
use App\Http\Controllers\DeptContactController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProfileController;

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
Route::get('/departments','App\Http\Controllers\DepartmentController@index')->name('departments.index');

Route::get('/dept_groups',[DeptGroupController::class, 'index'])->name('dept_groups');
Route::post('dept_groups/delete','App\Http\Controllers\DeptGroupController@destroy')->name('dept_groups.destroy');
Route::post('dept_groups/update','App\Http\Controllers\DeptGroupController@update')->name('dept_groups.update');
Route::post('dept_groups/add', [DeptGroupController::class, 'store'])->name('dept_groups.store');

Route::get('/person_listings',[PersonController::class, 'index'])->name('person_listings');
// Route::delete('person_listings/{username}', 'App\Http\Controllers\PersonController@destroy')->name('person_listings.destroy');
Route::post('person_listings/{username}', 'App\Http\Controllers\PersonController@update')->name('person_listings.update');
Route::patch('person_listings/{username}' , 'App\Http\Controllers\PersonController@approve')->name('person_listings.approve');
Route::post('person_listings', [PersonController::class, 'store'])->name('person_listings.store');
Route::delete('person_listings/{username}', 'App\Http\Controllers\PersonController@reject')->name('person_listings.reject');

Route::get('/dept_contacts',[DeptContactController::class, 'index'])->name('dept_contacts');
Route::post('dept_contacts/delete','App\Http\Controllers\DeptContactController@destroy')->name('dept_contacts.destroy');
Route::post('dept_contacts/update','App\Http\Controllers\DeptContactController@update')->name('dept_contacts.update');
Route::post('dept_contacts/add', [DeptContactController::class, 'store'])->name('dept_contacts.store');

Route::get('/announcements',[AnnouncementController::class, 'index'])->name('announcements');
Route::get('/admins',[AdminController::class, 'index'])->name('admins');
Route::get('/profile',[ProfileController::class, 'index'])->name('profile');

