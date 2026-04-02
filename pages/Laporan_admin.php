<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

// ================= DATA =================

// total penjualan (barang keluar)
$penjualan = mysqli_fetch_assoc(mysqli_query($connect,"
    SELECT SUM(jumlah) as total, COUNT(*) as transaksi
    FROM transaksi
    WHERE jenis='keluar'
"));

// barang masuk & keluar
$stok = mysqli_fetch_assoc(mysqli_query($connect,"
    SELECT 
    SUM(CASE WHEN jenis='masuk' THEN jumlah ELSE 0 END) as masuk,
    SUM(CASE WHEN jenis='keluar' THEN jumlah ELSE 0 END) as keluar
    FROM transaksi
"));

// permintaan (jika ada tabel permintaan)
$permintaan = mysqli_fetch_assoc(mysqli_query($connect,"
    SELECT 
    SUM(CASE WHEN status='baru' THEN 1 ELSE 0 END) as baru,
    SUM(CASE WHEN status='selesai' THEN 1 ELSE 0 END) as selesai
    FROM permintaan
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial;}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    padding-bottom:90px;
}

/* HEADER */
.header{
    padding:20px;
    font-size:20px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* FILTER */
.filter{
    margin:0 20px 20px;
    background:#12283b;
    padding:12px;
    border-radius:25px;
    display:flex;
    justify-content:space-between;
    color:#9bb6cc;
    font-size:14px;
}

/* CARD */
.card{
    background:#12283b;
    margin:0 20px 15px;
    padding:18px;
    border-radius:14px;
}

.card-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.card-title span{
    font-weight:bold;
}

/* GRID */
.grid{
    display:flex;
    justify-content:space-between;
    margin-top:10px;
}

.item{
    font-size:13px;
    color:#9bb6cc;
}

.item b{
    display:block;
    color:white;
    margin-top:5px;
}

/* NAVBAR */
.navbar{
    position:fixed;
    bottom:0;
    width:100%;
    background:#0e2232;
    display:flex;
    justify-content:space-around;
    padding:12px 0;
    border-top:1px solid #142c3f;
}

.nav-item{
    text-align:center;
    font-size:12px;
    color:#9bb6cc;
}

.nav-item.active{ color:#1e88e5; }

.nav-item svg{
    display:block;
    margin:auto;
    margin-bottom:4px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    Laporan
    <!-- icon download -->
    <svg width="22" height="22" fill="none" stroke="white" stroke-width="2">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
    </svg>
</div>

<!-- FILTER -->
<div class="filter">
    <div>Bulan ini: 1 - 30 Desember 2025</div>
    ▼
</div>

<!-- LAPORAN PENJUALAN -->
<div class="card">
    <div class="card-title">
        <span>📊 Laporan Penjualan</span>
        >
    </div>
    <div class="grid">
        <div class="item">
            Total Penjualan
            <b>Rp <?php echo number_format($penjualan['total'] ?? 0,0,',','.'); ?></b>
        </div>
        <div class="item">
            Transaksi
            <b><?php echo $penjualan['transaksi'] ?? 0; ?></b>
        </div>
    </div>
</div>

<!-- LAPORAN STOK -->
<div class="card">
    <div class="card-title">
        <span>📦 Laporan Stok</span>
        >
    </div>
    <div class="grid">
        <div class="item">
            Barang Masuk
            <b><?php echo $stok['masuk'] ?? 0; ?></b>
        </div>
        <div class="item">
            Barang Keluar
            <b><?php echo $stok['keluar'] ?? 0; ?></b>
        </div>
    </div>
</div>

<!-- PERMINTAAN -->
<div class="card">
    <div class="card-title">
        <span>🛒 Permintaan Barang</span>
        >
    </div>
    <div class="grid">
        <div class="item">
            Permintaan Baru
            <b><?php echo $permintaan['baru'] ?? 0; ?></b>
        </div>
        <div class="item">
            Selesai
            <b><?php echo $permintaan['selesai'] ?? 0; ?></b>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<div class="navbar">

<div class="nav-item" onclick="location.href='Dashboard_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</div>

<div class="nav-item" onclick="location.href='daftar_barang.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<rect x="3" y="3" width="18" height="18"/>
</svg>
Barang
</div>

<div class="nav-item" onclick="location.href='transaksi.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
</svg>
Transaksi
</div>

<div class="nav-item active" onclick="location.href='laporan.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</div>

<div class="nav-item" onclick="location.href='profil.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</div>

</div>

</body>
</html>