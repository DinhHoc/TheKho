@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<style>
    h2 {
        margin-bottom: 10px;
    }

    .section-title {
        margin-top: 30px;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 15px;
    }

    .card {
        padding: 20px;
        border-radius: 14px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 5px 12px rgba(0,0,0,0.1);
    }

    .card i {
        font-size: 20px;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* gradient màu đẹp hơn */
    .blue { background: linear-gradient(135deg, #3498db, #2980b9); }
    .green { background: linear-gradient(135deg, #2ecc71, #27ae60); }
    .red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
    .orange { background: linear-gradient(135deg, #f39c12, #d35400); }
    .purple { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
</style>

<h2>Dashboard</h2>

<!-- ===== CHỨC NĂNG ===== -->
<div class="section-title">📊 Quản lý</div>

<div class="card-box">

    <div class="card blue" onclick="location.href='/the-kho'">
        📦 <span>Thẻ kho</span>
    </div>

    <div class="card green" onclick="location.href='/phieu-nhap'">
        📥 <span>Phiếu nhập</span>
    </div>

    <div class="card red" onclick="location.href='/phieu-xuat'">
        📤 <span>Phiếu xuất</span>
    </div>

</div>

<!-- ===== IMPORT ===== -->
<div class="section-title">⬇️ Import dữ liệu</div>

<div class="card-box">

    <div class="card blue" onclick="location.href='/import-nhap'">
        📥 <span>Import phiếu nhập</span>
    </div>

    <div class="card green" onclick="location.href='/import-xuat'">
        📤 <span>Import phiếu xuất</span>
    </div>

    <div class="card red" onclick="location.href='/phieu-ton'">
        📊 <span>Import phiếu tồn</span>
    </div>

    <div class="card orange" onclick="location.href='/danh-muc-lo'">
        📁 <span>Import danh mục lô</span>
    </div>

    <div class="card purple" onclick="location.href='/danh-muc-kho'">
        🏬 <span>Import danh mục kho</span>
    </div>

    <div class="card blue" onclick="location.href='/danh-muc-khach-hang'">
        👤 <span>Import khách hàng</span>
    </div>

    <div class="card green" onclick="location.href='/danh-muc-hang-hoa'">
        📦 <span>Import hàng hóa</span>
    </div>

</div>

@endsection