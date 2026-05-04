@extends('layout.app')

@section('title','Quản lý thẻ kho')

@section('content')

<style>
.title {
    font-size:24px;
    font-weight:bold;
    color:#2c3e50;
}

/* HEADER */
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

.btn-add:hover { transform: translateY(-2px); }

/* CARD */
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

tr { border-bottom:1px solid #eee; }
tr:hover { background:#f9fbfd; }

/* ACTION */
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

.action-btn:hover { opacity:0.85; }

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
    <div class="title">📦 Quản lý thẻ kho</div>

    {{-- 🔥 FIX ROUTE --}}
    <a href="/the-kho/thekho" class="btn-add">
        ➕ Thêm thẻ kho
    </a>
</div>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<div class="table-card">

<table>
    <tr>
        <th>STT</th>
        <th>Mã hàng</th>
        <th>Tên hàng</th>
        <th>Khoảng thời gian</th> {{-- 🔥 NEW --}}
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>

    @forelse($list as $index => $row)
    <tr>
        <td>{{ $index+1 }}</td>

        <td><b>{{ $row->ma_hang }}</b></td>

        <td class="left">{{ $row->ten_mat_hang }}</td>

        {{-- 🔥 HIỂN THỊ NGÀY --}}
        <td>
            @if($row->ngay_bat_dau && $row->ngay_ket_thuc)
                {{ \Carbon\Carbon::parse($row->ngay_bat_dau)->format('d/m/Y') }}
                -
                {{ \Carbon\Carbon::parse($row->ngay_ket_thuc)->format('d/m/Y') }}
            @else
                Toàn bộ
            @endif
        </td>

        {{-- 🔥 FIX NULL --}}
        <td>
            {{ $row->ngay_tao 
                ? \Carbon\Carbon::parse($row->ngay_tao)->format('d/m/Y') 
                : '' }}
        </td>

        <td>
            <a href="/the-kho/show/{{ $row->id }}" class="action-btn btn-view">👁</a>

            <a href="/the-kho/edit/{{ $row->id }}" class="action-btn btn-edit">✏️</a>

            <a href="/the-kho/delete/{{ $row->id }}" 
               class="action-btn btn-delete"
               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
               🗑
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>
    @endforelse

</table>

</div>

@endsection