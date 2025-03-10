<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GroupController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [UserController::class, 'dashboard'])->name('home');
Route::get('/home', [UserController::class, 'dashboard'])->name('home');

// Role Management (Admin Only)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/taskDashboard', [TaskController::class, 'index'])->name('task.index');
    
});

// User Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/taskCreate', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/taskUpdate', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');


    Route::resource('projects', ProjectController::class);
    Route::get('/projectsDashboard', [ProjectController::class, 'getAllProjects'])->name('projects.index');

    Route::get('/projectsEdit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');

    Route::post('/projectUpdate', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('projects/{project}/status', [ProjectController::class, 'changeStatus'])->name('projects.status');
    Route::post('projects/{project}/assign-user', [ProjectController::class, 'assignUser'])->name('projects.assignUser');
    Route::get('projects/{project}/timeline', [ProjectController::class, 'timeline'])->name('projects.timeline');

    //user
    Route::get('/user_Task', [ProjectController::class, 'user_Task'])->name('task.user_Task');
    Route::get('/subTask/{id}', [ProjectController::class, 'subTask'])->name('task.subTask');
    Route::put('/projects/{id}/update-priority', [ProjectController::class, 'updatePriority'])->name('projects.updatePriority');


    Route::resource('groups', GroupController::class);
    Route::get('/groupsDashboard', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/groupCreate', [GroupController::class, 'store'])->name('group.store');
    Route::get('/group/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
    Route::post('/groupUpdate', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/group/{group}', [GroupController::class, 'destroy'])->name('group.destroy');
});

