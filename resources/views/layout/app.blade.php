<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            background: #2c3e50;
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #34495e;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* ===== DROPDOWN ===== */
        .menu-title {
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-title:hover {
            background: #34495e;
        }

        .submenu {
            display: none;
            background: #34495e;
        }

        .submenu a {
            padding-left: 35px;
            font-size: 14px;
        }

        .submenu.show {
            display: block;
        }

        /* ===== MAIN ===== */
        .main {
            margin-left: 230px;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 20px;
        }

        /* ===== CARD ===== */
        .card-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            padding: 20px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .blue { background: #3498db; }
        .green { background: #27ae60; }
        .red { background: #e74c3c; }
        .orange { background: #f39c12; }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #ecf0f1;
        }

        .left {
            text-align: left;
        }

        /* ===== PRINT ===== */
        @media print {
            .sidebar, .topbar {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            @page {
                size: A4 landscape;
                margin: 10mm;
            }

            body {
                zoom: 90%;
            }
        }
    </style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <h2>📦 KHO</h2>

    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        <i class="fa fa-home"></i> Trang chủ
    </a>

    <a href="/the-kho" class="{{ request()->is('the-kho') ? 'active' : '' }}">
        <i class="fa fa-box"></i> Thẻ kho
    </a>

    <a href="/phieu-nhap" class="{{ request()->is('phieu-nhap') ? 'active' : '' }}">
        <i class="fa fa-download"></i> Phiếu nhập
    </a>

    <a href="/phieu-xuat" class="{{ request()->is('phieu-xuat') ? 'active' : '' }}">
        <i class="fa fa-upload"></i> Phiếu xuất
    </a>

    <!-- ===== IMPORT ===== -->
    <div class="menu-group">

        <div class="menu-title" onclick="toggleImport()">
            <span><i class="fa fa-file-import"></i> Import</span>
            <i class="fa fa-chevron-down"></i>
        </div>

        <div id="import-menu" class="submenu">
            <a href="/import-nhap">Phiếu nhập</a>
            <a href="/import-xuat">Phiếu xuất</a>
            <a href="/phieu-ton">Phiếu tồn</a>
            <a href="/danh-muc-lo">Danh mục lô</a>
            <a href="/danh-muc-kho">Danh mục kho</a>
            <a href="/danh-muc-khach-hang">Khách hàng</a>
            <a href="/danh-muc-hang-hoa">Hàng hóa</a>
        </div>

    </div>

</div>

<!-- ===== MAIN ===== -->
<div class="main">

    <div class="topbar">
        <div><b>Hệ thống quản lý kho</b></div>
        <div>{{ date('d/m/Y') }}</div>
    </div>

    <div class="content">
        @yield('content')
    </div>

</div>

<!-- ===== JS ===== -->
<script>
function toggleImport() {
    let menu = document.getElementById("import-menu");
    menu.classList.toggle("show");
}
</script>

</body>
</html>