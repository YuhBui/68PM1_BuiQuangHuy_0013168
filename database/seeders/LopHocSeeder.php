<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LopHoc;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LopHoc::updateOrCreate(
            ['ma_lop' => 'LA001'],
            [
                'ten_lop' => 'Lớp 1A',
                'giao_vien' => 'Nguyễn Văn A',
                'so_dien_thoai_gvcn' => '0123456789',
                'ghi_chu' => 'Lớp học đầu tiên',
                'si_so' => 30,
                'trang_thai' => true,
            ]
        );

        if (LopHoc::count() < 20) {
            LopHoc::factory()->count(max(0, 20 - LopHoc::count()))->create();
        }
    }
}
