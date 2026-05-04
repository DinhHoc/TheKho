 @extends('layout.app')

@section('title', 'Import khách hàng')

@section('content')

<style>
    .title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .form-box {
        width: 420px;
        margin: 40px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    .form-box input {
        margin-top: 10px;
        padding: 6px;
        width: 100%;
    }

    .form-box button {
        margin-top: 15px;
        padding: 8px 15px;
        border: none;
        background: #27ae60;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-box button:hover {
        background: #1e8449;
    }

    .alert-success {
        color: green;
        text-align: center;
        margin-bottom: 10px;
    }

    .alert-error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }

    .back {
        text-align: center;
        margin-top: 15px;
    }
</style>

<div class="title">IMPORT DANH MỤC KHÁCH HÀNG</div>

@if(session('success'))
    <p class="alert-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="alert-error">{{ session('error') }}</p>
@endif

<div class="form-box">
    <form method="POST" action="/import-khach-hang" enctype="multipart/form-data">
        @csrf

        <label><b>Chọn file Excel (.xlsx):</b></label>
        <input type="file" name="file" required>

        <button type="submit">Upload</button>
    </form>
</div>

<div class="back">
    <a href="/the-kho">← Quay lại thẻ kho</a>
</div>

@endsection