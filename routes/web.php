<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TippingController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\AdminCorporateController;
use App\Http\Controllers\AdminTipsController;
use App\Http\Controllers\TipController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin/login','admin/login');
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/hotel', [HotelController::class, 'index'])->name('admin.hotel');
Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
Route::post('/hotels/store', [HotelController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/admin/hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
Route::post('/admin/hotels/update/{id}', [HotelController::class, 'update'])->name('hotels.update');
Route::get('/admin/hotels/delete/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');


Route::get('/', [TippingController::class, 'showForm']);
Route::post('/submit-tip', [TippingController::class, 'submitTip'])->name('submit.tip');
Route::get('/payment', [TippingController::class, 'showPaymentPage'])->name('admin.pay');
Route::get('/totaltips/filter', [TippingController::class, 'filterTips'])->name('admin.totaltips');
Route::get('/totaltips/view', [TippingController::class, 'viewTips'])->name('admin.viewtips');


Route::get('/tips', [TipController::class, 'index'])->name('tips.index');
Route::post('/tips', [TipController::class, 'search'])->name('tips.search');


Route::get('admin/employees',[EmployeesController::class, 'index'])->name('admin.employees');

Route::get('employees/add', [EmployeesController::class, 'add'])->name('admin.employees.add');
Route::post('employees/insert', [EmployeesController::class, 'insertEmployee'])->name('admin.employees.insert');
Route::get('/admin/employees/view/{id}', [EmployeesController::class, 'viewEmployee']);
Route::get('admin/employees/edit/{id}', [EmployeesController::class, 'edit'])->name('admin.employees.edit');
Route::post('admin/employees/update_employee', [EmployeesController::class, 'update_employee'])->name('admin.employees.update');
Route::get('admin/employees/delete/{id}', [EmployeesController::class, 'delete']);



Route::get('admin/corporate',[CorporateController::class, 'index'])->name('admin.corporate');
Route::get('corporate/add', [CorporateController::class, 'add'])->name('admin.corporate.add');
Route::post('corporate/insert', [CorporateController::class, 'insertCorporate'])->name('admin.corporate.insert');
Route::get('admin/corporate/edit/{id}', [CorporateController::class, 'edit'])->name('admin.corporate.edit');
Route::post('admin/corporate/update_corporate', [CorporateController::class, 'update_corporate'])->name('admin.corporate.update');
Route::get('admin/corporate/delete/{id}', [CorporateController::class, 'delete']);

Route::get('/corporate/logout', [AdminCorporateController::class, 'corporatelogin']);
Route::view('corporate/login','corporate/login');
Route::get('/corporate/login', [AdminCorporateController::class, 'showLoginForm'])->name('corporate.login');


Route::post('/corporate/login', [AdminCorporateController::class, 'corporate'])->name('corporate.login');
Route::get('/corporate/dashboard',[AdminCorporateController::class, 'dashboard'])->name('corporate.dashboard');
Route::get('/corporate/dashboard/editprofile',[AdminCorporateController::class, 'editprofile']);

Route::post('/corporate/dashboard/update_profile', [AdminCorporateController::class, 'updateProfile']);
Route::get('/corporate/employees', [AdminCorporateController::class, 'employees']);

Route::get('corporate/employees/add', [AdminCorporateController::class, 'add']);

Route::post('corporate/employee/insert', [AdminCorporateController::class, 'insertCorporate']);

Route::get('/employee/login', [AdminEmployeeController::class, 'employee']);
Route::post('/employee/login', [AdminEmployeeController::class, 'login'])->name('employee.login');
Route::get('/employee/dashboard',[AdminEmployeeController::class, 'dashboard'])->name('employee.dashboard');
Route::get('/employee/logout', [AdminEmployeeController::class, 'employeelogin']);
Route::get('/employee/edit', [AdminEmployeeController::class, 'employeeedit']);
Route::post('employee/update_profile', [AdminEmployeeController::class, 'updateProfile']);
Route::get('/employee/tips', [AdminTipsController::class, 'index'])->name('employee.tips');


Route::get('/corporate/tips', [TipsCorporateController::class, 'index'])->name('corporate.tips');
Route::post('/corporate/tips', [TipsCorporateController::class, 'tips'])->name('corporate.tips.search');
Route::get('/corporate/tips/total', [TipsCorporateController::class, 'total'])->name('corporate.tips.total');
Route::get('/corporate/dashboardtips', [TipsCorporateController::class, 'dashboardtips'])->name('corporate.dashboardtips');