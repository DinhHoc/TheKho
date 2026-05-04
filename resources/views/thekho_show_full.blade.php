@extends('layout.app')

@section('title', 'Thẻ kho')

@section('content')

<style>
.title { text-align:center; font-size:24px; font-weight:bold; }
.sub-title { text-align:center; margin-bottom:10px; }

.info-top {
    display:flex;
    justify-content:space-between;
    margin-top:10px;
}

.table-main {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    font-size:14px;
}

.table-main th, .table-main td {
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.table-main th { background:#d9dde3; }
.left { text-align:left; }

.footer-sign {
    display:flex;
    justify-content:space-around;
    margin-top:40px;
    text-align:center;
}

.btn {
    padding:6px 12px;
    border:none;
    border-radius:4px;
    cursor:pointer;
    color:white;
}

.btn-save { background:#27ae60; }
.btn-print { background:#f39c12; }

@media print {
    .no-print { display:none !important; }
}
</style>

{{-- ===== THÔNG BÁO ===== --}}
@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

{{-- ===== BUTTON ===== --}}
<div class="no-print" style="margin-bottom:10px; display:flex; gap:10px;">

    <button class="btn btn-print" onclick="window.print()">🖨️ In</button>

    @if(isset($data) && $data->count() > 0)
    <form method="POST" action="/the-kho/store">
        @csrf

        {{-- 🔥 FIX QUAN TRỌNG --}}
        <input type="hidden" name="ma_hang" value="{{ $data->first()->ma_hang }}">
        <input type="hidden" name="ten_mat_hang" value="{{ $data->first()->ten_mat_hang }}">

        {{-- 🔥 FIX NGÀY --}}
        <input type="hidden" name="ngay_bat_dau" value="{{ request('ngay_bat_dau') }}">
        <input type="hidden" name="ngay_ket_thuc" value="{{ request('ngay_ket_thuc') }}">

    </form>
    @endif

</div>

<div class="title">THẺ KHO</div>
<div class="sub-title">Ngày lập thẻ: {{ date('d/m/Y') }}</div>

@if(isset($data) && $data->count() > 0)

<div class="info-top">
    <div>
        <b>Mã hàng:</b> {{ $data->first()->ma_hang }}<br>
        <b>Quy cách:</b>
    </div>

    <div>
        <b>Tên hàng:</b> {{ $data->first()->ten_mat_hang }}<br>
        <b>Đơn vị tính:</b>
    </div>

    <div>
        <b>Tồn đầu:</b> {{ number_format($ton_dau ?? 0, 2) }}
    </div>
</div>

<table class="table-main">
<tr>
    <th rowspan="2">Ngày</th>
    <th rowspan="2">Nơi nhập</th>
    <th rowspan="2">Nơi xuất</th>
    <th rowspan="2">Số CT nhập</th>
    <th rowspan="2">Số CT xuất</th>
    <th colspan="3">Số lượng</th>
    <th rowspan="2">Số lô</th>
    <th rowspan="2">Hạn dùng</th>
    <th rowspan="2">Ghi chú</th>
</tr>
<tr>
    <th>Nhập</th>
    <th>Xuất</th>
    <th>Còn</th>
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

    <td>{{ $row->loai == 'nhap' ? $row->so_phieu : '' }}</td>
    <td>{{ $row->loai == 'xuat' ? $row->so_phieu : '' }}</td>

    <td>{{ number_format($row->nhap,2) }}</td>
    <td>{{ number_format($row->xuat,2) }}</td>
    <td>{{ number_format($row->ton,2) }}</td>

    <td>{{ $row->ma_lo }}</td>

    <td>
        {{ $row->han_su_dung 
            ? \Carbon\Carbon::parse($row->han_su_dung)->format('d/m/Y') 
            : '' }}
    </td>

    <td></td>
</tr>
@endforeach

<tr>
    <td colspan="5"><b>Tổng</b></td>
    <td><b>{{ number_format($tongNhap,2) }}</b></td>
    <td><b>{{ number_format($tongXuat,2) }}</b></td>
    <td><b>{{ number_format(optional($data->last())->ton ?? 0,2) }}</b></td>
    <td colspan="3"></td>
</tr>

</table>

<div style="margin-top:10px">
    Sổ này có ... trang
</div>

<div class="footer-sign">
    <div><b>Người ghi sổ</b><br>(Ký tên)</div>
    <div><b>Kế toán trưởng</b><br>(Ký tên)</div>
    <div>Ngày ... tháng ... năm ...<br><b>Giám đốc</b></div>
</div>

@endif

@endsection