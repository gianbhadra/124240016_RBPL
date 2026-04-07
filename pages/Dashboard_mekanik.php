<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$username = $_SESSION['username'];
$id_user = $_SESSION['id_user'];

// ambil data permintaan
$data = mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id_user = '$id_user'
    ORDER BY tanggal DESC
");

// hitung statistik
$pending = mysqli_num_rows(mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id_user='$id_user' AND status='diproses'
"));

$selesai = mysqli_num_rows(mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id_user='$id_user' AND status='selesai'
"));
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
    cursor:pointer;
}

.welcome{
    text-align:left;
    margin-top:10px;
    font-size:20px;
    font-weight:bold;
}

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

.section{padding:20px;font-weight:bold}

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
    color:#9bb6cc;
    cursor:pointer;
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:12px;
}

.nav-item.active{
    color:#1e88e5;
    font-weight:600;
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
    Beranda

    <div class="profile" onclick="location.href='Profil_mekanik.php'">
        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2">
            <circle cx="12" cy="8" r="4"/>
            <path d="M6 20c0-4 12-4 12 0"/>
        </svg>
    </div>

    <div class="welcome">Selamat Datang, <?php echo $username; ?>!</div>
</div>

<!-- BUTTON -->
<div class="btn" onclick="location.href='PermintaanBaru.php'">
    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="16"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
    </svg>
    Buat Permintaan Baru
</div>

<!-- STATS -->
<div class="stats">
    <div class="card"><span>Permintaan Pending</span><h2><?php echo $pending; ?></h2></div>
    <div class="card"><span>Permintaan Selesai</span><h2><?php echo $selesai; ?></h2></div>
</div>

<!-- LIST -->
<div class="section">Permintaan Terbaru</div>
<div class="list">

<?php while($row = mysqli_fetch_assoc($data)){ ?>
<div class="item">

    <div class="left">
        <svg width="24" height="24" fill="none" stroke="#1e88e5" stroke-width="2">
            <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
        </svg>

        <div>
            ID: <?php echo $row['kode_permintaan']; ?><br>
            <small><?php echo date('d M Y', strtotime($row['tanggal'])); ?></small>
        </div>
    </div>

    <div class="badge 
        <?php 
        if($row['status']=='diproses') echo 'proses';
        elseif($row['status']=='selesai') echo 'selesai';
        else echo 'tolak';
        ?>">
        <?php echo ucfirst($row['status']); ?>
    </div>

</div>
<?php } ?>

</div>

<!-- STOK -->
<div class="section">Stok Terlaris</div>

<div class="grid">
    <div class="stock">Oli Mesin<br><small>Stok:15</small></div>
    <div class="stock">Filter Udara<br><small>Stok:24</small></div>
    <div class="stock">Busi<br><small style="color:#ff6b6b">Stok Habis</small></div>
    <div class="stock">Kampas Rem<br><small>Stok:8</small></div>
</div>

<!-- NAVBAR -->
<!-- NAVBAR -->
<div class="navbar">

    <div class="nav-item active" onclick="location.href='Dashboard_mekanik.php'">
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

    <div class="nav-item" onclick="location.href='CariBarang.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Cari
    </div>

</div>

</body>
</html>