<?php

use App\Http\Controllers\MeetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MHolidayController;

// Routes for public access
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {
    return view('pages.login');
})->name('pages.login'); 

Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');


// Protected routes (requires authentication)
Route::group(['middleware' => ['auth:sanctum']], function () {
   

    // Admin route
    // Route::get('/admin', function () {
    //     return view('admin');
    // })->middleware('restrictRole:admin')->name('admin');

    // Employee route
    // Route::get('/employee', function () {
    //     return view('employee');
    // })->middleware('restrictRole:employee')->name('employee');

// hr
    Route::get('/hr/dashboard', function () {
        return view('pages.hr.dashboard');
    })->name('pages.hr.dashboard')->middleware('restrictRole:admin');
   
    // Route to display the employee creation form
Route::get('hr/createEmployee', [EmployeeController::class, 'create'])->name('pages.hr.create_employee')->middleware('restrictRole:admin');

// Route to handle the form submission and store the employee
Route::post('hr/createEmployee', [EmployeeController::class, 'store'])->name('pages.hr.store_employee')->middleware('restrictRole:admin');



Route::get('hr/createTask', [TaskController::class, 'create'])->name('pages.hr.create_task')->middleware('restrictRole:admin');
Route::post('hr/createTask', [TaskController::class, 'store'])->name('pages.hr.store_task')->middleware('restrictRole:admin');


Route::get('hr/message/problem',function(){
    return view('pages.hr.message_problem');
})->name('message_problem')->middleware('restrictRole:admin');

// HR routes
Route::get('hr/employee/holidays', [MHolidayController::class, 'hrView'])->name('pages.hr.message_holiday')->middleware('restrictRole:admin');
Route::post('hr/employee/holidays/{id}/{action}', [MHolidayController::class, 'updateHolidayAction'])->name('update_holiday_action')->middleware('restrictRole:admin');

Route::get('hr/message/meeting', [MeetController::class, 'create'])->name('message_meeting')->middleware('restrictRole:admin');
Route::post('hr/message/meeting', [MeetController::class, 'store'])->name('store_meeting')->middleware('restrictRole:admin');



Route::get('hr/createTeam', [TeamController::class, 'create'])->name('pages.hr.create_team')->middleware('restrictRole:admin');
Route::post('hr/createTeam', [TeamController::class, 'store'])->name('pages.hr.store_team')->middleware('restrictRole:admin');



// employee

Route::get('/employee/dashboard', function () {
    return view('pages.employee.dashboard');
})->name('pages.employee.dashboard')->middleware('restrictRole:employee');


Route::get('employee/message/holiday', [MHolidayController::class, 'create'])->name('pages.employee.message_holiday')->middleware('restrictRole:employee');
Route::post('employee/message/holiday', [MHolidayController::class, 'store'])->name('store_holiday')->middleware('restrictRole:employee');


});