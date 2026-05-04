@extends('layout.app')

@section('title', 'Thẻ kho')

@section('content')

<style>
.title {
    text-align:center;
    font-size:24px;
    font-weight:bold;
}

.sub-title {
    text-align:center;
    margin-bottom:10px;
}

.form-box {
    display:flex;
    gap:10px;
    margin-bottom:15px;
}

.form-box input {
    padding:6px;
    border:1px solid #ccc;
    border-radius:4px;
}

.btn {
    padding:6px 12px;
    border:none;
    border-radius:4px;
    color:white;
    cursor:pointer;
}

.btn-search { background:#3498db; }
.btn-print { background:#f39c12; }
.btn-save { background:#27ae60; }

.table-main {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

.table-main th, .table-main td {
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.table-main th {
    background:#d9dde3;
}

.left { text-align:left; }

.footer-sign {
    display:flex;
    justify-content:space-around;
    margin-top:40px;
}

@media print {
    .no-print { display:none !important; }
}
</style>

{{-- ===== FORM TÌM ===== --}}
<div class="no-print">
    <form method="POST" action="/the-kho/search" class="form-box">
        @csrf

        <input name="ma_hang" placeholder="Mã hàng"
               value="{{ request('ma_hang') }}" required>

        <input type="date" name="ngay_bat_dau"
               value="{{ request('ngay_bat_dau') }}">

        <input type="date" name="ngay_ket_thuc"
               value="{{ request('ngay_ket_thuc') }}">

        <button class="btn btn-search">🔍 Xem</button>
        <button type="button" onclick="window.print()" class="btn btn-print">🖨️ In</button>
    </form>
</div>

<div class="title">THẺ KHO</div>
<div class="sub-title">Ngày lập: {{ date('d/m/Y') }}</div>

@if(isset($data) && $data->count() > 0)

{{-- ===== BUTTON LƯU ===== --}}
<div class="no-print" style="margin-bottom:10px;">
    <form method="POST" action="/the-kho/store">
        @csrf

        <input type="hidden" name="ma_hang" value="{{ $data->first()->ma_hang }}">
        <input type="hidden" name="ten_mat_hang" value="{{ $data->first()->ten_mat_hang }}">
        <input type="hidden" name="ngay_bat_dau" value="{{ request('ngay_bat_dau') }}">
        <input type="hidden" name="ngay_ket_thuc" value="{{ request('ngay_ket_thuc') }}">

        <button class="btn btn-save">💾 Lưu thẻ kho</button>
    </form>
</div>

{{-- ===== THÔNG TIN ===== --}}
<div style="display:flex; justify-content:space-between;">
    <div>
        <b>Mã hàng:</b> {{ $data->first()->ma_hang }}
    </div>
    <div>
        <b>Tên hàng:</b> {{ $data->first()->ten_mat_hang }}
    </div>
    <div>
        <b>Tồn đầu:</b> {{ number_format($ton_dau ?? 0,2) }}
    </div>
</div>

{{-- ===== TABLE ===== --}}
<table class="table-main">
<tr>
    <th>Ngày</th>
    <th>Nơi nhập</th>
    <th>Nơi xuất</th>
    <th>Số CT</th>
    <th>Nhập</th>
    <th>Xuất</th>
    <th>Tồn</th>
    <th>Lô</th>
    <th>HSD</th>
</tr>

@php
$tongNhap = 0;
$tongXuat = 0;
@endphp

@foreach($data as $row)

@php
$tongNhap += $row->nhap;
$tongXuat += $row->xuat;
@endphp

<tr>
    <td>{{ \Carbon\Carbon::parse($row->ngay)->format('d/m/Y') }}</td>

    <td class="left">
        {{ $row->loai == 'nhap' ? $row->ten_khach_hang : '' }}
    </td>

    <td class="left">
        {{ $row->loai == 'xuat' ? $row->ten_khach_hang : '' }}
    </td>

    <td>{{ $row->so_phieu }}</td>

    <td>{{ number_format($row->nhap,2) }}</td>
    <td>{{ number_format($row->xuat,2) }}</td>
    <td>{{ number_format($row->ton,2) }}</td>

    <td>{{ $row->ma_lo }}</td>

    <td>
        {{ $row->han_su_dung ? \Carbon\Carbon::parse($row->han_su_dung)->format('d/m/Y') : '' }}
    </td>
</tr>

@endforeach

<tr>
    <td colspan="4"><b>Tổng</b></td>
    <td><b>{{ number_format($tongNhap,2) }}</b></td>
    <td><b>{{ number_format($tongXuat,2) }}</b></td>
    <td><b>{{ number_format(optional($data->last())->ton ?? 0,2) }}</b></td>
    <td colspan="2"></td>
</tr>

</table>

{{-- ===== CHỮ KÝ ===== --}}
<div style="margin-top:10px">
    Sổ này có ... trang đánh số từ 01 đến ...
</div>

<div class="footer-sign">
    <div>
        <b>NGƯỜI GHI SỔ</b><br>
        (Ký, họ tên)
    </div>

    <div>
        <b>KẾ TOÁN TRƯỞNG</b><br>
        (Ký, họ tên)
    </div>

    <div>
        Ngày ... tháng ... năm ...<br>
        <b>NGƯỜI ĐẠI DIỆN PHÁP LUẬT</b><br>
        (Ký, họ tên)
    </div>
</div>
@endif

@endsection