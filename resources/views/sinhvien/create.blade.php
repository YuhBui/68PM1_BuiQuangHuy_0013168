@extends('layouts.layoutmaster')
@section('title', 'Thêm sinh viên')

@section('content')
    <h1>Thêm sinh viên</h1>

    {{-- novalidate: tắt kiểm tra của trình duyệt để thấy rõ lỗi do server (Form Request) trả về --}}
    <form action="{{ route('sinhvien.store') }}" method="POST" novalidate>
        @csrf
        @include('sinhvien._form')
        <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
        <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
