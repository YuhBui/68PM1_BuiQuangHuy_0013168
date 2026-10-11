<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\ApiResponse;

class MenuController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('thu_tu')->orderBy('id')->get();

        return $this->success(MenuResource::collection($menus), 'Lấy danh sách menu thành công');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->validated());

        return $this->success(new MenuResource($menu), 'Thêm mới menu thành công', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return $this->success(new MenuResource($menu), 'Lấy thông tin menu thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());

        return $this->success(new MenuResource($menu), 'Cập nhật menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return $this->success(null, 'Xóa menu thành công');
    }
}
