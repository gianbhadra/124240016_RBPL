<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$username = $_SESSION['username'];

// ambil data user
$user = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT * FROM users WHERE username='$username'
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>

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
    font-size:22px;
    font-weight:bold;
}

/* PROFILE */
.profile{
    padding:0 20px 20px;
    display:flex;
    gap:15px;
    align-items:center;
}

.avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#1a2f44;
    display:flex;
    align-items:center;
    justify-content:center;
}

.name{
    font-weight:bold;
}

.email{
    font-size:13px;
    color:#9bb6cc;
}

/* SECTION */
.section{
    padding:10px 20px;
    font-size:13px;
    color:#9bb6cc;
}

/* MENU */
.menu{
    margin:0 20px 15px;
}

.item{
    background:#12283b;
    padding:15px;
    border-radius:12px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    cursor:pointer;
}

.left{
    display:flex;
    gap:10px;
    align-items:center;
}

/* SWITCH */
.switch{
    width:40px;
    height:20px;
    background:#1e88e5;
    border-radius:20px;
    position:relative;
}

.switch::after{
    content:"";
    position:absolute;
    top:2px;
    left:20px;
    width:16px;
    height:16px;
    background:white;
    border-radius:50%;
}

/* LOGOUT */
.logout{
    margin:20px;
    padding:15px;
    border:1px solid #ff6b6b;
    border-radius:12px;
    text-align:center;
    color:#ff6b6b;
    font-weight:bold;
    cursor:pointer;
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
<div class="header">Profile</div>

<!-- PROFILE -->
<div class="profile">
    <div class="avatar">
        <svg width="28" height="28" fill="none" stroke="white" stroke-width="2">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
    </div>
    <div>
        <div class="name"><?php echo $user['username']; ?></div>
        <div class="email"><?php echo $user['email']; ?></div>
    </div>
</div>

<!-- AKUN -->
<div class="section">AKUN</div>

<div class="menu">
    <div class="item" onclick="location.href='kelola_user.php'">
        <div class="left">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <circle cx="12" cy="8" r="4"/>
                <path d="M6 20c0-4 12-4 12 0"/>
            </svg>
            Kelola Pengguna
        </div>
        >
    </div>

    <div class="item">
        <div class="left">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <rect x="3" y="11" width="18" height="10"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
            Keamanan
        </div>
        >
    </div>
</div>

<!-- APLIKASI -->
<div class="section">APLIKASI</div>

<div class="menu">
    <div class="item">
        <div class="left">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
            </svg>
            Notifikasi
        </div>
        <div class="switch"></div>
    </div>

    <div class="item">
        <div class="left">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <path d="M21 12.79A9 9 0 1111.21 3"/>
            </svg>
            Mode Gelap
        </div>
        <div class="switch"></div>
    </div>

    <div class="item">
        <div class="left">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12" y2="8"/>
            </svg>
            Tentang Aplikasi
        </div>
        >
    </div>
</div>

<!-- LOGOUT -->
<div class="logout" onclick="location.href='../proses/logout.php'">
    Logout
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

<div class="nav-item" onclick="location.href='laporan.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</div>

<div class="nav-item active" onclick="location.href='profil.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</div>

</div>

</body>
</html>