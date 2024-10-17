<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\Application;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index', [
        'jobs'      => Job::with('company')->orderByDesc('salary')->limit(6)->get(),
        'companies' => Company::whereNotNull('name')->orderByDesc('rating')->limit(6)->get()
    ]);
});

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->can('create', Job::class);
Route::post('/jobs', [JobController::class, 'store'])->can('create', Job::class);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->can('update', 'job');
Route::patch('/jobs/{job}', [JobController::class, 'update'])->can('update', 'job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->can('delete', 'job');

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::get('/companies/{company}/jobs', [CompanyController::class, 'jobs'])->can('manage', 'company');
Route::get('/companies/{company}/applications', [CompanyController::class, 'applications'])->can('manage', 'company');
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->can('update', 'company');
Route::patch('/companies/{company}', [CompanyController::class, 'update'])->can('update', 'company');

Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->can('view', 'candidate');
Route::get('/candidates/{candidate}/applications', [CandidateController::class, 'applications'])->can('manage', 'candidate');
Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->can('update', 'candidate');
Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->can('update', 'candidate');

Route::post('/applications', [ApplicationController::class, 'store'])->can('create', Application::class);
Route::put('/applications/{application}', [ApplicationController::class, 'update'])->can('update', 'application');
Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->can('delete', 'application');

Route::get('/sign-up', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->can('update', 'user');
Route::patch('/users/{user}', [UserController::class, 'update'])->can('update', 'user');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->can('delete', 'user');