<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinhVienController extends Controller
{
    // Các cột được phép sắp xếp
    private const SORTABLE = ['id', 'ma_sv', 'ho_ten', 'email', 'so_dien_thoai', 'tuoi', 'dia_chi', 'lop_hoc_id', 'trang_thai'];

    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    /**
     * Danh sách sinh viên với tìm kiếm, lọc và phân trang.
     */
    public function index(Request $request)
    {
        $filters = Validator::make($request->query(), [
            'keyword' => 'nullable|string|max:100',
            'lop_hoc_id' => 'nullable|integer|min:1',
            'tuoi' => 'nullable|integer|min:0',
            'trang_thai' => 'nullable|in:0,1',
            'sort' => 'nullable|in:' . implode(',', self::SORTABLE),
            'direction' => 'nullable|in:asc,desc',
            'perPage' => 'nullable|in:' . implode(',', self::PER_PAGE_OPTIONS),
        ])->valid();

        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';
        $perPage = (int) ($filters['perPage'] ?? 10);

        $sinhViens = SinhVien::query()
            ->with('lopHoc')
            ->when(isset($filters['keyword']), function ($query) use ($filters) {
                $keyword = '%' . $filters['keyword'] . '%';
                $query->where(function ($q) use ($keyword) {
                    $q->where('ma_sv', 'like', $keyword)
                        ->orWhere('ho_ten', 'like', $keyword)
                        ->orWhere('email', 'like', $keyword)
                        ->orWhere('so_dien_thoai', 'like', $keyword)
                        ->orWhere('dia_chi', 'like', $keyword);
                });
            })
            ->when(isset($filters['lop_hoc_id']), fn ($query) => $query->where('lop_hoc_id', $filters['lop_hoc_id']))
            ->when(isset($filters['tuoi']) && $filters['tuoi'] !== '', fn ($query) => $query->where('tuoi', $filters['tuoi']))
            ->when(isset($filters['trang_thai']), fn ($query) => $query->where('trang_thai', $filters['trang_thai']))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $lopHocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinhvien.index', [
            'sinhViens' => $sinhViens,
            'lopHocs' => $lopHocs,
            'filters' => $filters,
            'sort' => $sort,
            'direction' => $direction,
            'perPage' => $perPage,
            'sortable' => self::SORTABLE,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
        ]);
    }

    /**
     * Form thêm mới sinh viên.
     */
    public function create()
    {
        $lopHocs = LopHoc::where('trang_thai', true)->orderBy('ten_lop')->get();
        return view('sinhvien.create', [
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Lưu sinh viên mới vào cơ sở dữ liệu.
     */
    public function store(StoreSinhVienRequest $request)
    {
        SinhVien::create($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được tạo thành công.');
    }

    /**
     * Xem thông tin chi tiết của một sinh viên.
     */
    public function show(SinhVien $sinhvien)
    {
        $sinhvien->load('lopHoc');
        return view('sinhvien.show', ['sinhVien' => $sinhvien]);
    }

    /**
     * Form chỉnh sửa thông tin sinh viên.
     */
    public function edit(SinhVien $sinhvien)
    {
        $lopHocs = LopHoc::orderBy('ten_lop')->get();
        return view('sinhvien.edit', [
            'sinhVien' => $sinhvien,
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Cập nhật thông tin sinh viên trong cơ sở dữ liệu.
     */
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được cập nhật thành công.');
    }

    /**
     * Xóa sinh viên khỏi cơ sở dữ liệu.
     */
    public function destroy(SinhVien $sinhvien)
    {
        $sinhvien->delete();

        return back()->with('success', 'Sinh viên đã được xóa.');
    }
}
