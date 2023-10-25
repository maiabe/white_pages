<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DeptGroupController;
use App\Http\Controllers\DeptContactController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminController;


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
Route::get('/dept_groups',[DeptGroupController::class, 'index'])->name('DeptGroups.dept_groups.index');
Route::delete('dept_groups/{dept_grp}','App\Http\Controllers\DeptGroupController@destroy')->name('dept_groups.destroy');
Route::put('dept_groups/{dept_grp}','App\Http\Controllers\DeptGroupController@update')->name('dept_groups.update');

Route::get('/dept_contacts',[DeptContactController::class, 'index'])->name('DeptContacts.dept_contacts.index');
Route::get('/department_listings',[DepartmentController::class, 'index'])->name('Departments.department_listings.index');
Route::get('/person_listings',[PersonController::class, 'index'])->name('People.person_listings.index');
Route::get('/announcements',[AnnouncementController::class, 'index'])->name('Announcements.announcements.index');
Route::get('/admins',[AdminController::class, 'index'])->name('Admins.admins.index');

