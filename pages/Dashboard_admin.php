<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

/* =========================
   AMBIL DATA DASHBOARD
========================= */

// total barang
$total_barang = mysqli_fetch_assoc(mysqli_query($connect,"SELECT SUM(stok) as total FROM barang"))['total'];

// barang masuk
$barang_masuk = mysqli_fetch_assoc(mysqli_query($connect,"SELECT SUM(jumlah) as total FROM transaksi WHERE jenis='masuk'"))['total'];

// barang keluar
$barang_keluar = mysqli_fetch_assoc(mysqli_query($connect,"SELECT SUM(jumlah) as total FROM transaksi WHERE jenis='keluar'"))['total'];

// nilai inventaris
$nilai = mysqli_fetch_assoc(mysqli_query($connect,"SELECT SUM(stok * harga) as total FROM barang"))['total'];

// stok menipis
$stok_tipis = mysqli_query($connect,"SELECT * FROM barang WHERE stok <= 5");

// transaksi terbaru
$transaksi = mysqli_query($connect,"
SELECT t.*, b.nama_barang 
FROM transaksi t
JOIN barang b ON t.id_barang = b.id
ORDER BY t.tanggal DESC, t.jam DESC
LIMIT 5
");

// grafik 7 hari terakhir
$grafik = mysqli_query($connect,"
SELECT tanggal, SUM(jumlah) as total 
FROM transaksi
WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
GROUP BY tanggal
ORDER BY tanggal ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:system-ui;}
body{
    background:#081826;
    color:white;
    font-size:16px;      /* lebih jelas */
    line-height:1.6;     /* lebih lega */
    letter-spacing:0.3px;
}

/* HEADER */
.header{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px;
}

.avatar{
width:42px;height:42px;border-radius:50%;
background:#2f86ff;
display:flex;align-items:center;justify-content:center;
}

.icon{width:22px;height:22px;stroke:white}

/* CONTAINER */
.container{
    padding:0 18px;
    padding-bottom:100px; /* penting */
}

/* GRID */
.grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:12px;
margin-bottom:18px
}

.card{
background:#10293e;
padding:18px;
border-radius:16px
}

.card small{
    font-size:13px;
    color:#8fb3cc;
}

.card h2{
    margin-top:6px;
    font-size:22px;      /* lebih besar */
    font-weight:700;
}

/* WARNING */
.warning{
background:#5a2d14;
border-radius:18px;
padding:18px;
margin-bottom:20px
}

.warning h3{color:#ff9c42}

.warning button{
margin-top:10px;
padding:10px 16px;
border:none;
border-radius:20px;
background:#ff7a18;
color:white;
cursor:pointer;
}

/* GRAPH */
.graph{
background:#10293e;
border-radius:16px;
padding:18px;
margin-bottom:20px
}

.bars{
display:flex;
align-items:flex-end;
gap:10px;
height:120px;
margin-top:15px
}

.bar{
flex:1;
background:#2f86ff;
border-radius:8px
}

/* LIST */
.section-title{
    font-weight:600;
    font-size:16px;      /* lebih jelas */
    margin-bottom:10px;
}

.list{
display:flex;
flex-direction:column;
gap:12px
}

.item{
    background:#10293e;
    padding:14px;
    border-radius:14px;
    display:flex;
    justify-content:space-between;
    font-size:15px;  
}

.item small{
    font-size:13px;
    color:#9bb6cc;
}

/* NAVBAR HORIZONTAL */
.navbar{
position:fixed;
bottom:0;
width:100%;
background:#0e2232;
display:flex;
justify-content:space-around;
align-items:center;
padding:10px 0;
border-top:1px solid #142c3f;
z-index:999;
}

.nav-item{
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:12px;      /* sebelumnya terlalu kecil */
    color:#7ea3c0;
    cursor:pointer;
    flex:1;
}

.nav-item svg{
margin-bottom:4px;
}

.nav-item.active{
color:#2f86ff;
font-weight:bold;
}

.nav-item:active{
transform:scale(0.95);
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
<div style="display:flex;gap:10px;align-items:center;">
<div class="avatar">
<svg class="icon" fill="none" stroke-width="2" viewBox="0 0 24 24">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
</div>
<div>Selamat Datang, <?= $_SESSION['username']; ?></div>
</div>

<!-- ICON LONCENG -->
<svg class="icon" fill="none" stroke-width="2" viewBox="0 0 24 24">
<path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
<path d="M13.73 21a2 2 0 01-3.46 0"/>
</svg>
</div>

<div class="container">

<!-- GRID -->
<div class="grid">
<div class="card"><small>Barang Masuk</small><h2><?= $barang_masuk ?? 0 ?></h2></div>
<div class="card"><small>Jumlah Stok</small><h2><?= $total_barang ?? 0 ?></h2></div>
<div class="card"><small>Barang Keluar</small><h2><?= $barang_keluar ?? 0 ?></h2></div>
<div class="card"><small>Nilai Inventaris</small><h2>Rp <?= number_format($nilai ?? 0,0,',','.') ?></h2></div>
</div>

<!-- WARNING -->
<div class="warning">
<h3>Peringatan</h3>
<p>Stok menipis. Segera pesan ulang.</p>
<button onclick="location.href='DaftarBarang_admin.php'">Lihat Detail</button>
</div>

<!-- GRAPH -->
<div class="graph">
<div class="section-title">Transaksi Minggu Ini</div>
<div class="bars">
<div class="bar" style="height:60%"></div>
<div class="bar" style="height:30%"></div>
<div class="bar" style="height:85%"></div>
<div class="bar" style="height:50%"></div>
<div class="bar" style="height:20%"></div>
<div class="bar" style="height:35%"></div>
<div class="bar" style="height:40%"></div>
</div>
</div>

<!-- LIST -->
<div class="section-title">Transaksi Terbaru</div>
<div class="list">
<div class="item"><div>Oli Mesin MPX-1<br><small>20 pcs masuk</small></div><small>Baru</small></div>
<div class="item"><div>Kampas Rem<br><small>5 pcs keluar</small></div><small>1 jam</small></div>
<div class="item"><div>Busi NGK<br><small>10 pcs keluar</small></div><small>3 jam</small></div>
</div>

</div>

<!-- NAVBAR -->
<div class="navbar">

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Dashboard_admin.php' ? 'active' : '' ?>" onclick="location.href='Dashboard_admin.php'">
<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'DaftarBarang_admin.php' ? 'active' : '' ?>" onclick="location.href='DaftarBarang_admin.php'">
<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
<rect x="3" y="3" width="18" height="18"/>
</svg>
Barang
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Transaksi_admin.php' ? 'active' : '' ?>" onclick="location.href='Transaksi_admin.php'">
<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
</svg>
Transaksi
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Laporan_admin.php' ? 'active' : '' ?>" onclick="location.href='Laporan_admin.php'">
<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Profil_admin.php' ? 'active' : '' ?>" onclick="location.href='Profil_admin.php'">
<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</div>

</div>
<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>
</body>
</html>