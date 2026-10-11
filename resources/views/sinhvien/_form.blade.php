{{-- Dùng chung cho create và edit. Khi sửa thì có biến $sinhVien, khi thêm mới thì không. --}}
@php($sinhVien = $sinhVien ?? null)

<div class="mb-3">
    <label for="ma_sv" class="form-label">Mã sinh viên <span class="text-danger">*</span></label>
    <input type="text" id="ma_sv" name="ma_sv"
           class="form-control @error('ma_sv') is-invalid @enderror"
           value="{{ old('ma_sv', $sinhVien?->ma_sv) }}"
           placeholder="Ví dụ: SV001">
    <div class="form-text">Mã sinh viên viết hoa, không trùng lặp (tối đa 20 ký tự).</div>
    @error('ma_sv')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="ho_ten" class="form-label">Họ tên sinh viên <span class="text-danger">*</span></label>
    <input type="text" id="ho_ten" name="ho_ten"
           class="form-control @error('ho_ten') is-invalid @enderror"
           value="{{ old('ho_ten', $sinhVien?->ho_ten) }}"
           placeholder="Ví dụ: Nguyễn Văn An">
    @error('ho_ten')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $sinhVien?->email) }}"
           placeholder="Ví dụ: nguyenvanan@gmail.com">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
    <input type="text" id="so_dien_thoai" name="so_dien_thoai"
           class="form-control @error('so_dien_thoai') is-invalid @enderror"
           value="{{ old('so_dien_thoai', $sinhVien?->so_dien_thoai) }}"
           placeholder="Ví dụ: 0912345678">
    @error('so_dien_thoai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tuoi" class="form-label">Tuổi</label>
    <input type="number" id="tuoi" name="tuoi" min="1" max="120"
           class="form-control @error('tuoi') is-invalid @enderror"
           value="{{ old('tuoi', $sinhVien?->tuoi) }}"
           placeholder="Ví dụ: 20">
    @error('tuoi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="dia_chi" class="form-label">Địa chỉ</label>
    <input type="text" id="dia_chi" name="dia_chi"
           class="form-control @error('dia_chi') is-invalid @enderror"
           value="{{ old('dia_chi', $sinhVien?->dia_chi) }}"
           placeholder="Ví dụ: Hà Nội">
    @error('dia_chi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="lop_hoc_id" class="form-label">Lớp học</label>
    <select id="lop_hoc_id" name="lop_hoc_id"
            class="form-select @error('lop_hoc_id') is-invalid @enderror">
        <option value="">-- Chọn lớp học --</option>
        @foreach ($lopHocs as $lopHoc)
            <option value="{{ $lopHoc->id }}"
                @selected((string) old('lop_hoc_id', $sinhVien?->lop_hoc_id) === (string) $lopHoc->id)>
                {{ $lopHoc->ten_lop }} ({{ $lopHoc->ma_lop }})
            </option>
        @endforeach
    </select>
    @error('lop_hoc_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="trang_thai" class="form-label">Trạng thái <span class="text-danger">*</span></label>
    <select id="trang_thai" name="trang_thai"
            class="form-select @error('trang_thai') is-invalid @enderror">
        <option value="1" @selected(old('trang_thai', $sinhVien?->trang_thai ?? 1) == 1)>Đang học (Hoạt động)</option>
        <option value="0" @selected(old('trang_thai', $sinhVien?->trang_thai ?? 1) == 0)>Nghỉ học / Khóa (Không hoạt động)</option>
    </select>
    @error('trang_thai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
