<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
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
<title>Daftar Barang</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial, Helvetica, sans-serif;}

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
}

/* SEARCH */
.search{
    margin:0 20px 20px;
    background:#12283b;
    border-radius:25px;
    padding:12px 16px;
    display:flex;
    align-items:center;
    gap:10px;
}

.search input{
    flex:1;
    background:none;
    border:none;
    outline:none;
    color:white;
}

/* LIST */
.list{
    display:flex;
    flex-direction:column;
}

.item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:16px 20px;
    border-bottom:1px solid #142c3f;
}

.left{
    display:flex;
    align-items:center;
    gap:12px;
}

.icon-box{
    width:40px;
    height:40px;
    background:#1a2f44;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.name{
    font-weight:bold;
}

.sub{
    font-size:13px;
    color:#9bb6cc;
}

.low{ color:#ff6b6b; }

/* FLOAT BUTTON */
.fab{
    position:fixed;
    bottom:80px;
    right:20px;
    width:55px;
    height:55px;
    border-radius:50%;
    background:#1e88e5;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
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
    cursor:pointer;
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
<div class="header">Daftar Barang</div>

<!-- SEARCH -->
<div class="search">
    <svg width="20" height="20" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>
    <input type="text" placeholder="Cari barang...">
</div>

<!-- LIST -->
<div class="list">

<?php while($row = mysqli_fetch_assoc($data_barang)) { ?>

<div class="item">
    <div class="left">
        <div class="icon-box">
            <svg width="22" height="22" fill="none" stroke="#9bb6cc" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
            </svg>
        </div>
        <div>
            <div class="name"><?php echo $row['nama_barang']; ?></div>

            <div class="sub 
                <?php if($row['stok'] <= 5) echo 'low'; ?>">
                
                Stok: <?php echo $row['stok']; ?> | 
                Rp <?php echo number_format($row['harga'],0,',','.'); ?>
            </div>

        </div>
    </div>
</div>

<?php } ?>

</div>

<!-- FLOAT BUTTON -->
<div class="fab" onclick="location.href='tambah_barang.php'">+</div>

<!-- NAVBAR -->
<div class="navbar">

<div class="nav-item" onclick="location.href='Dashboard_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</div>

<div class="nav-item active" onclick="location.href='daftar_barang.php'">
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