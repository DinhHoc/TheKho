<?php

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;
Route::get('/phieu-nhap', [ImportController::class, 'getPhieuNhap']);
Route::get('/phieu-xuat', [ImportController::class, 'getPhieuXuat']);
Route::post('/phieu-nhap', [ImportController::class, 'getPhieuNhap']);
Route::post('/phieu-xuat', [ImportController::class, 'getPhieuXuat']);
Route::post('/the-kho', [ImportController::class, 'getTheKho']);
Route::post('/import-nhap', [ImportController::class, 'import']);
Route::post('/import-xuat', [ImportController::class, 'importXuat']);
Route::post('/import-ton', [ImportController::class, 'importTon']);
Route::post('/import-lo', [ImportController::class, 'importLo']);
Route::post('/import-kho', [ImportController::class, 'importKho']);
Route::post('/import-khach-hang', [ImportController::class, 'importKhachHang']);
Route::post('/import-hang-hoa', [ImportController::class, 'importHangHoa']);
Route::get('/the-kho', [ImportController::class, 'listTheKho']);
Route::post('/the-kho/search', [ImportController::class, 'getTheKho']);
Route::post('/the-kho/store', [ImportController::class, 'storeTheKho']);
Route::get('/the-kho/show/{id}', [ImportController::class, 'showTheKho']);
Route::get('/the-kho/edit/{id}', [ImportController::class, 'editTheKho']);
Route::post('/the-kho/update/{id}', [ImportController::class, 'updateTheKho']);
Route::get('/the-kho/delete/{id}', [ImportController::class, 'deleteTheKho']);
Route::get('/phieu-nhap', [ImportController::class, 'listPhieuNhap']);
Route::get('/phieu-nhap/show/{so_phieu}', [ImportController::class, 'showPhieuNhap']);
Route::post('/phieu-nhap/store', [ImportController::class, 'storePhieuNhap']);
Route::get('/phieu-nhap/delete/{id}', [ImportController::class, 'deletePhieuNhap']);
Route::get('/phieu-xuat', [ImportController::class, 'listPhieuXuat']);
Route::get('/phieu-xuat/show/{so_phieu}', [ImportController::class, 'showPhieuXuat']);
Route::post('/phieu-xuat/store', [ImportController::class, 'storePhieuXuat']);
Route::get('/phieu-xuat/delete/{id}', [ImportController::class, 'deletePhieuXuat']);


Route::get('/the-kho/thekho', function () {
    return view('thekho');
});
// Route::get('/phieu-nhap', function () {
//     return view('phieunhap');
// });
Route::get('/phieu-nhap/phieunhap', function () {
    return view('phieunhap');
});
Route::get('/phieu-xuat/phieuxuat', function () {
    return view('phieuxuat');
});

// Route::get('/phieu-xuat', function () {
//     return view('phieuxuat');
// });
Route::get('/phieu-ton', function () {
    return view('phieuton');
});
Route::get('/danh-muc-lo', function () {
    return view('danhmuclo');
});
Route::get('/danh-muc-kho', function () {
    return view('danhmuckho');
});
Route::get('/danh-muc-khach-hang', function () {
    return view('danhmuckhachhang');
});
Route::get('/danh-muc-hang-hoa', function () {
    return view('danhmuchanghoa');
});
Route::get('/', function () {
    return view('home'); // trang chủ trống
});
Route::get('/import-nhap', function () {
    return view('nhap'); // hoặc import_nhap
});

Route::get('/import-xuat', function () {
    return view('xuat'); // hoặc import_xuat
});