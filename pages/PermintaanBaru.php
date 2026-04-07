<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buat Permintaan</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    padding-bottom:90px;
}

/* HEADER */
.header{
    padding:20px;
    text-align:center;
    font-size:20px;
    font-weight:600;
}

/* FORM */
.container{
    padding:20px;
}

.card{
    background:#12283b;
    padding:18px;
    border-radius:16px;
    margin-bottom:15px;
}

label{
    font-size:13px;
    color:#9bb6cc;
    display:block;
    margin-bottom:6px;
}

input, select, textarea{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    background:#0e2232;
    color:white;
    font-size:14px;
    margin-bottom:14px;
}

/* BUTTON */
.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#1e88e5;
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.btn:active{
    transform:scale(0.97);
    background:#1565c0;
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
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:11px;
    color:#9bb6cc;
    cursor:pointer;
}

.nav-item svg{
    margin-bottom:4px;
}

.nav-item.active{
    color:#1e88e5;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">Buat Permintaan</div>

<div class="container">

<form method="POST" action="../proses/proses_permintaan.php">

    <div class="card">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" placeholder="Contoh: Oli Mesin" required>

        <label>Jumlah</label>
        <input type="number" name="jumlah" placeholder="Masukkan jumlah" required>
    </div>

    <button type="submit" class="btn" name="kirim">Kirim Permintaan</button>

</form>

</div>

<!-- NAVBAR -->
<div class="navbar">

    <div class="nav-item" onclick="location.href='Dashboard_mekanik.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11H3z"/>
        </svg>
        Dashboard
    </div>

    <div class="nav-item" onclick="location.href='RiwayatPermintaan.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 3h18v18H3z"/>
            <path d="M8 12h8M8 8h8M8 16h5"/>
        </svg>
        Riwayat
    </div>

    <div class="nav-item active">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="16"/>
            <line x1="8" y1="12" x2="16" y2="12"/>
        </svg>
        Permintaan
    </div>

</div>

</body>
</html>