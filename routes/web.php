<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\productionManagerController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('home.login');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/user', function () {
    return view('user.userManagement');
});

//user
Route::post('login', [UserController::class, 'Login']);
Route::get('logout', [UserController::class, 'Logout']);
Route::get('userManagement', [UserController::class, 'UserManagement']);
Route::post('addUser', [UserController::class, 'AddUser']);
Route::get('changePasswordView{id}', [
    UserController::class,
    'ChangePasswordView',
]);
Route::post('changePassword', [UserController::class, 'ChangePassword']);
Route::get('editProfileView{id}', [UserController::class, 'EditProfileView']);
Route::post('editProfile', [UserController::class, 'EditProfile']);
Route::post('resetPassword', [UserController::class, 'ResetPassword']);
Route::get('disableUser{userId}', [UserController::class, 'DisableUser']);
Route::get('disabledUsers', [UserController::class, 'disabledUsers']);
Route::get('/userDashboard', [UserController::class, 'userDashboard']);


//supervisor
Route::get('supervisorDash', [SupervisorController::class, 'supervisorDash']);

//daily production
Route::get('dailyProduction', [SupervisorController::class, 'dailyProduction']);
Route::post('addDailyProduction', [
    SupervisorController::class,
    'addDailyProduction',
]);
Route::post('/editDailyProduction', [
    SupervisorController::class,
    'editDailyProduction',
]);
Route::get('/deleteDailyProduction{dailyProductionId}', [
    SupervisorController::class,
    'deleteDailyProduction',
]);

//training requirements
Route::get('trainingRequirement', [
    SupervisorController::class,
    'trainingRequirement',
]);
Route::post('/GetUsers', [SupervisorController::class, 'GetUsers']);
Route::post('addTrainingRequirement', [
    SupervisorController::class,
    'addTrainingRequirement',
]);
Route::get('/deleteTrainingRequirement{id}', [
    SupervisorController::class,
    'deleteTrainingRequirement',
]);

//leave request
Route::get('leaves', [SupervisorController::class, 'leaveRequest']);
Route::post('addLeaveRequest', [
    SupervisorController::class,
    'addLeaveRequest',
]);
Route::get('/deleteLeaveRequest{id}', [
    SupervisorController::class,
    'deleteLeaveRequest',
]);

//outsources
Route::get('outsource', [SupervisorController::class, 'outsource']);
Route::post('addOutsource', [SupervisorController::class, 'addOutsource']);
Route::post('/editOutsource', [SupervisorController::class, 'editOutsource']);
Route::get('/deleteOutsource{id}', [
    SupervisorController::class,
    'deleteOutsource',
]);

//////////////production manager////////////////////////////////////////////////
//dashboard
route::get('productionManagerDash', [
    productionManagerController::class,
    'dashboard',
]);

//efficiency and status
route::get('efficiencyStatus', [
    productionManagerController::class,
    'efficiencyStatus',
]);

//filter efficiency and status
Route::post('/filterEfficiencyStatus', [
    productionManagerController::class,
    'filterEfficiencyStatus',
]);

//chart demonstration
route::get('chartDemonstration', [
    productionManagerController::class,
    'chartDemonstration',
]);

/////////////////////////hr department/////////////////////////////////////////
//hr dashboard
route::get('hrDashboard', [HrController::class, 'hrDashboard']);
//employee management
route::get('employeeManagement', [HrController::class, 'employeeManagement']);
//add new employee
Route::post('/newEmployee', [HrController::class, 'addNewEmployee']);
//profile view
route::get('viewProfile', [HrController::class, 'viewProfile']);
//search employee
Route::post('/searchEmployee', [HrController::class, 'searchEmployee']);
//edit employee
Route::post('/editEmployee', [HrController::class, 'editEmployee']);
//delete employee
Route::get('/deleteEmployee{randomEmpId}', [
    HrController::class,
    'deleteEmployee',
]);
//inactive profile
route::get('inactiveProfile', [HrController::class, 'inactiveProfile']);
//inactive employee delete
Route::get('/deleteInactiveProfile{id}', [
    HrController::class,
    'deleteInactiveProfile',
]);
//hr training req
route::get('hrTrainingRequirement', [
    HrController::class,
    'hrTrainingRequirement',
]);

//outworkers evaluations
route::get('outsourceEvaluation', [
    HrController::class,
    'outsourceEvaluation',
]);

//leave Request
route::get('leaveRequestEmployees', [
    HrController::class,
    'leaveRequestEmployees',
]);



//student
route::get('/studentView', [StudentController::class, 'studentView']);
Route::post('/newStudent', [StudentController::class, 'addStudent']);
Route::post('/editStudent', [StudentController::class, 'editStudent']);
route::get('/deleteStudent{studentId}', [StudentController::class, 'deleteStudent']);