<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Mekanik</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial, Helvetica, sans-serif;}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    padding-bottom:85px;
}

/* HEADER */
.header{
    padding:20px;
    border-bottom:1px solid #142c3f;
    text-align:center;
    position:relative;
}

.profile{
    position:absolute;
    right:20px;
    top:20px;
}

.welcome{
    text-align:left;
    margin-top:10px;
    font-size:20px;
    font-weight:bold;
}

/* BUTTON */
.btn{
    margin:20px;
    padding:14px;
    border-radius:12px;
    background:#1e88e5;
    text-align:center;
    font-weight:bold;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    cursor:pointer;
}

/* STATS */
.stats{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    padding:0 20px;
}

.card{
    background:#12283b;
    padding:18px;
    border-radius:14px;
}

.card span{color:#9bb6cc;font-size:13px;}
.card h2{margin-top:5px}

/* SECTION */
.section{padding:20px;font-weight:bold}

/* LIST */
.list{padding:0 20px;display:flex;flex-direction:column;gap:12px;}

.item{
    background:#12283b;
    padding:15px;
    border-radius:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.left{
    display:flex;
    gap:12px;
    align-items:center;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
}

.proses{background:#5a2d14;color:#ff9c42;}
.selesai{background:#134b2b;color:#4caf50;}
.tolak{background:#4b1313;color:#ff6b6b;}

/* GRID STOK */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    padding:0 20px;
}

.stock{
    background:#12283b;
    padding:18px;
    border-radius:14px;
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
    cursor:pointer;
}

.nav-item.active{color:#1e88e5;}

.nav-item svg{display:block;margin:auto;margin-bottom:4px;}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    Beranda

    <div class="profile">
        <!-- icon profil -->
        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
    </div>

    <div class="welcome">Selamat Datang, <?php echo $username; ?>!</div>
</div>

<!-- BUTTON -->
<div class="btn" onclick="location.href='PermintaanBaru.php'">
    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="16"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
    </svg>
    Buat Permintaan Baru
</div>

<!-- STATS -->
<div class="stats">
    <div class="card"><span>Permintaan Pending</span><h2>3</h2></div>
    <div class="card"><span>Permintaan Selesai</span><h2>12</h2></div>
</div>

<!-- LIST -->
<div class="section">Permintaan Terbaru</div>

<div class="list">

    <div class="item">
        <div class="left">
            <!-- icon box -->
            <svg width="24" height="24" fill="none" stroke="#1e88e5" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
            </svg>
            <div>ID: REQ-00124<br><small>12 Des 2025</small></div>
        </div>
        <div class="badge proses">Diproses</div>
    </div>

    <div class="item">
        <div class="left">
            <svg width="24" height="24" fill="none" stroke="#1e88e5" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
            </svg>
            <div>ID: REQ-00123<br><small>11 Des 2025</small></div>
        </div>
        <div class="badge selesai">Selesai</div>
    </div>

    <div class="item">
        <div class="left">
            <svg width="24" height="24" fill="none" stroke="#1e88e5" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
            </svg>
            <div>ID: REQ-00122<br><small>10 Des 2025</small></div>
        </div>
        <div class="badge tolak">Ditolak</div>
    </div>

</div>

<!-- STOK -->
<div class="section">Stok Terlaris</div>

<div class="grid">

    <div class="stock">
        <!-- droplet -->
        <svg width="24" height="24" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 2C8 7 5 10 5 14a7 7 0 0014 0c0-4-3-7-7-12z"/>
        </svg>
        <div>Oli Mesin<br><small>Stok:15</small></div>
    </div>

    <div class="stock">
        <!-- filter -->
        <svg width="24" height="24" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
        <div>Filter Udara<br><small>Stok:24</small></div>
    </div>

    <div class="stock">
        <!-- busi -->
        <svg width="24" height="24" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="13 2 13 9 18 9 11 22 11 15 6 15"/>
        </svg>
        <div>Busi<br><small style="color:#ff6b6b">Stok Habis</small></div>
    </div>

    <div class="stock">
        <!-- rem -->
        <svg width="24" height="24" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="3"/>
            <circle cx="12" cy="12" r="9"/>
        </svg>
        <div>Kampas Rem<br><small>Stok:8</small></div>
    </div>

</div>

<!-- NAVBAR -->
<div class="navbar">

    <div class="nav-item active" onclick="location.href='Dashboard_mekanik.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 9l9-7 9 7v11H3z"/>
        </svg>
        Dashboard
    </div>

    <div class="nav-item" onclick="location.href='Riwayat.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="1 4 1 10 7 10"/>
            <path d="M3.5 15a9 9 0 1 0 2.1-9.36L1 10"/>
        </svg>
        Riwayat
    </div>

    <div class="nav-item" onclick="location.href='Cari.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Cari Barang
    </div>

</div>

</body>
</html>