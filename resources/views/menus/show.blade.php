@extends('layouts.layoutmaster')
@section('title', 'Chi tiết menu')

@section('content')
    <h1>Chi tiết menu: {{ $menu->ten }}</h1>

    <table class="table">
        <tr><th style="width: 220px">ID</th><td>{{ $menu->id }}</td></tr>
        <tr><th>Tên menu</th><td>{{ $menu->ten }}</td></tr>
        <tr><th>Đường dẫn (URL)</th><td><code>{{ $menu->url }}</code></td></tr>
        <tr><th>Vị trí</th><td>{{ \App\Models\Menu::VI_TRI[$menu->vi_tri] ?? $menu->vi_tri }}</td></tr>
        <tr><th>Nhóm</th><td>{{ $menu->nhom ?? 'Không có nhóm' }}</td></tr>
        <tr><th>Thứ tự</th><td>{{ $menu->thu_tu }}</td></tr>
        <tr><th>Trạng thái</th><td>{{ $menu->trang_thai ? 'Hiển thị (Hoạt động)' : 'Ẩn' }}</td></tr>
        <tr><th>Ngày tạo</th><td>{{ $menu->created_at?->format('d/m/Y H:i') }}</td></tr>
        <tr><th>Cập nhật lần cuối</th><td>{{ $menu->updated_at?->format('d/m/Y H:i') }}</td></tr>
    </table>

    <div class="mb-4">
        <a href="{{ route('menu.edit', $menu) }}" class="btn btn-primary">Sửa</a>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
@endsection
