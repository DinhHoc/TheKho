@extends('layout.app')

@section('title','Quản lý phiếu xuất')

@section('content')

<style>
.title {
    font-size:24px;
    font-weight:bold;
    color:#2c3e50;
    margin-bottom:10px;
}

/* HEADER BAR */
.header-bar {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

/* BUTTON */
.btn-add {
    background: linear-gradient(135deg,#27ae60,#2ecc71);
    color:white;
    padding:8px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:500;
    box-shadow:0 3px 8px rgba(0,0,0,0.15);
    transition:0.2s;
}

.btn-add:hover {
    transform: translateY(-2px);
}

/* TABLE CARD */
.table-card {
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

/* TABLE */
table {
    width:100%;
    border-collapse: collapse;
    margin-top:10px;
}

th,td {
    padding:10px;
    text-align:center;
}

th {
    background:#f4f6f9;
    font-weight:600;
}

tr {
    border-bottom:1px solid #eee;
}

tr:hover {
    background:#f9fbfd;
}

/* ACTION BUTTON */
.action-btn {
    padding:5px 10px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    font-size:13px;
    margin:2px;
}

.btn-view { background:#3498db; }
.btn-edit { background:#f39c12; }
.btn-delete { background:#e74c3c; }

.action-btn:hover {
    opacity:0.85;
}

/* SUCCESS */
.success {
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:6px;
    margin-bottom:10px;
}
</style>

<div class="header-bar">
    <div class="title">📦 Quản lý phiếu xuất</div>

    <a href="/phieu-xuat/phieuxuat" class="btn-add">
        ➕ Thêm phiếu xuất
    </a>
</div>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<div class="table-card">

<table>
    <tr>
        <th>STT</th>
        <th>Số phiếu xuất</th>
        <th>Ngày xuất</th>
        <th>Mã kho</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>

    @foreach($list as $index => $row)
    <tr>
        <td>{{ $index+1 }}</td>
        <td><b>{{ $row->so_phieu_xuat }}</b></td>
        <td>{{ \Carbon\Carbon::parse($row->ngay_xuat)->format('d/m/Y') }}</td>
        <td>{{ $row->ma_kho }}</td>
        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y H:i') }}</td>
        <td>
            <a href="/phieu-xuat/show/{{ $row->so_phieu_xuat }}" class="action-btn btn-view">👁️ Xem</a>
            <a href="/phieu-xuat/edit/{{ $row->id }}" class="action-btn btn-edit">✏️ Sửa</a>
            <a href="/phieu-xuat/delete/{{ $row->id }}" 
               class="action-btn btn-delete"
               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
               🗑 Xóa
            </a>
        </td>
    </tr>
    @endforeach

</table>

</div>

@endsection