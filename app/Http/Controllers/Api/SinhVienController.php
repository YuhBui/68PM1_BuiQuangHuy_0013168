<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Http\Resources\SinhVienResource;
use App\Models\SinhVien;
use App\Traits\ApiResponse;

class SinhVienController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sinhViens = SinhVien::with('lopHoc')->get();

        return $this->success(SinhVienResource::collection($sinhViens), 'Lấy danh sách sinh viên thành công');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSinhVienRequest $request)
    {
        $sinhVien = SinhVien::create($request->validated());

        return $this->success(new SinhVienResource($sinhVien->load('lopHoc')), 'Thêm mới sinh viên thành công', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SinhVien $sinhVien)
    {
        return $this->success(new SinhVienResource($sinhVien->load('lopHoc')), 'Lấy thông tin sinh viên thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhVien)
    {
        $sinhVien->update($request->validated());

        return $this->success(new SinhVienResource($sinhVien->load('lopHoc')), 'Cập nhật sinh viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SinhVien $sinhVien)
    {
        $sinhVien->delete();

        return $this->success(null, 'Xóa sinh viên thành công');
    }
}
