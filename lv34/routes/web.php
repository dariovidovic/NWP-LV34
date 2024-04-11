<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMembersController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/myProjects', [ProjectController::class, 'fetch'])->name('projects.fetch');
Route::post('/project-members', [ProjectMembersController::class, 'assign'])->name('project_members.assign');
Route::get('/projects/workingProjects', [ProjectMembersController::class, 'search'])->name('projects.search');




