<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSinhVienRequest extends StoreSinhVienRequest
{
    /**
     * Giống lúc thêm mới, chỉ khác: mã sinh viên được phép trùng với chính sinh viên đang sửa.
     */
    public function rules(): array
    {
        $sinhVien = $this->route('sinhvien') ?? $this->route('sinh_vien');

        return array_merge(parent::rules(), [
            'ma_sv' => [
                'required',
                'string',
                'max:20',
                Rule::unique('sinh_viens', 'ma_sv')->ignore($sinhVien),
            ],
        ]);
    }
}
