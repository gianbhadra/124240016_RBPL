<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'petugas'){
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
<title>Dashboard Petugas</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    padding-bottom:80px;
}

/* HEADER */
.header{
    padding:20px;
    border-bottom:1px solid #142c3f;
}

.header-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* ICON PROFIL */
.profile-icon{
    width:42px;
    height:42px;
    background:#ffe082;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}

/* ICON LONCENG */
.notif-bell{
    position:relative;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* BADGE MERAH */
.badge{
    position:absolute;
    top:-2px;
    right:-2px;
    width:10px;
    height:10px;
    background:red;
    border-radius:50%;
}

.avatar{
    width:42px;
    height:42px;
    background:#ffe082;
    border-radius:50%;
}

.bell{
    width:20px;
    height:20px;
    background:#ccc;
    border-radius:50%;
}

.welcome{
    margin-top:10px;
    font-size:18px;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    padding:20px;
}

.card{
    background:#12283b;
    padding:18px;
    border-radius:14px;
}

.card span{
    font-size:13px;
    color:#9bb6cc;
}

.card h2{
    margin-top:8px;
}

/* FULL CARD */
.full{
    grid-column:span 2;
}

/* ACTION BUTTON */
.actions{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    padding:0 20px;
}

.btn{
    padding:14px;
    border-radius:12px;
    border:none;
    font-weight:bold;
    cursor:pointer;
}

.btn-primary{ background:#1e88e5; color:white; }
.btn-dark{ background:#142c3f; color:white; }

/* NOTIF */
.section{
    padding:20px;
    font-size:18px;
}

.notif{
    margin:0 20px 12px;
    background:#12283b;
    padding:15px;
    border-radius:12px;
}

.notif-title{
    font-weight:bold;
}

.notif-sub{
    font-size:13px;
    color:#9bb6cc;
    margin-top:4px;
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
    cursor:pointer;
    color:#9bb6cc;
}

.nav-item.active{
    color:#1e88e5;
}

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
    <div class="header-top">

        <!-- PROFIL -->
        <div class="profile-icon" onclick="location.href='Profil.php'">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
            fill="none" stroke="#333" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M6 20c0-4 12-4 12 0"/>
            </svg>
        </div>

        <!-- LONCENG -->
        <div class="notif-bell" onclick="location.href='Notifikasi.php'">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
            <span class="badge"></span>
        </div>

    </div>

    <div class="welcome">Selamat Datang, <?php echo $username; ?></div>
</div>

<!-- GRID -->
<div class="grid">
    <div class="card">
        <span>Total Stok Barang</span>
        <h2>1,482</h2>
    </div>

    <div class="card">
        <span>Stok Kritis</span>
        <h2 style="color:#ffc107">15</h2>
    </div>

    <div class="card full">
        <span>Transaksi Hari Ini</span>
        <h2>8</h2>
    </div>
</div>

<!-- ACTION -->
<div class="actions">
    <button class="btn btn-primary" onclick="location.href='BarangMasuk.php'">Barang Masuk</button>
    <button class="btn btn-dark" onclick="location.href='BarangKeluar.php'">Barang Keluar</button>
</div>

<!-- NOTIF -->
<div class="section">Notifikasi Penting</div>

<div class="notif">
    <div class="notif-title">Stok Menipis</div>
    <div class="notif-sub">Oli Mesin MPX-1</div>
</div>

<div class="notif">
    <div class="notif-title">Barang Keluar</div>
    <div class="notif-sub">Kampas Rem Depan</div>
</div>

<div class="notif">
    <div class="notif-title">Barang Masuk</div>
    <div class="notif-sub">Ban Tubeless FDR</div>
</div>

<!-- NAVBAR -->
<div class="navbar">

    <!-- DASHBOARD -->
    <div class="nav-item active" onclick="location.href='Dashboard_petugas.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 9l9-7 9 7v11H3z"/>
        </svg>
        Dashboard
    </div>

    <!-- STOK -->
    <div class="nav-item" onclick="location.href='Stok.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18"/>
            <path d="M3 9h18"/>
        </svg>
        Stok
    </div>

    <!-- LAPORAN -->
    <div class="nav-item" onclick="location.href='Laporan.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <line x1="4" y1="20" x2="4" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="20" y1="20" x2="20" y2="14"/>
        </svg>
        Laporan
    </div>

    <!-- PROFIL -->
    <div class="nav-item" onclick="location.href='Profil.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
        Profil
    </div>

</div>

</body>
</html>