@extends('layouts.auth')

@section('title', 'Đăng ký tài khoản - HUCE.Web')

@push('styles')
<style>
    .auth-card {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border: 1px solid #e1e8f0;
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(30, 58, 95, 0.12);
        padding: 36px 32px;
    }
    .auth-card .auth-logo {
        font-size: 24px;
        font-weight: 800;
        color: var(--c-header);
        text-align: center;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .auth-card .auth-logo span {
        color: var(--c-accent);
    }
    .auth-card .auth-header {
        text-align: center;
        margin-bottom: 24px;
    }
    .auth-card h2 {
        font-size: 20px;
        font-weight: 700;
        color: var(--c-header);
        margin-top: 8px;
        margin-bottom: 4px;
    }
    .auth-card .auth-subtitle {
        font-size: 14px;
        color: #6b7c93;
        margin-bottom: 0;
    }
    .auth-card .form-label {
        font-weight: 600;
        font-size: 14px;
        color: #2c4a7c;
        margin-bottom: 6px;
    }
    .auth-card .form-control {
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        border: 1px solid #ced8e4;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .auth-card .form-control:focus {
        border-color: var(--c-sidebar);
        box-shadow: 0 0 0 0.2rem rgba(44, 74, 124, 0.15);
    }
    .auth-card .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff9f9;
    }
    .auth-card .btn-primary {
        background: var(--c-sidebar);
        border-color: var(--c-sidebar);
        border-radius: 8px;
        padding: 11px;
        font-weight: 600;
        font-size: 15px;
        width: 100%;
        transition: all 0.2s;
    }
    .auth-card .btn-primary:hover {
        background: var(--c-header);
        border-color: var(--c-header);
    }
    .auth-footer {
        text-align: center;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf2f7;
        font-size: 14px;
        color: #6b7c93;
    }
    .auth-footer a {
        color: var(--c-sidebar);
        text-decoration: none;
        font-weight: 600;
    }
    .auth-footer a:hover {
        text-decoration: underline;
        color: var(--c-accent);
    }
    .back-home {
        display: block;
        text-align: center;
        margin-top: 12px;
        font-size: 13px;
        color: #7a8b9e;
        text-decoration: none;
    }
    .back-home:hover {
        color: var(--c-header);
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="auth-card">
    <div class="auth-logo">HUCE<span>.Web</span></div>
    <div class="auth-header">
        <h2>Đăng ký tài khoản</h2>
        <p class="auth-subtitle">Tạo tài khoản mới để truy cập và sử dụng hệ thống</p>
    </div>

    <form action="{{ route('register') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Nguyễn Văn A"
                   autofocus>
            @error('name')
                <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="nguyenvana@huce.edu.vn">
            @error('email')
                <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="Ít nhất 6 ký tự">
            @error('password')
                <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
            <input type="password"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation"
                   name="password_confirmation"
                   placeholder="Nhập lại mật khẩu">
            @error('password_confirmation')
                <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Đăng ký tài khoản</button>
    </form>

    <div class="auth-footer">
        Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        <a href="{{ url('/') }}" class="back-home">← Quay lại trang chủ</a>
    </div>
</div>
@endsection
