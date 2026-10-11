@extends('layouts.layoutmaster')
@section('title', 'Chi tiết lớp học')

@section('content')
    <h1>Chi tiết lớp học</h1>

    <table class="table">
        <tr><th style="width: 220px">ID</th><td>{{ $lopHoc->id }}</td></tr>
        <tr><th>Tên lớp</th><td>{{ $lopHoc->ten_lop }}</td></tr>
        <tr><th>Mã lớp</th><td>{{ $lopHoc->ma_lop }}</td></tr>
        <tr><th>Giáo viên</th><td>{{ $lopHoc->giao_vien }}</td></tr>
        <tr><th>Số điện thoại GVCN</th><td>{{ $lopHoc->so_dien_thoai_gvcn }}</td></tr>
        <tr><th>Ghi chú</th><td>{{ $lopHoc->ghi_chu }}</td></tr>
        <tr><th>Sĩ số</th><td>{{ $lopHoc->si_so }}</td></tr>
        <tr><th>Trạng thái</th><td>{{ $lopHoc->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}</td></tr>
    </table>

    <div class="mb-4">
        <a href="{{ route('lophoc.edit', $lopHoc) }}" class="btn btn-primary">Sửa</a>
        <a href="{{ route('lophoc.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <h3 class="mt-4">Danh sách sinh viên trong lớp ({{ $lopHoc->sinhViens->count() }})</h3>
    @if ($lopHoc->sinhViens->isNotEmpty())
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Tuổi</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lopHoc->sinhViens as $sv)
                    <tr>
                        <td>{{ $sv->ma_sv }}</td>
                        <td><a href="{{ route('sinhvien.show', $sv) }}">{{ $sv->ho_ten }}</a></td>
                        <td>{{ $sv->email ?? '-' }}</td>
                        <td>{{ $sv->so_dien_thoai ?? '-' }}</td>
                        <td>{{ $sv->tuoi ?? '-' }}</td>
                        <td>{{ $sv->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Chưa có sinh viên nào trong lớp này.</p>
    @endif
@endsection
