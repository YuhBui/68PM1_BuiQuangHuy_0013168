<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Chức năng Đăng nhập & Đăng ký (chỉ dành cho khách chưa đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Chức năng Đăng xuất (chỉ dành cho người đã đăng nhập)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Các chức năng quản trị (yêu cầu đăng nhập và trong giờ hành chính)
Route::middleware(['auth', 'check.gio.hanh.chinh'])->group(function () {
    Route::resource('sinhvien', SinhVienController::class);
    Route::resource('lophoc', LopHocController::class);
    Route::resource('menu', MenuController::class)->middleware('admin');
});
