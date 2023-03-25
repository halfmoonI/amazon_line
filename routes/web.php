<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\BaseController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProductController;


// Homepage Route
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authentication Routes
Route::get('/signup/{role?}', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/loginview', [LoginController::class, 'loginview']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Main Routes
Route::group(['middleware' => ['auth']], function() {
    // User Management Routes
    Route::view('admin_page','mypage.admin_page')->name('admin_page');
    Route::view('change_pwd','mypage.change_pwd')->name('change_pwd');
    Route::post('check_pwd', [MypageController::class, 'check_pwd'])->name('check_pwd');
    Route::post('change_pwd', [MypageController::class, 'change_pwd'])->name('change_pwd');
    Route::view('change_info', 'mypage.change_info')->name('change_info');
    Route::post('change_info', [MypageController::class, 'change_info'])->name('change_info');
    Route::post('change_line', [MypageController::class, 'change_line'])->name('change_line');
    Route::get('delete_account', [MypageController::class, 'delete_account'])->name('delete_account');
    Route::get('permit_account', [MypageController::class, 'permit_account'])->name('permit_account');
    Route::post('save_user_setting', [MypageController::class, 'save_user_setting'])->name("save_user_setting");
    
    // Product Routes
    Route::view('register_product', 'mypage.register_product')->name('register_product');
    Route::get('list_product', [ProductController::class, 'list_product'])->name('list_product');
    Route::post('delete_product', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::post('remove_product', [ProductController::class, 'remove_product'])->name('remove_product');
    Route::get('scan', [ProductController::class, 'scan'])->name('scan');
    Route::get('csv_down', [ProductController::class, 'csv_down'])->name('csv_down');
    Route::get('csv_download', [ProductController::class, 'csv_download'])->name('csv_download');
    Route::get('stop', [ProductController::class, 'stop'])->name('stop');
    Route::get('restart', [ProductController::class, 'restart'])->name('restart');
    Route::view('notify_page',  'mypage.notify_page')->name('notify_page');
});

Route::middleware(['cors'])->group(function () {
    Route::get('http://localhost:32768/');
});