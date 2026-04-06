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
    font-size:14px;
    line-height:1.5;
    padding-bottom:100px;
}

.header{
    padding:20px;
    font-size:18px;
    font-weight:600;
}

.section{
    padding:0 20px;
    margin-bottom:10px;
    font-size:13px;
    font-weight:600;
    color:#9bb6cc;
}

.nama{
    font-size:14px;
    font-weight:600;
}

.sub{
    font-size:12px;
    color:#9bb6cc;
}

.time{
    font-size:11px;
    color:#9bb6cc;
}

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

.section{
    padding:0 20px;
    margin-bottom:10px;
    font-weight:bold;
}

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
    background:#10293e;
    padding:12px 14px;
    border-radius:12px;
}

.left{
    display:flex;
    gap:12px;
    align-items:center;
}

.icon{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.icon svg{
    width:18px;
    height:18px;
    display:block;
}

.masuk{ background:#134b2b; }
.keluar{ background:#4b1313; }

.nama{ font-weight:bold; }
.sub{ font-size:13px; color:#9bb6cc; }

.right{ text-align:right; }

.plus{ color:#4caf50; font-weight:bold; }
.minus{ color:#ff6b6b; font-weight:bold; }

.time{
    font-size:12px;
    color:#9bb6cc;
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

<div class="header">Daftar Transaksi</div>

<div class="filter">
    <div style="flex:1; display:flex; align-items:center; background:#12283b; border-radius:20px; padding:8px 12px;">
        <svg width="16" height="16" fill="none" stroke="#9bb6cc" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="search" placeholder="Cari nama barang / tanggal..." 
        style="flex:1; background:none; border:none; outline:none; color:white; margin-left:8px; font-size:13px;">
    </div>
</div>

<!-- LIST -->
<div class="list">

<?php
$current_date = "";

while($row = mysqli_fetch_assoc($data)){

    $tgl = date('d F Y', strtotime($row['tanggal']));

    if($tgl != $current_date){
        echo "<div class='section'>$tgl</div>";
        $current_date = $tgl;
    }
?>

<div class="item">

    <div class="left">

        <div class="icon <?php echo $row['jenis']=='masuk' ? 'masuk' : 'keluar'; ?>">
            
            <?php if($row['jenis']=='masuk'){ ?>
            <!-- ICON MASUK -->
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <polyline points="12 5 12 19"/>
                <polyline points="5 12 12 19 19 12"/>
            </svg>
            <?php } else { ?>
            <!-- ICON KELUAR -->
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
                <polyline points="12 19 12 5"/>
                <polyline points="5 12 12 5 19 12"/>
            </svg>
            <?php } ?>

        </div>

        <div>
            <div class="nama"><?php echo htmlspecialchars($row['nama_barang']); ?></div>
            <div class="sub"><?php echo ucfirst($row['jenis']); ?></div>
        </div>

    </div>

    <div class="right">
        <div class="<?php echo $row['jenis']=='masuk' ? 'plus' : 'minus'; ?>">
            <?php echo $row['jenis']=='masuk' ? '+' : '-'; ?>
            <?php echo $row['jumlah']; ?> Pcs
        </div>
        <div class="time">
            <?php echo date('H:i', strtotime($row['jam'])); ?>
        </div>
    </div>

</div>

<?php } ?>

</div>

<!-- NAVBAR -->
<div class="navbar">

<div class="nav-item" onclick="location.href='Dashboard_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<path d="M3 9l9-7 9 7v11H3z"/>
</svg>
Dashboard
</div>

<div class="nav-item" onclick="location.href='DaftarBarang_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<rect x="3" y="3" width="18" height="18"/>
</svg>
Barang
</div>

<div class="nav-item active" onclick="location.href='Transaksi_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
</svg>
Transaksi
</div>

<div class="nav-item" onclick="location.href='Laporan_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<line x1="4" y1="20" x2="4" y2="10"/>
<line x1="12" y1="20" x2="12" y2="4"/>
<line x1="20" y1="20" x2="20" y2="14"/>
</svg>
Laporan
</div>

<div class="nav-item" onclick="location.href='Profil_admin.php'">
<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="8" r="4"/>
<path d="M6 20c0-4 12-4 12 0"/>
</svg>
Profil
</div>

</div>

<script>
document.getElementById("search").addEventListener("keyup", function(){
    let keyword = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search_transaksi.php?keyword=" + keyword, true);

    xhr.onload = function(){
        document.querySelector(".list").innerHTML = this.responseText;
    }

    xhr.send();
});
</script>

<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>

</body>
</html>