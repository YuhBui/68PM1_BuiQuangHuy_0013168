<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';

    protected $fillable = [
        'ma_sv',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'tuoi',
        'dia_chi',
        'lop_hoc_id',
        'trang_thai',
    ];

    /**
     * Sinh viên thuộc về một lớp học.
     */
    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }
}
