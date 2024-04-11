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
Route::get('/projects/{projectId}/edit', [ProjectController::class, 'edit'])->name('edit.project');
Route::get('/projects/{projectId}/leadEdit', [ProjectController::class, 'leadEdit'])->name('leadEdit.project');
Route::put('/projects/{projectId}/update', [ProjectController::class, 'update'])->name('update.project');
Route::put('/projects/{projectId}/leadUpdate', [ProjectController::class, 'leadUpdate'])->name('leadUpdate.project');




