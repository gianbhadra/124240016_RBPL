<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:system-ui;}
body{background:#081826;color:white;padding-bottom:90px}

/* HEADER */
.header{display:flex;justify-content:space-between;align-items:center;padding:20px}
.avatar{
width:42px;height:42px;border-radius:50%;
background:#2f86ff;display:flex;align-items:center;justify-content:center;
}
.icon{width:22px;height:22px;stroke:white}

/* CONTAINER */
.container{padding:0 18px}

/* GRID */
.grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px}
.card{background:#10293e;padding:18px;border-radius:16px}
.card small{color:#89a9c4;font-size:12px}
.card h2{margin-top:5px;font-size:20px}

/* WARNING */
.warning{background:#5a2d14;border-radius:18px;padding:18px;margin-bottom:20px}
.warning h3{color:#ff9c42}
.warning button{
margin-top:10px;padding:10px 16px;border:none;border-radius:20px;
background:#ff7a18;color:white
}

/* GRAPH */
.graph{background:#10293e;border-radius:16px;padding:18px;margin-bottom:20px}
.bars{display:flex;align-items:flex-end;gap:10px;height:120px;margin-top:15px}
.bar{flex:1;background:#2f86ff;border-radius:8px}

/* LIST */
.section-title{font-weight:bold;margin-bottom:10px}
.list{display:flex;flex-direction:column;gap:12px}
.item{background:#10293e;padding:14px;border-radius:14px;display:flex;justify-content:space-between}
.item small{color:#89a9c4}

/* BOTTOM NAV */
.bottom{
position:fixed;bottom:0;left:0;width:100%;background:#0c2235;
display:flex;justify-content:space-around;padding:12px 0
}

.nav-item{
text-align:center;
font-size:12px;
color:#7ea3c0;
text-decoration:none;
}

.nav-item svg{
display:block;
margin:auto;
margin-bottom:4px;
}

.active{color:#2f86ff}
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
<div>Selamat Datang, <?= $_SESSION['username'] ?? 'Admin'; ?></div>
</div>

<svg class="icon" fill="none" stroke-width="2" viewBox="0 0 24 24">
<path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
<path d="M13.73 21a2 2 0 01-3.46 0"/>
</svg>
</div>

<div class="container">

<div class="grid">
<div class="card"><small>Barang Masuk</small><h2>88</h2></div>
<div class="card"><small>Jumlah Stok</small><h2>1,420</h2></div>
<div class="card"><small>Barang Keluar</small><h2>112</h2></div>
<div class="card"><small>Nilai Inventaris</small><h2>Rp 250 jt</h2></div>
</div>

<div class="warning">
<h3>Peringatan</h3>
<p>Stok menipis. Segera pesan ulang.</p>
<button>Lihat Detail</button>
</div>

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

<div class="section-title">Transaksi Terbaru</div>
<div class="list">
<div class="item"><div>Oli Mesin MPX-1<br><small>20 pcs masuk</small></div><small>Baru</small></div>
<div class="item"><div>Kampas Rem<br><small>5 pcs keluar</small></div><small>1 jam</small></div>
<div class="item"><div>Busi NGK<br><small>10 pcs keluar</small></div><small>3 jam</small></div>
</div>

</div>

<!-- BOTTOM NAV -->
<div class="bottom">

<a href="Dashboard_admin.php" class="nav-item active">
<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</a>

<a href="barang.php" class="nav-item">
<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<rect x="3" y="3" width="18" height="18"/>
</svg>
Barang
</a>

<a href="transaksi.php" class="nav-item">
<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
</svg>
Transaksi
</a>

<a href="laporan.php" class="nav-item">
<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</a>

<a href="profil.php" class="nav-item">
<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</a>

</div>

</body>
</html>