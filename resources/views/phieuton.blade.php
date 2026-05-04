@extends('layout.app')

@section('title', 'Import phiếu tồn')

@section('content')

<style>
    .title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-box {
        width: 400px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        text-align: center;
    }

    .form-box input {
        margin-top: 10px;
    }

    .form-box button {
        margin-top: 10px;
        padding: 6px 15px;
        border: none;
        background: #3498db;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-box button:hover {
        background: #2980b9;
    }

    .back {
        text-align: center;
        margin-top: 15px;
    }

    .alert-success {
        color: green;
        text-align: center;
    }

    .alert-error {
        color: red;
        text-align: center;
    }
</style>

<div class="title">IMPORT PHIẾU TỒN</div>

@if(session('success'))
    <p class="alert-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="alert-error">{{ session('error') }}</p>
@endif

<div class="form-box">
    <form method="POST" action="/import-ton" enctype="multipart/form-data">
        @csrf

        <label><b>Chọn file Excel:</b></label><br>
        <input type="file" name="file" required>

        <br>
        <button type="submit">Upload</button>
    </form>
</div>


@endsection
