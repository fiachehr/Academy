<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseLessonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonHomeworkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinancialController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthenticationController::class, 'index'])->name('authentication.index');
Route::post('/auth/login', [AuthenticationController::class, 'login'])->name('authentication.login');

Route::get('/auth/signup', [AuthenticationController::class, 'signup'])->name('authentication.signup');
Route::post('/auth/register', [AuthenticationController::class, 'register'])->name('authentication.register');

Route::get('/auth/loginByGoogle', [AuthenticationController::class, 'loginByGoogle'])->name('authentication.loginByGoogle');
Route::get('/auth/handleGoogleCallback', [AuthenticationController::class, 'handleGoogleCallback'])->name('authentication.handleGoogleCallback');

Route::get('/auth/forgetPassword', [AuthenticationController::class, 'forgetPassword'])->name('authentication.forgetPassword');

Route::group(['middleware' => ['auth','user.access']], function () {

    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('course', CourseController::class);

    Route::get('lesson/index/{id}', [CourseLessonController::class, 'index'])->name('lesson.index');
    Route::get('lesson/create/{id}', [CourseLessonController::class, 'create'])->name('lesson.create');
    Route::post('lesson/store', [CourseLessonController::class, 'store'])->name('lesson.store');
    Route::get('lesson/edit/{id}', [CourseLessonController::class, 'edit'])->name('lesson.exit');
    Route::patch('lesson/update/{id}', [CourseLessonController::class, 'update'])->name('lesson.update');
    Route::delete('lesson/destroy/{id}', [CourseLessonController::class, 'destroy'])->name('lesson.destroy');

    Route::get('homework/index/{id}', [LessonHomeworkController::class, 'index'])->name('homework.index');
    Route::get('homework/create/{id}', [LessonHomeworkController::class, 'create'])->name('homework.create');
    Route::post('homework/store', [LessonHomeworkController::class, 'store'])->name('homework.store');
    Route::get('homework/edit/{id}', [LessonHomeworkController::class, 'edit'])->name('homework.exit');
    Route::patch('homework/update/{id}', [LessonHomeworkController::class, 'update'])->name('homework.update');
    Route::delete('homework/destroy/{id}', [LessonHomeworkController::class, 'destroy'])->name('homework.destroy');

    Route::get('shop/{id}', [ShopController::class, 'index'])->name('shop.index');
    Route::post('shop/payment', [ShopController::class, 'payment'])->name('shop.payment');
    Route::get('shop/verify/{referenceID}', [ShopController::class, 'verify'])->name('shop.verify');

    Route::get('financial', [FinancialController::class, 'index'])->name('financial.index');
    Route::get('financial/report', [FinancialController::class, 'report'])->name('financial.report');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/auth/profile', [AuthenticationController::class, 'profile'])->name('authentication.profile');
    Route::post('/auth/editProfile', [AuthenticationController::class, 'editProfile'])->name('authentication.editProfile');
    Route::get('/auth/changePassword', [AuthenticationController::class, 'changePassword'])->name('authentication.changePassword');
    Route::post('/auth/changePasswordAction', [AuthenticationController::class, 'changePasswordAction'])->name('authentication.changePasswordAction');
    Route::get('/auth/logout', [AuthenticationController::class, 'logout'])->name('authentication.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('panel.dashboard');
    Route::get('shop/myCourses/{type}', [ShopController::class, 'myCourses'])->name('shop.myCourses');
    Route::get('shop/courseView/{id}', [ShopController::class, 'courseView'])->name('shop.courseView');

});
