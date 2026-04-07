<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>

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
    text-align:center;
    padding:22px;
    font-size:22px;
    font-weight:700;
    letter-spacing:0.5px;
}

/* PROFILE */
.profile-box{
    background:#12283b;
    padding:30px 20px;
    text-align:center;
}

.avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    margin:0 auto;
    background:#1a2f44;
    position:relative;
}

.avatar svg{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    width:42px;
    height:42px;
}

.name{
    margin-top:12px;
    font-size:20px;
    font-weight:700;
    letter-spacing:0.3px;
}

.role{
    font-size:14px;
    color:#9bb6cc;
}

/* SECTION */
.section{
    padding:18px 20px 8px;
    font-size:12px;
    color:#7ea3c0;
    font-weight:600;
}

/* MENU */
.menu{
    padding:0 15px;
}

.item{
    background:#12283b;
    border-radius:12px;
    padding:14px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    cursor:pointer;
    transition:0.2s;
}

.item:active{
    transform:scale(0.97);
}

.left{
    display:flex;
    align-items:center;
    gap:12px;
    font-size:14px;
}

.left svg{
    width:20px;
    height:20px;
}

/* SWITCH */
.switch{
    width:42px;
    height:22px;
    background:#2a3f54;
    border-radius:20px;
    position:relative;
    cursor:pointer;
}

.switch::after{
    content:"";
    position:absolute;
    top:3px;
    left:4px;
    width:16px;
    height:16px;
    background:white;
    border-radius:50%;
    transition:0.3s;
}

.switch.active{
    background:#1e88e5;
}

.switch.active::after{
    left:22px;
}

/* LOGOUT */
.logout{
    margin:20px;
    padding:14px;
    border:1px solid #ff6b6b;
    border-radius:12px;
    text-align:center;
    color:#ff6b6b;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.logout:active{
    transform:scale(0.97);
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

<div class="header">Profile</div>

<div class="profile-box">
    <div class="avatar">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
    </div>
    <div class="name"><?php echo $username; ?></div>
    <div class="role">Mekanik</div>
</div>

<div class="section">AKUN</div>

<div class="menu">
    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#2f86ff" stroke-width="2">
                <circle cx="12" cy="8" r="4"/>
                <path d="M6 20c0-4 12-4 12 0"/>
            </svg>
            Kelola Pengguna
        </div>
        <span>›</span>
    </div>

    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#ff9800" stroke-width="2">
                <rect x="3" y="11" width="18" height="10"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
            Keamanan
        </div>
        <span>›</span>
    </div>
</div>

<div class="section">APLIKASI</div>

<div class="menu">

    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#2f86ff" stroke-width="2">
                <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
            </svg>
            Notifikasi
        </div>
        <div class="switch active"></div>
    </div>

    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#9bb6cc" stroke-width="2">
                <path d="M21 12.79A9 9 0 1111.21 3"/>
            </svg>
            Mode Gelap
        </div>
        <div class="switch active" id="darkSwitch"></div>
    </div>

    <div class="item">
        <div class="left">
            <svg fill="none" stroke="#2f86ff" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12" y2="8"/>
            </svg>
            Tentang Aplikasi
        </div>
        <span>›</span>
    </div>

</div>

<div class="logout" onclick="location.href='../proses/logout.php'">
    Logout
</div>

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

    <div class="nav-item active" onclick="location.href='Profil.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
        Profil
    </div>

</div>

<script>
document.querySelectorAll('.switch').forEach(sw => {
    sw.addEventListener('click', function(e){
        e.stopPropagation();
        this.classList.toggle('active');
    });
});
</script>

</body>
</html>