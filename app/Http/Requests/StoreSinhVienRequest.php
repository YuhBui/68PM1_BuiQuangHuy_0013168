<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSinhVienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Chuẩn hoá dữ liệu trước khi validate: mã SV luôn viết hoa và xoá khoảng trắng thừa.
     */
    protected function prepareForValidation(): void
    {
        if (is_string($this->ma_sv)) {
            $this->merge(['ma_sv' => strtoupper(trim($this->ma_sv))]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ma_sv' => 'required|string|max:20|unique:sinh_viens,ma_sv',
            'ho_ten' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:20',
            'tuoi' => 'nullable|integer|min:1|max:120',
            'dia_chi' => 'nullable|string|max:255',
            'lop_hoc_id' => 'nullable|exists:lop_hocs,id',
            'trang_thai' => 'required|boolean',
        ];
    }

    /**
     * Thông báo lỗi tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'min' => ':attribute phải từ :min trở lên.',
            'integer' => ':attribute phải là số nguyên.',
            'boolean' => ':attribute không hợp lệ.',
            'email' => ':attribute không đúng định dạng email.',
            'ma_sv.unique' => 'Mã sinh viên này đã tồn tại.',
            'lop_hoc_id.exists' => 'Lớp học được chọn không hợp lệ trong hệ thống.',
        ];
    }

    /**
     * Tên hiển thị của các trường trong thông báo lỗi.
     */
    public function attributes(): array
    {
        return [
            'ma_sv' => 'Mã sinh viên',
            'ho_ten' => 'Họ tên',
            'email' => 'Email',
            'so_dien_thoai' => 'Số điện thoại',
            'tuoi' => 'Tuổi',
            'dia_chi' => 'Địa chỉ',
            'lop_hoc_id' => 'Lớp học',
            'trang_thai' => 'Trạng thái',
        ];
    }
}
