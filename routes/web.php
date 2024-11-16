<?php

use App\Http\Controllers\MeetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MHolidayController;

Route::get('/', function () {
    return view('pages.login');
});

// HR Dashboard route (protected with 'auth' middleware)
Route::get('/hr/dashboard', function () {
    return view('pages.hr.dashboard');
})->name('pages.hr.dashboard');


// Route to display the employee creation form
Route::get('hr/createEmployee', [EmployeeController::class, 'create'])->name('pages.hr.create_employee');

// Route to handle the form submission and store the employee
Route::post('hr/createEmployee', [EmployeeController::class, 'store'])->name('pages.hr.store_employee');



Route::get('hr/createTask', [TaskController::class, 'create'])->name('pages.hr.create_task');
Route::post('hr/createTask', [TaskController::class, 'store'])->name('pages.hr.store_task');


Route::get('hr/message/problem',function(){
    return view('pages.hr.message_problem');
})->name('message_problem');


// Employee routes
Route::get('employee/message/holiday', [MHolidayController::class, 'create'])->name('pages.employee.message_holiday');
Route::post('employee/message/holiday', [MHolidayController::class, 'store'])->name('store_holiday');

// HR routes
Route::get('hr/employee/holidays', [MHolidayController::class, 'hrView'])->name('pages.hr.message_holiday');
Route::post('hr/employee/holidays/{id}/{action}', [MHolidayController::class, 'updateHolidayAction'])->name('update_holiday_action');

Route::get('hr/message/meeting', [MeetController::class, 'create'])->name('message_meeting');
Route::post('hr/message/meeting', [MeetController::class, 'store'])->name('store_meeting');



Route::get('hr/createTeam', [TeamController::class, 'create'])->name('pages.hr.create_team');
Route::post('hr/createTeam', [TeamController::class, 'store'])->name('pages.hr.store_team');

// Employee Dashboard route (protected with 'auth' middleware)
Route::get('/employee/dashboard', function () {
    return view('pages.employee.dashboard');
})->name('pages.employee.dashboard');

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
