<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ImportController extends Controller
{
    // ================= FORMAT DATE =================

    private function formatDate($value)
    {
        try {
            if (empty($value)) return null;

            if (is_numeric($value)) {
                return Carbon::createFromTimestamp(($value - 25569) * 86400)->format('Y-m-d');
            }

            if (preg_match('/\d{2}\/\d{2}\/\d{4}/', $value)) {
                return Carbon::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
            }

            return Carbon::parse($value)->format('Y-m-d');

        } catch (\Exception $e) {
            return null;
        }
    }

    // ================= IMPORT NHẬP =================

    public function import(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 9) continue;
            if (empty($row[0]) && empty($row[3])) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_khach' => $row[0] ?? '',
                'ten_khach_hang' => $row[1] ?? '',
                'ngay_nhap' => $this->formatDate($row[2]) ?? now()->format('Y-m-d'),
                'so_phieu_nhap' => $row[3] ?? '',
                'ma_hang' => $row[4] ?? '',
                'ten_mat_hang' => $row[5] ?? '',
                'dvt' => $row[6] ?? '',
                'ma_kho' => $row[7] ?? '',
                'ma_lo' => $row[8] ?? '',
                //'han_su_dung' => $this->formatDate($row[10]) ?? null,
                'so_luong' => isset($row[9]) ? (int)$row[9] : 0,
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('phieu_nhap')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import nhập thành công');
    }

    // ================= IMPORT XUẤT =================

    public function importXuat(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 9) continue;
            if (empty($row[0]) && empty($row[3])) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_khach' => $row[0] ?? '',
                'ten_khach_hang' => $row[1] ?? '',
                'ngay_xuat' => $this->formatDate($row[2]) ?? now()->format('Y-m-d'),
                'so_phieu_xuat' => $row[3] ?? '',
                'ma_hang' => $row[4] ?? '',
                'ten_mat_hang' => $row[5] ?? '',
                'dvt' => $row[6] ?? '',
                'ma_kho' => $row[7] ?? '',
                'ma_lo' => $row[8] ?? '',
                // 'han_su_dung' => $this->formatDate($row[10]) ?? null,
                'so_luong' => isset($row[9]) ? (int)$row[9] : 0,
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('phieu_xuat')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import xuất thành công');
    }

    // ================= TỒN KHO =================

    public function importTon(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 9) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_khach' => $row[0] ?? '',
                'ten_khach_hang' => $row[1] ?? '',
                'ngay' => $this->formatDate($row[2]) ?? now()->format('Y-m-d'),
                'so_phieu_nhap' => $row[3] ?? '',
                'ma_hang' => $row[4] ?? '',
                'ten_mat_hang' => $row[5] ?? '',
                'dvt' => $row[6] ?? '',
                'ma_kho' => $row[7] ?? '',
                'ma_lo' => $row[8] ?? '',
                'so_luong' => isset($row[9]) ? (int)$row[9] : 0,
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('phieu_ton')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import tồn kho thành công');
    }

    // ================= Danh mục lô =================

     public function importLo(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 4) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_hang' => $row[0] ?? '',
                'ten_mat_hang' => $row[1] ?? '',
                'ma_lo' => $row[2] ?? '', 
                'han_su_dung' => $this->formatDate($row[3]) ?? now()->format('Y-m-d'),
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('danh_muc_lo')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import danh mục lô thành công');
    }
    // ================= Danh mục kho =================

    public function importKho(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 2) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_kho' => $row[0] ?? '',
                'ten_kho' => $row[1] ?? '',
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('danh_muc_kho_hang')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import danh mục kho thành công');
    }

    // ================= Danh mục khách hàng =================

     public function importKhachHang(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 4) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_khach' => $row[0] ?? '',
                'ten_khach_hang' => $row[1] ?? '',
                'dia_chi' => $row[2] ?? '',
                'ma_so_thue' => $row[3] ?? '',
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('danh_muc_khach_hang')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import danh mục khách hàng thành công');
    }

    // ================= Danh mục hàng hóa =================

       public function importHangHoa(Request $request)
    {
        set_time_limit(300);

        if (!$request->hasFile('file')) {
            return redirect('/the-kho')->with('error', 'Chưa chọn file');
        }

        $data = Excel::toArray([], $request->file('file'))[0];
        $dataInsert = [];

        foreach ($data as $index => $row) {

            if ($index == 0) continue;
            if (count($row) < 3) continue;

            $row = array_map(function ($value) {
                return is_string($value)
                    ? mb_convert_encoding($value, 'UTF-8', 'auto')
                    : $value;
            }, $row);

            $dataInsert[] = [
                'ma_hang' => $row[0] ?? '',
                'ten_mat_hang' => $row[1] ?? '',
                'dvt' => $row[2] ?? '',
            ];
        }

        foreach (array_chunk($dataInsert, 500) as $chunk) {
            DB::table('danh_muc_hang_hoa')->insert($chunk);
        }

        return redirect('/the-kho')->with('success', 'Import danh mục hàng hóa thành công');
    }


    // ================= THẺ KHO =================

    public function getTheKho(Request $request)
    {
        $maHang = $request->ma_hang;
        $tuNgay = $request->ngay_bat_dau;
        $denNgay = $request->ngay_ket_thuc;

        if (!$maHang) {
            return redirect('/the-kho')->with('error', 'Chưa nhập mã hàng');
        }

        $nhap = DB::table('phieu_nhap as pn')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('pn.ma_lo', '=', 'lo.ma_lo')
                    ->on('pn.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('pn.ma_hang', $maHang)
            ->when($tuNgay && $denNgay, function ($q) use ($tuNgay, $denNgay) {
                $q->whereBetween('pn.ngay_nhap', [$tuNgay, $denNgay]);
            })
            ->select(
                'pn.ngay_nhap as ngay',
                DB::raw("'nhap' as loai"),
                'pn.ten_khach_hang',
                'pn.ten_mat_hang',
                'pn.ma_hang',
                'pn.ma_kho',
                'pn.ma_lo',
                'pn.ma_khach',
                'pn.so_phieu_nhap as so_phieu',
                'lo.han_su_dung', 
                'pn.so_luong as nhap',
                DB::raw('0 as xuat')
            );

       $xuat = DB::table('phieu_xuat as px')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('px.ma_lo', '=', 'lo.ma_lo')
                    ->on('px.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('px.ma_hang', $maHang)
            ->when($tuNgay && $denNgay, function ($q) use ($tuNgay, $denNgay) {
                 $q->whereBetween('px.ngay_xuat', [$tuNgay, $denNgay]);
            })
            ->select(
                'px.ngay_xuat as ngay',
                DB::raw("'xuat' as loai"),
                'px.ten_khach_hang',
                'px.ten_mat_hang',
                'px.ma_hang',
                'px.ma_kho',
                'px.ma_lo',
                'px.ma_khach',
                'px.so_phieu_xuat as so_phieu',
                'lo.han_su_dung', 
                DB::raw('0 as nhap'),
                'px.so_luong as xuat'
            );
        
        // ===== LẤY TỒN ĐẦU =====

        $maHang = trim($request->ma_hang);

        // ===== TỒN ĐẦU =====
        $ton_dau = DB::table('phieu_ton')
            ->whereRaw('TRIM(ma_hang) = ?', [$maHang])
            ->sum('so_luong');

        if ($tuNgay && $denNgay) {
        $tonTruoc =
        DB::table('phieu_nhap')
            ->where('ma_hang', $maHang)
            ->where('ngay_nhap', '<', $tuNgay)
            ->sum('so_luong')
        -
        DB::table('phieu_xuat')
            ->where('ma_hang', $maHang)
            ->where('ngay_xuat', '<', $tuNgay)
            ->sum('so_luong');
        } else {
            $tonTruoc = 0;
        }
        // ===== UNION =====
        $data = DB::query()
            ->fromSub($nhap->unionAll($xuat), 't')
            ->orderBy('ngay', 'asc')
            ->get();

        // ===== TÍNH TỒN =====
        $ton = $ton_dau + $tonTruoc;

        foreach ($data as $item) {
            $ton += $item->nhap;
            $ton -= $item->xuat;
            $item->ton = $ton;
        }
        $han_su_dung = DB::table('danh_muc_lo')
             ->where('ma_hang', $maHang)
             ->pluck('han_su_dung');
    // ===== RETURN =====
    return view('thekho', compact('data', 'ton_dau', 'han_su_dung'));
    }

      public function showTheKho($id)
    {
        $theKho = DB::table('the_kho')->where('id', $id)->first();

        if (!$theKho) {
            return back()->with('error', 'Không tìm thấy');
        }

        $maHang = trim($theKho->ma_hang);
        $tuNgay = $theKho->ngay_bat_dau;
        $denNgay = $theKho->ngay_ket_thuc;

        /*
        =============================
        1. TÍNH TỒN ĐẦU (CHUẨN)
        =============================
        */
        $ton_dau = DB::table('phieu_ton')
            ->where('ma_hang', $maHang)
            ->sum('so_luong');

        $tonTruoc = 0;

        if ($tuNgay) {
            $tonTruoc =
                DB::table('phieu_nhap')
                    ->where('ma_hang', $maHang)
                    ->whereDate('ngay_nhap', '<', $tuNgay)
                    ->sum('so_luong')
                -
                DB::table('phieu_xuat')
                    ->where('ma_hang', $maHang)
                    ->whereDate('ngay_xuat', '<', $tuNgay)
                    ->sum('so_luong');
        }

        /*
        =============================
        2. NHẬP (JOIN LÔ)
        =============================
        */
        $nhap = DB::table('phieu_nhap as pn')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('pn.ma_lo', '=', 'lo.ma_lo')
                    ->on('pn.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('pn.ma_hang', $maHang)
            ->when($tuNgay, fn($q) => $q->whereDate('pn.ngay_nhap', '>=', $tuNgay))
            ->when($denNgay, fn($q) => $q->whereDate('pn.ngay_nhap', '<=', $denNgay))
            ->select(
                'pn.ngay_nhap as ngay',
                DB::raw("'nhap' as loai"),
                'pn.ten_khach_hang',
                'pn.ten_mat_hang',
                'pn.ma_hang',
                'pn.ma_lo',
                'pn.so_phieu_nhap as so_phieu',
                'lo.han_su_dung',
                'pn.so_luong as nhap',
                DB::raw('0 as xuat')
            );

        /*
        =============================
        3. XUẤT (JOIN LÔ)
        =============================
        */
        $xuat = DB::table('phieu_xuat as px')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('px.ma_lo', '=', 'lo.ma_lo')
                    ->on('px.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('px.ma_hang', $maHang)
            ->when($tuNgay, fn($q) => $q->whereDate('px.ngay_xuat', '>=', $tuNgay))
            ->when($denNgay, fn($q) => $q->whereDate('px.ngay_xuat', '<=', $denNgay))
            ->select(
                'px.ngay_xuat as ngay',
                DB::raw("'xuat' as loai"),
                'px.ten_khach_hang',
                'px.ten_mat_hang',
                'px.ma_hang',
                'px.ma_lo',
                'px.so_phieu_xuat as so_phieu',
                'lo.han_su_dung',
                DB::raw('0 as nhap'),
                'px.so_luong as xuat'
            );

        /*
        =============================
        4. UNION + SORT
        =============================
        */
        $data = DB::query()
            ->fromSub($nhap->unionAll($xuat), 't')
            ->orderBy('ngay', 'asc')
            ->get();

        /*
        =============================
        5. TÍNH TỒN CHUẨN
        =============================
        */
        $ton = $ton_dau + $tonTruoc;

        foreach ($data as $row) {
            $ton += $row->nhap;
            $ton -= $row->xuat;
            $row->ton = $ton;
        }

        return view('thekho_show_full', [
            'data' => $data,
            'theKho' => $theKho,
            'ton_dau' => $ton_dau + $tonTruoc
        ]);
    }

    public function listTheKho()
    {
        $list = DB::table('the_kho')
            ->orderBy('id', 'desc')
            ->get();

        return view('thekho_list', compact('list'));
    }

    public function storeTheKho(Request $request)
    {
        DB::table('the_kho')->insert([
            'ma_hang' => $request->ma_hang,
            'ten_mat_hang' => $request->ten_mat_hang,
            'ngay_bat_dau' => $request->ngay_bat_dau,
            'ngay_ket_thuc' => $request->ngay_ket_thuc,
            'ngay_tao' => now()
        ]);

        return redirect('/the-kho')->with('success', 'Đã lưu thẻ kho');
    }

    public function deleteTheKho($id)
    {
        DB::table('the_kho')->where('id', $id)->delete();

        return back()->with('success', 'Đã xóa');
    }

    public function editTheKho($id)
    {
        $theKho = DB::table('the_kho')->where('id', $id)->first();

        if (!$theKho) {
            return back()->with('error', 'Không tìm thấy');
        }

        return view('thekho_edit', compact('theKho'));
    }
   
    // ================= Phiếu Nhập =================
    public function getPhieuNhap(Request $request)
    {
        $soPhieu = $request->so_phieu_nhap;

        if (!$soPhieu) {
            return back()->with('error', 'Chưa nhập số phiếu');
        }

        $data = DB::table('phieu_nhap as pn')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('pn.ma_lo', '=', 'lo.ma_lo')
                    ->on('pn.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('pn.so_phieu_nhap', $soPhieu) // 👈 QUAN TRỌNG
            ->select(
                'pn.ngay_nhap',
                'pn.so_phieu_nhap',
                'pn.ten_khach_hang',
                'pn.ma_kho',
                'pn.ten_mat_hang',
                'pn.ma_hang',
                'pn.ma_lo',
                'pn.dvt',
                'lo.han_su_dung',
                'pn.so_luong'
            )
            ->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Không tìm thấy phiếu');
        }
        return view('phieunhap', compact('data'));
    }
// ================= Danh sách phiếu nhập =================
     public function listPhieuNhap()
    {
        $list = DB::table('phieu_nhap_list')
            ->orderBy('id', 'desc')
            ->get();

        return view('phieunhap_list', compact('list'));
    }
    public function deletePhieuNhap($id)
    {
        DB::table('phieu_nhap_list')->where('id', $id)->delete();

        return back()->with('success', 'Đã xóa');
    }

    // public function showPhieuNhap($id)
    // {
    //     $phieuNhap = DB::table('phieu_nhap_list')->where('id', $id)->first();

    //     if (!$phieuNhap) {
    //         return back()->with('error', 'Không tìm thấy');
    //     }

    //     return view('phieunhap_show', compact('phieuNhap'));
    // }

    public function storePhieuNhap(Request $request)
    {
        DB::table('phieu_nhap_list')->insert([
            'so_phieu_nhap' => $request->so_phieu_nhap,
            'ngay_nhap' => $request->ngay_nhap,
            'ma_kho' => $request->ma_kho,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Lưu phiếu nhập thành công');
    }

    public function showPhieuNhap($so_phieu)
    {
        $data = DB::table('phieu_nhap as pn')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('pn.ma_lo', '=', 'lo.ma_lo')
                    ->on('pn.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('pn.so_phieu_nhap', $so_phieu)
            ->select(
                'pn.ngay_nhap',
                'pn.so_phieu_nhap',
                'pn.ten_khach_hang',
                'pn.ma_kho',
                'pn.ten_mat_hang',
                'pn.ma_hang',
                'pn.ma_lo',
                'pn.dvt',
                'pn.so_luong',
                'lo.han_su_dung'
            )
            ->orderBy('pn.id', 'asc')
            ->get();

        // ❌ Không có dữ liệu
        if ($data->isEmpty()) {
            return redirect('/phieu-nhap')->with('error', 'Không tìm thấy phiếu');
        }

        return view('phieunhap_show', compact('data'));
    }

    
    
    // ================= Phiếu Xuất =================

    public function getPhieuXuat(Request $request)
    {
        $soPhieu = $request->so_phieu_xuat;

        if (!$soPhieu) {
            return back()->with('error', 'Chưa nhập số phiếu');
        }

        $data = DB::table('phieu_xuat as px')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('px.ma_lo', '=', 'lo.ma_lo')
                    ->on('px.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('px.so_phieu_xuat', $soPhieu) // 👈 QUAN TRỌNG
            ->select(
                'px.ngay_xuat',
                'px.so_phieu_xuat',
                'px.ten_khach_hang',
                'px.ma_kho',
                'px.ten_mat_hang',
                'px.ma_hang',
                'px.ma_lo',
                'px.dvt',
                'lo.han_su_dung',
                'px.so_luong'
            )
            ->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Không tìm thấy phiếu');
        }
        return view('phieuxuat', compact('data'));
    }
    public function listPhieuXuat()
    {
        $list = DB::table('phieu_xuat_list')
            ->orderBy('id', 'desc')
            ->get();

        return view('phieuxuat_list', compact('list'));
    }
    public function deletePhieuXuat($id)
    {
        DB::table('phieu_xuat_list')->where('id', $id)->delete();

        return back()->with('success', 'Đã xóa');
    }
    public function storePhieuXuat(Request $request)
    {
        DB::table('phieu_xuat_list')->insert([
            'so_phieu_xuat' => $request->so_phieu_xuat,
            'ngay_xuat' => $request->ngay_xuat,
            'ma_kho' => $request->ma_kho,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Lưu phiếu xuất thành công');
    }
    public function showPhieuXuat($so_phieu)
    {
        $data = DB::table('phieu_xuat as px')
            ->leftJoin('danh_muc_lo as lo', function ($join) {
                $join->on('px.ma_lo', '=', 'lo.ma_lo')
                    ->on('px.ma_hang', '=', 'lo.ma_hang');
            })
            ->where('px.so_phieu_xuat', $so_phieu)
            ->select(
                'px.ngay_xuat',
                'px.so_phieu_xuat',
                'px.ten_khach_hang',
                'px.ma_kho',
                'px.ten_mat_hang',
                'px.ma_hang',
                'px.ma_lo',
                'px.dvt',
                'px.so_luong',
                'lo.han_su_dung'
            )
            ->orderBy('px.id', 'asc')
            ->get();

        // ❌ Không có dữ liệu
        if ($data->isEmpty()) {
            return redirect('/phieu-xuat')->with('error', 'Không tìm thấy phiếu');
        }

        return view('phieuxuat_show', compact('data'));
    }
      
}