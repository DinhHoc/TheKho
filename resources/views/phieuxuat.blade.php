@extends('layout.app')

@section('title', 'Phiếu xuất')

@section('content')

<style>
/* ===== TITLE ===== */
.title {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

.sub-title {
    text-align: center;
    margin-bottom: 10px;
}

/* ===== SEARCH BOX ===== */
.search-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    background: #fff;
    padding: 12px 15px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.search-form {
    display: flex;
    gap: 10px;
}

/* INPUT */
.search-input {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    min-width: 260px;
    font-size: 14px;
}

.search-input:focus {
    border-color: #3498db;
    box-shadow: 0 0 6px rgba(52,152,219,0.3);
}

/* BUTTON */
.btn {
    padding: 8px 14px;
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

.btn-view { background: #3498db; }
.btn-save { background: #27ae60; }
.btn-print { background: #f39c12; }

.btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

/* ===== INFO ===== */
.info-top {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

/* ===== TABLE ===== */
.table-main {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

.table-main th, .table-main td {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
}

.table-main th {
    background: #d9dde3;
}

.left { text-align: left; }

/* ===== FOOTER ===== */
.footer-sign {
    display: flex;
    justify-content: space-around;
    margin-top: 40px;
    text-align: center;
}

/* ===== PRINT ===== */
@media print {
    .no-print { display: none !important; }

    @page {
        size: A4 landscape;
        margin: 10mm;
    }
}
</style>

{{-- ===== FORM ===== --}}
<div class="search-box no-print">

    <form method="POST" action="/phieu-xuat" class="search-form">
        @csrf

        <input 
            name="so_phieu_xuat"
            class="search-input"
            placeholder="🔍 Nhập số chứng từ xuất..."
            required
        >

        <button class="btn btn-view">👁️ Xem</button>
    </form>

    <div style="display:flex; gap:10px;">

        {{-- SAVE --}}
        @if(isset($data) && count($data) > 0)
        <form method="POST" action="/phieu-xuat/store">
            @csrf
            <input type="hidden" name="so_phieu_xuat" value="{{ $data[0]->so_phieu_xuat }}">
            <input type="hidden" name="ngay_xuat" value="{{ $data[0]->ngay_xuat }}">
            <input type="hidden" name="ma_kho" value="{{ $data[0]->ma_kho }}">

            <button class="btn btn-save">💾 Lưu</button>
        </form>
        @endif

        {{-- PRINT --}}
        <button class="btn btn-print" onclick="window.print()">🖨️ In</button>

    </div>

</div>

{{-- ===== TITLE ===== --}}
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
        <td>{{ $index + 1 }}</td>
        <td>{{ $row->ma_hang }}</td>
        <td class="left">{{ $row->ten_mat_hang }}</td>
        <td>{{ $row->dvt }}</td>
        <td>{{ number_format($row->so_luong, 0) }}</td>
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
        <td><b>{{ number_format($tong, 0) }}</b></td>
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