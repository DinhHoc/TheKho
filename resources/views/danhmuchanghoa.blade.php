@extends('layout.app')

@section('title', 'Import hàng hóa')

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
        padding: 5px;
    }

    .form-box button {
        margin-top: 15px;
        padding: 8px 15px;
        border: none;
        background: #3498db;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-box button:hover {
        background: #2980b9;
    }

    .alert-success {
        color: green;
        text-align: center;
    }

    .alert-error {
        color: red;
        text-align: center;
    }

    .back {
        text-align: center;
        margin-top: 15px;
    }
</style>

<div class="title">IMPORT DANH MỤC HÀNG HÓA</div>

@if(session('success'))
    <p class="alert-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="alert-error">{{ session('error') }}</p>
@endif

<div class="form-box">
    <form method="POST" action="/import-hang-hoa" enctype="multipart/form-data">
        @csrf

        <label><b>Chọn file Excel:</b></label><br>
        <input type="file" name="file" required>

        <br>
        <button type="submit">Upload</button>
    </form>
</div>

<div class="back">
    <a href="/the-kho">← Quay lại thẻ kho</a>
</div>

@endsection