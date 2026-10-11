<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LopHocController;
use App\Http\Controllers\Api\SinhVienController;
use App\Http\Controllers\Api\MenuController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resources
Route::name('api.')->group(function () {
    Route::apiResource('lop-hoc', LopHocController::class);
    Route::apiResource('sinh-vien', SinhVienController::class);
    Route::apiResource('menu', MenuController::class);

    // Bổ sung alias không dấu gạch nối để hỗ trợ linh hoạt
    Route::apiResource('lophoc', LopHocController::class);
    Route::apiResource('sinhvien', SinhVienController::class);
});
