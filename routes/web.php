<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XraysearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\CountyDataController;


//Admin Login
// use App\Http\Controllers\Admin\Auth\AdminLoginController;


// Admin  Controllers
use App\Http\Controllers\Admin\BlogArticleController;
use App\Http\Controllers\Admin\UserEditController;
use App\Http\Controllers\Admin\LinkedinProfileController;
use App\Http\Controllers\Admin\LinkedinCompanyController;






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

    Route::get('/', function () {return redirect()->route('login');});
    Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('user.dashboard');
    Route::get('/to/countries', [CountyDataController::class, 'getCountries']);
    Route::get('/to/states', [CountyDataController::class, 'getStates']);
    Route::get('/to/cities', [CountyDataController::class, 'getCities']);


    // Routes for Admin, Superadmin, and Editor
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRole:admin,superadmin,editor']], function () {
        // Blog Manager Routes (accessible by admin, superadmin, and editor)
        Route::get('/dashboard', function () {return view('dashboard'); })->name('admin.dashboard');
        Route::get('/blog', [BlogArticleController::class, 'index'])->name('admin.blog.index');
        Route::get('/blog/create', [BlogArticleController::class, 'create'])->name('admin.blog.create');
        Route::post('/blog', [BlogArticleController::class, 'store'])->name('admin.blog.store');
        Route::get('/blog/{id}/edit', [BlogArticleController::class, 'edit'])->name('admin.blog.edit');
        Route::put('/blog/{id}', [BlogArticleController::class, 'update'])->name('admin.blog.update');
        Route::delete('/blog/{id}', [BlogArticleController::class, 'destroy'])->name('admin.blog.destroy');
    });

    // Routes for Admin and Superadmin only
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRole:admin,superadmin']], function () {
        Route::get('/dashboard', function () {return view('dashboard'); })->name('admin.dashboard');
        // LinkedIn Data Manager Routes
        Route::get('/linkedin-profiles', [LinkedinProfileController::class, 'index'])->name('admin.linkedin.index');
        Route::get('/linkedin-companies', [LinkedinCompanyController::class, 'index'])->name('admin.companies.index');

        // User Manager Routes
        Route::get('/users', [UserEditController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{id}/edit', [UserEditController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserEditController::class, 'update'])->name('admin.users.update');
        Route::get('/admin/users/create', [UserEditController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserEditController::class, 'store'])->name('admin.users.store');
        Route::delete('/admin/users/{id}', [UserEditController::class, 'destroy'])->name('admin.users.destroy');

       


    });

    

  
        // Routes accessible only by 'superadmin'
        Route::group(['middleware' => ['auth', 'checkRole:superadmin']], function () {
             // Only superadmin can access this route

            Route::get('/admin/superadmin-dashboard', function () {});
        });

        // Routes accessible by all authenticated users (including 'user')
        Route::group(['middleware' => ['auth']], function () {        
            Route::get('/x-ray-search', [XraysearchController::class, 'index'])->name('search');
            Route::get('/people', [DashboardController::class, 'showpeoples'])->name('people');
            Route::get('/companies', [DashboardController::class, 'showcompanies'])->name('companies');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });


        // Public Route anyone can access it
        Route::get('/blog/{slug}', [BlogArticleController::class, 'show'])->name('blog.show');
        
        // Route::group(['prefix' => 'admin'], function () {
        //     Route::get('/auth/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.auth.login');  // Show login form
        //     Route::post('/auth/login', [AdminLoginController::class, 'login'])->name('admin.auth.submit');  // Handle login
        // });
















require __DIR__.'/auth.php';