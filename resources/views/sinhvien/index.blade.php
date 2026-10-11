@extends('layouts.layoutmaster')
@section('title', 'Danh sách sinh viên')

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            white-space: nowrap;
        }

        th a {
            color: inherit;
            text-decoration: none;
        }

        th a:hover {
            text-decoration: underline;
        }

        .filter-box {
            background: #fafcff;
            border: 1px solid #e1e8f0;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }
    </style>
@endpush

@section('content')
    <h1>Danh sách sinh viên</h1>
    <a href="{{ route('sinhvien.create') }}" class="btn btn-primary mb-3">Thêm sinh viên</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bộ lọc: form GET để tham số lọc nằm trên URL --}}
    <form action="{{ route('sinhvien.index') }}" method="GET" class="filter-box">
        {{-- Giữ nguyên cột đang sắp xếp khi bấm Lọc --}}
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="keyword" class="form-label">Từ khóa</label>
                <input type="text" id="keyword" name="keyword" class="form-control"
                       placeholder="Mã SV, họ tên, email, SĐT..." value="{{ $filters['keyword'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label for="lop_hoc_id" class="form-label">Lớp học</label>
                <select id="lop_hoc_id" name="lop_hoc_id" class="form-select">
                    <option value="">Tất cả lớp học</option>
                    @foreach ($lopHocs as $lopHoc)
                        <option value="{{ $lopHoc->id }}" @selected(($filters['lop_hoc_id'] ?? '') == (string) $lopHoc->id)>
                            {{ $lopHoc->ten_lop }} ({{ $lopHoc->ma_lop }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="tuoi" class="form-label">Tuổi</label>
                <input type="number" id="tuoi" name="tuoi" min="0" max="120" class="form-control"
                       placeholder="Nhập tuổi..." value="{{ $filters['tuoi'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Hoạt động</option>
                    <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Không hoạt động</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="perPage" class="form-label">Số dòng / trang</label>
                <select id="perPage" name="perPage" class="form-select" onchange="this.form.submit()">
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lọc</button>
                <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
            </div>
        </div>
    </form>

    <p>Tìm thấy <strong>{{ $sinhViens->total() }}</strong> sinh viên.</p>

    @php
        $columns = [
            'id' => 'ID',
            'ma_sv' => 'Mã SV',
            'ho_ten' => 'Họ tên',
            'email' => 'Email',
            'so_dien_thoai' => 'Số điện thoại',
            'tuoi' => 'Tuổi',
            'dia_chi' => 'Địa chỉ',
            'lop_hoc_id' => 'Lớp học',
            'trang_thai' => 'Trạng thái',
        ];
    @endphp

    <table>
        <tr>
            @foreach ($columns as $column => $label)
                <th>
                    @if (in_array($column, $sortable))
                        {{-- Bấm vào cột đang sắp xếp thì đảo chiều; đổi cột thì về lại trang 1 --}}
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort' => $column,
                            'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc',
                            'page' => null,
                        ]) }}">
                            {{ $label }}
                            @if ($sort === $column)
                                {{ $direction === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    @else
                        {{ $label }}
                    @endif
                </th>
            @endforeach
            <th>Thao tác</th>
        </tr>
        @forelse ($sinhViens as $sinhVien)
            <tr>
                <td>{{ $sinhVien->id }}</td>
                <td>{{ $sinhVien->ma_sv }}</td>
                <td><a href="{{ route('sinhvien.show', $sinhVien) }}">{{ $sinhVien->ho_ten }}</a></td>
                <td>{{ $sinhVien->email ?? '-' }}</td>
                <td>{{ $sinhVien->so_dien_thoai ?? '-' }}</td>
                <td>{{ $sinhVien->tuoi ?? '-' }}</td>
                <td>{{ $sinhVien->dia_chi ?? '-' }}</td>
                <td>
                    @if ($sinhVien->lopHoc)
                        <a href="{{ route('lophoc.show', $sinhVien->lopHoc) }}">{{ $sinhVien->lopHoc->ten_lop }}</a>
                    @else
                        <span class="text-muted">Chưa phân lớp</span>
                    @endif
                </td>
                <td>{{ $sinhVien->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('sinhvien.edit', $sinhVien) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <form action="{{ route('sinhvien.destroy', $sinhVien) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) + 1 }}" class="text-center">Không có sinh viên nào phù hợp.</td>
            </tr>
        @endforelse
    </table>

    <div class="mt-3">
        {{ $sinhViens->links() }}
    </div>
@endsection