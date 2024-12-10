<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\SalaryStructureController;
use App\Http\controllers\manageEmployeeController;
use App\Http\controllers\viewEmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Department
    Route::get('/department', [DepartmentController::class, 'department'])->name('organization.department');
    Route::get('/department/store', [DepartmentController::class, 'add'])->name('organization.department.store');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('organization.department.store');
    Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('Organization.delete');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('Organization.edit');
    Route::put('/update/{id}', [DepartmentController::class, 'update'])->name('Organization.update');
    // Route::get('/Search/Department', [DepartmentController::class, 'searchDepartment'])->name('searchDepartment');

    // Salary Structure
    Route::get('/createSalary', [SalaryStructureController::class, 'createSalary'])->name('salary.create.form');
    Route::get('/viewSalary', [SalaryStructureController::class, 'viewSalary'])->name('salary.view');
    Route::post('/Salary/store', [SalaryStructureController::class, 'salaryStore'])->name('salary.store.data');
    Route::get('/Salary/delete/{id}', [SalaryStructureController::class, 'salaryDelete'])->name('salaryDelete');
    Route::get('/Salary/edit/{id}', [SalaryStructureController::class, 'salaryEdit'])->name('salaryEdit');
    Route::put('/Salary/update/{id}', [SalaryStructureController::class, 'salaryUpdate'])->name('salaryUpdate');

    // designation
    Route::get('/designationList', [DesignationController::class, 'designationList'])->name('organization.designationList');
    Route::get('/createdesignation', [DesignationController::class, 'designation'])->name('organization.designation');
    Route::post('/designation/store', [DesignationController::class, 'designationStore'])->name('organization.designation.store');
    
    Route::get('designation/delete/{id}', [DesignationController::class, 'delete'])->name('designation.delete');
    Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::put('designation/update/{id}', [DesignationController::class, 'update'])->name('Designation.update');
    // Route::get('/Search/Designation', [DesignationController::class, 'searchDesignation'])->name('searchDesignation');

    Route::get('/Employee/addEmployee', [manageEmployeeController::class, 'addEmployee'])->name('manageEmployee.addEmployee');
    Route::post('/manageEmployee/addEmployee/store', [manageEmployeeController::class, 'store'])->name('manageEmployee.addEmployee.store');
    Route::get('/Employee/viewEmployee', [viewEmployeeController::class, 'viewEmployee'])->name('manageEmployee.ViewEmployee');
    Route::get('/Employee/delete/{id}', [viewEmployeeController::class, 'delete'])->name('Employee.delete');
    Route::get('Employee/edit/{id}', [viewEmployeeController::class, 'edit'])->name('Employee.edit');
    Route::put('/Employee/update/{id}', [viewEmployeeController::class, 'update'])->name('Employee.update');
    Route::get('/Employee/profile/{id}', [viewEmployeeController::class, 'profile'])->name('Employee.profile');
    Route::get('/search-employee', [viewEmployeeController::class, 'search'])->name('employee.search');




    // Ajax call

    Route::POST('/employee/designation', [DesignationController::class, 'empdesignation']);
});


Route::get('/EMlogin', [EmployeeController::class, 'showLoginForm'])->name('EMlogin');
Route::post('/EMlogin', [EmployeeController::class, 'login']);
Route::get('/EMdashboard', [EmployeeController::class, 'dashboard'])->middleware('emp.auth')->name('EMdashboard');
Route::post('/EMlogout', [EmployeeController::class, 'logout'])->name('EMlogout');

require __DIR__.'/auth.php';

