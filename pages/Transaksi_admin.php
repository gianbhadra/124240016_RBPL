<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

// ambil data transaksi
$data = mysqli_query($connect, "
    SELECT t.*, b.nama_barang 
    FROM transaksi t 
    JOIN barang b ON t.id_barang = b.id
    ORDER BY tanggal DESC, jam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Transaksi</title>

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
    font-size:20px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* FILTER */
.filter{
    display:flex;
    gap:10px;
    padding:0 20px 20px;
}

.filter button{
    background:#12283b;
    border:none;
    padding:10px 14px;
    border-radius:20px;
    color:#9bb6cc;
    font-size:12px;
}

/* SECTION */
.section{
    padding:0 20px;
    margin-bottom:10px;
    font-weight:bold;
}

/* LIST */
.list{
    display:flex;
    flex-direction:column;
    gap:12px;
    padding:0 20px 20px;
}

.item{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.left{
    display:flex;
    gap:12px;
    align-items:center;
}

/* ICON BOX */
.icon{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.masuk{ background:#134b2b; }
.keluar{ background:#4b1313; }

.nama{ font-weight:bold; }
.sub{ font-size:13px; color:#9bb6cc; }

.right{
    text-align:right;
}

.plus{ color:#4caf50; font-weight:bold; }
.minus{ color:#ff6b6b; font-weight:bold; }

.time{
    font-size:12px;
    color:#9bb6cc;
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
<div class="header">
    Daftar Transaksi
    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>
</div>

<!-- FILTER -->
<div class="filter">
    <button>📅 Semua Tanggal</button>
    <button>🔄 Semua Jenis</button>
</div>

<?php
$current_date = "";
while($row = mysqli_fetch_assoc($data)){

    $tgl = date('d F Y', strtotime($row['tanggal']));

    if($tgl != $current_date){
        echo "<div class='section'>$tgl</div>";
        $current_date = $tgl;
    }
?>

<div class="list">
<div class="item">

    <div class="left">

        <!-- ICON -->
        <div class="icon <?php echo $row['jenis']=='masuk' ? 'masuk' : 'keluar'; ?>">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
            </svg>
        </div>

        <!-- INFO -->
        <div>
            <div class="nama"><?php echo $row['nama_barang']; ?></div>
            <div class="sub"><?php echo ucfirst($row['jenis']); ?></div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="<?php echo $row['jenis']=='masuk' ? 'plus' : 'minus'; ?>">
            <?php echo $row['jenis']=='masuk' ? '+' : '-'; ?>
            <?php echo $row['jumlah']; ?> Pcs
        </div>
        <div class="time"><?php echo date('H:i', strtotime($row['jam'])); ?></div>
    </div>

</div>
</div>

<?php } ?>

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

<div class="nav-item active" onclick="location.href='transaksi.php'">
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