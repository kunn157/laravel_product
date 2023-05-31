<?php

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/home', [App\Http\Controllers\User\UserController::class, 'index'])->name('home');
Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');
Route::get('admin/dashboard', function () {
    return view('admin.admin');
})->middleware('auth:admin')->name('hi');
Route::group(['prefix' => '/admin', 'middleware' => 'auth:admin'], function () {
    Route::resource('users', UserController::class);
});
Route::post('admin/fetch-district',[UserController::class,'fatchDistrict']);
Route::post('admin/fetch-commune',[UserController::class,'fatchCommune']);


Route::group(['prefix' => '/user', 'middleware' => 'auth'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('order', OrderController::class);
});
Route::get('/products/pdf', [ProductController::class, 'generatePDF'])->name('products.pdf');
Route::get('/products/csv', [ProductController::class, 'generateCSV'])->name('products.csv');
Route::get('user/order/pdf/{order}', [OrderController::class, 'generatePDF'])->name('order.pdf');
Route::get('lang/change', [App\Http\Controllers\User\UserController::class, 'change'])->name('changeLang');
