<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lopDauTien = LopHoc::first();
        $lopHocId = $lopDauTien ? $lopDauTien->id : null;

        $sinhViens = [
            [
                'ma_sv' => 'SV001',
                'ho_ten' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@gmail.com',
                'so_dien_thoai' => '0912345671',
                'tuoi' => 20,
                'dia_chi' => 'Hà Nội',
                'lop_hoc_id' => $lopHocId,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV002',
                'ho_ten' => 'Trần Thị Bình',
                'email' => 'tranthibinh@gmail.com',
                'so_dien_thoai' => '0912345672',
                'tuoi' => 21,
                'dia_chi' => 'Đà Nẵng',
                'lop_hoc_id' => $lopHocId,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV003',
                'ho_ten' => 'Lê Văn Cường',
                'email' => 'levancuong@gmail.com',
                'so_dien_thoai' => '0912345673',
                'tuoi' => 22,
                'dia_chi' => 'Hải Phòng',
                'lop_hoc_id' => $lopHocId,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV004',
                'ho_ten' => 'Phạm Thị Dung',
                'email' => 'phamthidung@gmail.com',
                'so_dien_thoai' => '0912345674',
                'tuoi' => 19,
                'dia_chi' => 'TP Hồ Chí Minh',
                'lop_hoc_id' => $lopHocId,
                'trang_thai' => false,
            ],
            [
                'ma_sv' => 'SV005',
                'ho_ten' => 'Hoàng Văn Em',
                'email' => 'hoangvanem@gmail.com',
                'so_dien_thoai' => '0912345675',
                'tuoi' => 23,
                'dia_chi' => 'Cần Thơ',
                'lop_hoc_id' => $lopHocId,
                'trang_thai' => true,
            ],
        ];

        foreach ($sinhViens as $sv) {
            SinhVien::updateOrCreate(['ma_sv' => $sv['ma_sv']], $sv);
        }
    }
}
