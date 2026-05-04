@extends('layout.app')

@section('title', 'Chi tiết phiếu xuất')

@section('content')

<style>
.title {
    text-align:center;
    font-size:22px;
    font-weight:bold;
}

.sub-title {
    text-align:center;
    margin-bottom:10px;
}

/* BUTTON */
.top-bar {
    display:flex;
    justify-content:flex-end;
    margin-bottom:10px;
}

.btn-print {
    padding:8px 14px;
    border:none;
    border-radius:8px;
    background:#f39c12;
    color:white;
    cursor:pointer;
}

/* INFO */
.info-top {
    display:flex;
    justify-content:space-between;
    margin-top:10px;
}

/* TABLE */
.table-main {
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
    font-size:14px;
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

/* FOOTER */
.footer-sign {
    display:flex;
    justify-content:space-around;
    margin-top:40px;
    text-align:center;
}

/* PRINT */
@media print {
    .no-print { display:none !important; }

    @page {
        size:A4 landscape;
        margin:10mm;
    }
}
</style>

{{-- ===== BUTTON ===== --}}
<div class="top-bar no-print">
    <button class="btn-print" onclick="window.print()">🖨️ In</button>
</div>

<div class="title">PHIẾU XUẤT HÀNG</div>
<div class="sub-title">Ngày lập: {{ date('d/m/Y') }}</div>

@if(isset($data) && count($data) > 0)

{{-- ===== INFO ===== }}
<div class="info-top">
    <div>
        <b>Nhà cung cấp:</b> {{ $data[0]->ten_khach_hang }} <br>
        <b>Kho xuất:</b> {{ $data[0]->ma_kho }}
    </div>

    <div>
        <b>Ngày xuất:</b> 
        {{ \Carbon\Carbon::parse($data[0]->ngay_xuat)->format('d/m/Y') }} <br>
        <b>Số chứng từ:</b> {{ $data[0]->so_phieu_xuat }}
    </div>
</div>

{{-- ===== TABLE ===== --}}
<table class="table-main">
    <tr>
        <th>STT</th>
        <th>Mã hàng</th>
        <th>Tên sản phẩm</th>
        <th>Đơn vị</th>
        <th>Số lượng</th>
        <th>Số lô</th>
        <th>Hạn dùng</th>
        <th>Ghi chú</th>
    </tr>

    @php $tong = 0; @endphp

    @foreach($data as $index => $row)
    @php $tong += $row->so_luong; @endphp

    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $row->ma_hang }}</td>
        <td class="left">{{ $row->ten_mat_hang }}</td>
        <td>{{ $row->dvt }}</td>
        <td>{{ number_format($row->so_luong,0) }}</td>
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
        <td colspan="4"><b>Tổng cộng</b></td>
        <td><b>{{ number_format($tong,0) }}</b></td>
        <td colspan="3"></td>
    </tr>
</table>

<div style="margin-top:10px">
    Sổ này có ... trang đánh số từ 01 đến ...
</div>

<div class="footer-sign">
    <div>
        <b>NGƯỜI LẬP PHIẾU</b><br>(Ký, họ tên)
    </div>

    <div>
        <b>THỦ KHO</b><br>(Ký, họ tên)
    </div>

    <div>
        Ngày ... tháng ... năm ...<br>
        <b>GIÁM ĐỐC</b><br>(Ký, họ tên)
    </div>
</div>

@endif

@endsection