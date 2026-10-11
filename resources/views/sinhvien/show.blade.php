@extends('layouts.layoutmaster')
@section('title', 'Chi tiết sinh viên')

@section('content')
    <h1>Chi tiết sinh viên: {{ $sinhVien->ho_ten }}</h1>

    <table class="table">
        <tr><th style="width: 220px">ID</th><td>{{ $sinhVien->id }}</td></tr>
        <tr><th>Mã sinh viên</th><td>{{ $sinhVien->ma_sv }}</td></tr>
        <tr><th>Họ và tên</th><td>{{ $sinhVien->ho_ten }}</td></tr>
        <tr><th>Email</th><td>{{ $sinhVien->email ?? 'Chưa cập nhật' }}</td></tr>
        <tr><th>Số điện thoại</th><td>{{ $sinhVien->so_dien_thoai ?? 'Chưa cập nhật' }}</td></tr>
        <tr><th>Tuổi</th><td>{{ $sinhVien->tuoi ?? 'Chưa cập nhật' }}</td></tr>
        <tr><th>Địa chỉ</th><td>{{ $sinhVien->dia_chi ?? 'Chưa cập nhật' }}</td></tr>
        <tr>
            <th>Lớp học</th>
            <td>
                @if ($sinhVien->lopHoc)
                    <a href="{{ route('lophoc.show', $sinhVien->lopHoc) }}">{{ $sinhVien->lopHoc->ten_lop }} ({{ $sinhVien->lopHoc->ma_lop }})</a>
                @else
                    <span class="text-muted">Chưa phân lớp</span>
                @endif
            </td>
        </tr>
        <tr><th>Trạng thái</th><td>{{ $sinhVien->trang_thai ? 'Đang học (Hoạt động)' : 'Nghỉ học / Khóa' }}</td></tr>
        <tr><th>Ngày tạo</th><td>{{ $sinhVien->created_at?->format('d/m/Y H:i') }}</td></tr>
        <tr><th>Cập nhật lần cuối</th><td>{{ $sinhVien->updated_at?->format('d/m/Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('sinhvien.edit', $sinhVien) }}" class="btn btn-primary">Sửa</a>
    <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">Quay lại</a>
@endsection
