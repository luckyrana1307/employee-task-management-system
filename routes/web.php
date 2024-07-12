<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UpdateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\Auth\LoginController as EmployeeLoginController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;



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
Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.auth.login');
        Route::post('/login/post', [LoginController::class, 'login'])->name('admin.login');
    });
   });
   
   Route::middleware(['auth:admin'])->group(function () {
Route::prefix('admin')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
       
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    

//  employee 
Route::get('/employee/list', [EmployeeController::class,'index'])->name('admin.employee.list'); 
Route::get('/employee/add', [EmployeeController::class,'add'])->name('admin.employee.add'); 
Route::post('/employee/create', [EmployeeController::class,'create'])->name('admin.employee.create'); 
Route::post('/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
Route::post('/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
 


// Task routes
Route::get('/tasks/list', [TaskController::class, 'index'])->name('admin.task.list');
Route::get('/tasks/add', [TaskController::class, 'add'])->name('admin.task.add');
Route::post('/tasks/create', [TaskController::class, 'create'])->name('admin.task.create');
Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('admin.task.delete');
Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('admin.task.edit');
Route::post('/tasks/update', [TaskController::class, 'update'])->name('admin.task.update');

// CategoryController

Route::get('/categories', [CategoryController::class, 'index'])->name('admin.task.categories.list');
Route::get('/categories/add', [CategoryController::class, 'add'])->name('admin.task.categories.add');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.task.categories.store');
Route::post('/categories/delete', [CategoryController::class, 'delete'])->name('admin.task.categories.delete');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.task.categories.edit');
Route::post('/categories/update', [CategoryController::class, 'update'])->name('admin.task.categories.update');



// TagController


Route::get('/tag', [TagController::class, 'index'])->name('admin.task.tag.list');
Route::get('/tag/add', [TagController::class, 'add'])->name('admin.task.tag.add');
Route::post('/tag/store', [TagController::class, 'store'])->name('admin.task.tag.store');
Route::post('/tag/delete', [TagController::class, 'delete'])->name('admin.task.tag.delete');
Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('admin.task.tag.edit');
Route::post('/tag/update', [TagController::class, 'update'])->name('admin.task.tag.update');





// Departments
Route::get('/departments/list', [DepartmentController::class, 'index'])->name('admin.department.list');
Route::get('/departments/add', [DepartmentController::class, 'add'])->name('admin.department.add');
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('admin.department.store');
Route::post('/departments/delete', [DepartmentController::class, 'delete'])->name('admin.department.delete');
Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');
Route::post('/departments/update', [DepartmentController::class, 'update'])->name('admin.department.update');




// Admin Crud

Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.admin.list');
Route::get('/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
Route::post('/admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.admin.update');


Route::get('/admin/update/profile', [UpdateController::class, 'index'])->name('admin.admin.update.profile');
Route::post('/admin/update/store/profile', [UpdateController::class, 'update'])->name('admin.admin.store.profile');

});
});







Route::prefix('employee')->group(function () {
    Route::middleware(['guest:employee'])->group(function () {
        Route::get('/login', [EmployeeLoginController::class, 'index'])->name('employee.auth.login');
        Route::post('/login/post', [EmployeeLoginController::class, 'login'])->name('employee.login');
    });

    Route::middleware(['auth:employee'])->group(function () {
        Route::post('/logout', [EmployeeLoginController::class, 'logout'])->name('employee.logout');
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');

        Route::get('/tasks/assigned', [EmployeeTaskController::class, 'assignedTasks'])->name('employee.tasks.assigned');
        Route::post('/tasks/complete', [EmployeeTaskController::class, 'markComplete'])->name('employee.tasks.complete');
   
    });
}); 