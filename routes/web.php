<?php
use App\Http\Controllers\MeetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\employeeTaskController;
use App\Http\Controllers\HRProblemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MHolidayController;
use App\Http\Controllers\problemController;
use App\Http\Controllers\sittingController;

// Routes for public access
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {return view('pages.login');})->name('pages.login'); 

Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');


// Protected routes (requires authentication)
Route::group(['middleware' => ['auth:sanctum']], function () {
   



// HR routes
    Route::get('/hr/dashboard', function () {
        return view('pages.hr.dashboard');
    })->name('pages.hr.dashboard')->middleware('restrictRole:admin');
   
    // Route to display the employee creation form
Route::get('hr/createEmployee', [EmployeeController::class, 'create'])->name('pages.hr.create_employee')->middleware('restrictRole:admin');

// Route to handle the form submission and store the employee
Route::post('hr/createEmployee', [EmployeeController::class, 'store'])->name('pages.hr.store_employee')->middleware('restrictRole:admin');



Route::get('hr/createTask', [TaskController::class, 'create'])->name('pages.hr.create_task')->middleware('restrictRole:admin');
Route::post('hr/createTask', [TaskController::class, 'store'])->name('pages.hr.store_task')->middleware('restrictRole:admin');



Route::get('hr/message/problem', [HRProblemController::class, 'viewProblems'])->name('message_problem')->middleware('restrictRole:admin');

Route::get('hr/employee/holidays', [MHolidayController::class, 'hrView'])->name('pages.hr.message_holiday')->middleware('restrictRole:admin');
Route::post('hr/employee/holidays/{id}/{action}', [MHolidayController::class, 'updateHolidayAction'])->name('update_holiday_action')->middleware('restrictRole:admin');

Route::get('hr/message/meeting', [MeetController::class, 'create'])->name('message_meeting')->middleware('restrictRole:admin');
Route::post('hr/message/meeting', [MeetController::class, 'store'])->name('store_meeting')->middleware('restrictRole:admin');
Route::delete('hr/message/meeting/{id}', [MeetController::class, 'destroy'])->name('delete_meeting')->middleware('restrictRole:admin');

Route::get('hr/createTeam', [TeamController::class, 'create'])->name('pages.hr.create_team')->middleware('restrictRole:admin');
Route::post('hr/createTeam', [TeamController::class, 'store'])->name('pages.hr.store_team')->middleware('restrictRole:admin');

//end of hr rotes




// employee rotes

Route::get('/employee/dashboard', function () {
    return view('pages.employee.dashboard');
})->name('pages.employee.dashboard')->middleware('restrictRole:employee');

Route::get('employee/message/holiday', [MHolidayController::class, 'create'])->name('pages.employee.message_holiday')->middleware('restrictRole:employee');
Route::post('employee/message/holiday', [MHolidayController::class, 'store'])->name('store_holiday')->middleware('restrictRole:employee');

Route::get('employee/message/meeting', [MeetController::class, 'employeeMeetings'])->name('employee_meeting')->middleware('restrictRole:employee');

Route::get('employee/profile/sitting', [SittingController::class, 'profileSitting'])->name('profile.sitting')->middleware('restrictRole:employee');
Route::put('employee/profile/update/{id}', [SittingController::class, 'updateProfile'])->name('updateprofile')->middleware('restrictRole:employee');



Route::get('employee/message/problem', [problemController::class, 'employeeProblem'])->name('employeeproblem')->middleware('restrictRole:employee');
Route::post('employee/message/problem', [problemController::class, 'storeProblem'])->name('store_problem')->middleware( 'restrictRole:employee');


Route::get('employee/message/task', [employeeTaskController::class, 'employeeTask'])->name('employeeTask')->middleware('restrictRole:employee');
Route::put('employee/message/task/{id}/end', [employeeTaskController::class, 'endTask'])->name('employeeTask.end')->middleware('restrictRole:employee');
//end of employee rotes
});