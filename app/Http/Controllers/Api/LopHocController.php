<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLopHocRequest;
use App\Http\Requests\UpdateLopHocRequest;
use App\Http\Resources\LopHocResource;
use App\Models\LopHoc;
use App\Traits\ApiResponse;

class LopHocController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(LopHocResource::collection(LopHoc::all()), 'Lấy danh sách lớp học thành công');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLopHocRequest $request)
    {
        $lopHoc = LopHoc::create($request->validated());

        return $this->success(new LopHocResource($lopHoc), 'Thêm mới lớp học thành công', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LopHoc $lopHoc)
    {
        return $this->success(new LopHocResource($lopHoc), 'Lấy thông tin lớp học thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLopHocRequest $request, LopHoc $lopHoc)
    {
        $lopHoc->update($request->validated());

        return $this->success(new LopHocResource($lopHoc), 'Cập nhật lớp học thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LopHoc $lopHoc)
    {
        $lopHoc->delete();

        return $this->success(null, 'Xóa lớp học thành công');
    }
}
