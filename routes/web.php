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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersonRoleController;

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
Auth::routes();


 Route::get('/', function () {
     return redirect('/login');
 });

 Route::group(['middleware' => ['auth']], function() {
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/campus',[CampusController::class, 'index']);
    Route::get('/departments','App\Http\Controllers\DepartmentController@index')->name('departments.index');

    //------------------------------ Person Listings Routes ------------------------------
    Route::get('/person_listings',[PersonController::class, 'index'])->name('person_listings');
    Route::post('person_listings/delete', 'App\Http\Controllers\PersonController@destroy')->name('person_listings.destroy');
    Route::post('person_listings/update', 'App\Http\Controllers\PersonController@update')->name('person_listings.update');
    Route::post('person_listings', [PersonController::class, 'store'])->name('person_listings.store');
    Route::post('person_listings/approve' , 'App\Http\Controllers\PersonController@approve')->name('person_listings.approve');
    Route::post('person_listings/reject', 'App\Http\Controllers\PersonController@reject')->name('person_listings.reject');


    //------------------------------ Department Groups Routes ------------------------------
    Route::get('/dept_groups',[DeptGroupController::class, 'index'])->name('dept_groups');
    Route::post('dept_groups/delete','App\Http\Controllers\DeptGroupController@destroy')->name('dept_groups.destroy');
    Route::post('dept_groups/update','App\Http\Controllers\DeptGroupController@update')->name('dept_groups.update');
    Route::post('dept_groups/create', [DeptGroupController::class, 'store'])->name('dept_groups.store');
    Route::post('dept_groups/approve' , 'App\Http\Controllers\DeptGroupController@approve')->name('dept_groups.approve');
    Route::post('dept_groups/reject', 'App\Http\Controllers\DeptGroupController@reject')->name('dept_groups.reject');


    //Route::get('/dept_groups',[DeptGroupController::class, 'index'])->name('dept_groups');
    Route::get('/dept_contacts',[DeptContactController::class, 'index'])->name('dept_contacts');
    Route::get('/manage_roles', [PersonRoleController::class, 'index'])->name('manage_roles');
    Route::put('/person_role/{id}',[PersonRoleController::class, 'update'])->name('person_role.update');
    Route::put('/dept_contacts/{id}',[DeptContactController::class, 'update'])->name('dept_contacts.update');
    Route::get('/department_listings',[DepartmentController::class, 'index'])->name('department_listings');
    Route::get('/announcements',[AnnouncementController::class, 'index'])->name('announcements');
    Route::get('/admins',[AdminController::class, 'index'])->name('admins');


    Route::get('/profile',[ProfileController::class, 'index'])->name('profile');
    Route::post('/save-announcement', [AnnouncementController::class, 'saveAnnouncement'])->name('save-announcement');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


