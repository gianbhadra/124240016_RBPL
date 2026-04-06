<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$username = $_SESSION['username'];

// AMBIL DATA BARANG
$nama_barang = mysqli_query($connect, "SELECT * FROM barang ORDER BY id DESC");

// HAPUS DATA
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($connect, "DELETE FROM barang WHERE id='$id'");
    header("Location: DaftarBarang_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Barang</title>
<link rel="stylesheet" href="style.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    padding-bottom:100px;
}

body{font-size:14px;}
.name{font-size:14px;font-weight:600;}
.sub{font-size:12px;}

.header{
    padding:20px;
    font-size:20px;
    font-weight:bold;
}

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

.list{display:flex;flex-direction:column;}

.item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:16px 20px;
    border-bottom:1px solid #142c3f;
}

.left{display:flex;gap:12px;align-items:center;}

.icon-box{
    width:40px;
    height:40px;
    min-width:40px; /* penting biar ga gepeng */
    background:#1a2f44;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:visible; /* biar ga kepotong */
}

.icon-box svg{
    width:20px;
    height:20px;
    display:block; /* hilangin spasi aneh */
}

.name{font-weight:bold;}
.sub{font-size:13px;color:#9bb6cc;}
.low{color:#ff6b6b;}

.fab{
    position:fixed;
    bottom:80px;
    right:20px;
    width:55px;height:55px;
    border-radius:50%;
    background:#1e88e5;
    display:flex;align-items:center;justify-content:center;
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
    align-items:center;
    padding:10px 0;
    border-top:1px solid #142c3f;
    z-index:999;
}

.nav-item{
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:11px;
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

<div class="header">Daftar Barang</div>

<!-- SEARCH -->
<div class="search">
<svg width="18" height="18" fill="none" stroke="white" stroke-width="2">
<circle cx="11" cy="11" r="8"/>
<line x1="21" y1="21" x2="16.65" y2="16.65"/>
</svg>
<input type="text" id="search" placeholder="Cari barang...">
</div>

<!-- LIST -->
<div class="list" id="hasil">

<?php while($row = mysqli_fetch_assoc($nama_barang)) { ?>

<div class="item">

    <div class="left">
        <div class="icon-box">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <rect x="3" y="3" width="18" height="18"/>
            </svg>
        </div>

        <div>
            <div class="name"><?= $row['nama_barang']; ?></div>
            <div class="sub <?= ($row['stok'] <= 5 ? 'low' : '') ?>">
                Stok: <?= $row['stok']; ?> | 
                Rp <?= number_format($row['harga'],0,',','.'); ?>
            </div>
        </div>
    </div>

    <div style="display:flex; gap:10px;">
        <a href="edit_barang.php?id=<?= $row['id']; ?>">
            <svg width="18" height="18" fill="none" stroke="#4caf50" stroke-width="2">
                <path d="M12 20h9"/>
                <path d="M16.5 3.5l4 4L7 21l-4 1 1-4 12.5-14.5z"/>
            </svg>
        </a>

<a href="?hapus=<?= $row['id']; ?>" onclick="return konfirmasiHapus('<?= $row['nama_barang']; ?>')">
                <svg width="18" height="18" fill="none" stroke="#ff6b6b" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14H6L5 6"/>
            </svg>
        </a>
    </div>

</div>

<?php } ?>

</div>

<!-- FLOAT BUTTON -->
<div class="fab" onclick="location.href='tambah_barang.php'">
<svg width="26" height="26" fill="none" stroke="white" stroke-width="2">
<line x1="12" y1="5" x2="12" y2="19"/>
<line x1="5" y1="12" x2="19" y2="12"/>
</svg>
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

<!-- SCRIPT -->
<script>
// SEARCH LIVE
document.getElementById("search").addEventListener("keyup", function(){
    let keyword = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search_barang.php?keyword=" + keyword, true);

    xhr.onload = function(){
        document.getElementById("hasil").innerHTML = this.responseText;
    }

    xhr.send();
});

</script>

<script>
function konfirmasiHapus(nama){
    return confirm("Yakin ingin menghapus barang: " + nama + " ?");
}
</script>

<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>

</body>
</html>