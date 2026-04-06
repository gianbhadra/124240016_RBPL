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
<link rel="stylesheet" href="style.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial;}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    font-size:16px; /* naik dari 14 */
    line-height:1.6;
    padding-bottom:100px;
}

/* HEADER */
.header{
    padding:20px;
    font-size:20px; /* lebih besar */
    font-weight:700;
}

/* PROFILE */
.profile{
    padding:0 20px 20px;
    display:flex;
    gap:15px;
    align-items:center;
}

.avatar{
    width:65px;
    height:65px;
    border-radius:50%;
    background:linear-gradient(135deg,#2f86ff,#1e88e5);
    display:flex;
    align-items:center;
    justify-content:center;
}

.name{
    font-weight:600;
    font-size:17px;
}

.email{
    font-size:13px;
    color:#9bb6cc;
}

/* SECTION */
.section{
    padding:14px 20px 6px;
    font-size:12px;
    color:#7ea3c0;
    letter-spacing:1px;
    font-weight:600;
}

/* MENU */
.menu{
    margin:0 20px 18px;
}

.item{
    background:#12283b;
    padding:14px 16px;
    border-radius:14px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    height:56px; /* penting */
    transition:0.2s;
    font-size:15px;
}

.item:hover{
    background:#16344d;
}

.left{
    display:flex;
    align-items:center;
    gap:12px;
    font-size:15px;
    font-weight:500;
}

.left svg{
    width:20px;
    height:20px;
    stroke:#9bb6cc;
    transition:0.3s;
}

/* SAAT AKTIF */
.item.active .left svg{
    stroke:#1e88e5;
}

/* SWITCH */
.switch{
    width:44px;
    height:24px;
    background:#2a3f54;
    border-radius:20px;
    position:relative;
    cursor:pointer;
    transition:0.3s;
}

.switch::after{
    content:"";
    position:absolute;
    top:3px;
    left:4px;
    width:18px;
    height:18px;
    background:white;
    border-radius:50%;
    transition:0.3s;
}

/* aktif */
.switch.active{
    background:#1e88e5;
}

.switch.active::after{
    left:22px;
}

/* LOGOUT */
.logout{
    margin:20px;
    padding:15px;
    border:1px solid #ff6b6b;
    border-radius:12px;
    text-align:center;
    color:#ff6b6b;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
    font-size:15px;
    font-weight:600;
}

.logout:hover{
    background:#ff6b6b;
    color:white;
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
    font-size:11px;
    color:#9bb6cc;
}

.nav-item.active{ color:#2f86ff; }

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
        <svg fill="none" stroke="#2f86ff" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
        Kelola Pengguna
    </div>

    <svg width="16" height="16" fill="none" stroke="#9bb6cc" stroke-width="2">
        <polyline points="9 6 15 12 9 18"/>
    </svg>
</div>

    <div class="item">
    <div class="left">
        <svg fill="none" stroke="#ff9800" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="10"/>
            <path d="M7 11V7a5 5 0 0110 0v4"/>
        </svg>
        Keamanan
    </div>

    <svg width="16" height="16" fill="none" stroke="#9bb6cc" stroke-width="2">
        <polyline points="9 6 15 12 9 18"/>
    </svg>
</div>

<!-- APLIKASI -->
<div class="section">APLIKASI</div>

<div class="menu">

        <div class="item active">
    <div class="left">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
        </svg>
        Notifikasi
    </div>
    <div class="switch active"></div>
</div>

<div class="item active">
    <div class="left">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M21 12.79A9 9 0 1111.21 3"/>
        </svg>
        Mode Gelap
    </div>
    <div class="switch active"></div>
</div>

    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#2f86ff" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12" y2="8"/>
            </svg>
            Tentang Aplikasi
        </div>

        <svg width="16" height="16" fill="none" stroke="#9bb6cc" stroke-width="2">
            <polyline points="9 6 15 12 9 18"/>
        </svg>
    </div>

</div>

<!-- LOGOUT -->
<div class="logout" onclick="location.href='../proses/logout.php'">
    Logout
</div>

<!-- NAVBAR -->
<div class="navbar">

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Dashboard_admin.php' ? 'active' : '' ?>" onclick="location.href='Dashboard_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'DaftarBarang_admin.php' ? 'active' : '' ?>" onclick="location.href='DaftarBarang_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<rect x="3" y="3" width="18" height="18"/>
</svg>
Barang
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Transaksi_admin.php' ? 'active' : '' ?>" onclick="location.href='Transaksi_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
</svg>
Transaksi
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Laporan_admin.php' ? 'active' : '' ?>" onclick="location.href='Laporan_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</div>

<div class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'Profil_admin.php' ? 'active' : '' ?>" onclick="location.href='Profil_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</div>

</div>

<script>
const switches = document.querySelectorAll('.switch');

// load dari localStorage
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");

    // matikan switch mode gelap
    switches[1].classList.remove("active");
}

// klik switch
switches[1].addEventListener("click", function(e){
    e.stopPropagation();

    this.classList.toggle("active");

    if(document.body.classList.contains("light")){
        document.body.classList.remove("light");
        localStorage.setItem("theme", "dark");
    } else {
        document.body.classList.add("light");
        localStorage.setItem("theme", "light");
    }
});
</script>
<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>
</body>
</html>