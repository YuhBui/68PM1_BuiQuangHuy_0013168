<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinhVienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ma_sv' => $this->ma_sv,
            'ho_ten' => $this->ho_ten,
            'email' => $this->email,
            'so_dien_thoai' => $this->so_dien_thoai,
            'tuoi' => $this->tuoi,
            'dia_chi' => $this->dia_chi,
            'lop_hoc_id' => $this->lop_hoc_id,
            'lop_hoc' => new LopHocResource($this->whenLoaded('lopHoc')),
            'trang_thai' => $this->trang_thai,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
