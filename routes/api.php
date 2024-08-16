<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LinkedinProfilesController;
use App\Http\Controllers\Api\LinkedinCompaniesController;
use App\Http\Controllers\User\Api\SavedProfileController;
use App\Http\Controllers\Api\Linkedin\LinkedinSearchesSaveController;
use App\Http\Controllers\Api\Extension\LinkedInProfilesSaverController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API routes

Route::post('linkedin-profile-save', [LinkedInProfilesSaverController::class, 'store'])->name('api.extesion.linkedin-profile-save');


Route::post('/linkedin/save-searches', [LinkedinSearchesSaveController::class, 'store'])->name('api.saveSearchsLinkedindata');
Route::post('/linkedin/save-profile', [SavedProfileController::class, 'saveProfile'])->name('api.saveSelectedProfiles');
Route::post('/linkedin/save-selected-profiles', [SavedProfileController::class, 'saveMultipleProfiles'])
    ->name('api.saveMultipleselectedProfiles');

// Routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('linkedin-profiles', [LinkedinProfilesController::class, 'index'])->name('api.linkedin-profiles-list');
    Route::get('linkedin-companies', [LinkedinCompaniesController::class, 'index'])->name('api.linkedin-companies-list');


    //Show saved profiles in user side
    Route::get('users-linkedin-profiles', [LinkedinProfilesController::class, 'showSelectedProfilesUserlist'])->name('api.user.linkedin-profiles-list');

});