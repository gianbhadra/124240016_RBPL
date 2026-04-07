<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

// ambil semua barang
$data = mysqli_query($connect, "SELECT * FROM barang ORDER BY nama_barang ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cari Barang</title>

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
    padding-bottom:85px;
}

/* HEADER */
.header{
    padding:20px;
    font-size:20px;
    font-weight:600;
    text-align:center;
}

/* SEARCH */
.search{
    margin:0 20px 20px;
    background:#12283b;
    border-radius:30px;
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
    font-size:14px;
}

/* LIST */
.list{
    padding:0 20px;
    display:flex;
    flex-direction:column;
    gap:14px;
}

/* ITEM */
.item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 0;
    transition:0.2s;
    border-radius:10px;
}

.item:active{
    transform:scale(0.96);
    background:#16344d;
}

.left{
    display:flex;
    gap:12px;
    align-items:center;
}

/* ICON */
.icon{
    width:40px;
    height:40px;
    border-radius:10px;
    background:#1a2f44;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* TEXT */
.name{
    font-size:15px;
    font-weight:600;
}

.kode{
    font-size:12px;
    color:#7ea3c0;
}

/* RIGHT */
.right{
    text-align:right;
    font-size:13px;
}

.stok{
    font-weight:600;
}

.habis{color:#ff6b6b;}
.sedikit{color:#ff9800;}
.aman{color:#4caf50;}

.rak{
    font-size:11px;
    color:#7ea3c0;
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
    font-size:12px;
    color:#9bb6cc;
    cursor:pointer;
}

.nav-item svg{
    margin-bottom:4px;
}

.nav-item.active{
    color:#1e88e5;
    font-weight:600;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">Cari Barang</div>

<!-- SEARCH -->
<div class="search">
    <svg width="18" height="18" fill="none" stroke="#9bb6cc" stroke-width="2">
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
    </svg>

    <input type="text" id="search" placeholder="Cari barang...">

    <svg width="18" height="18" fill="none" stroke="#9bb6cc" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>
</div>

<!-- LIST -->
<div class="list" id="hasil">

<?php 
while($row = mysqli_fetch_assoc($data)) { ?>

<div class="item">

    <div class="left">
        <div class="icon">
            <svg width="20" height="20" fill="none" stroke="#1e88e5" stroke-width="2">
                <circle cx="12" cy="12" r="8"/>
            </svg>
        </div>

        <div>
            <div class="name"><?= $row['nama_barang']; ?></div>
            <div class="kode"><?= $row['kode_barang'] ?? 'BRG-00'.$row['id']; ?></div>
        </div>
    </div>

    <div class="right">
        <?php
        if($row['stok'] <= 0){
            echo "<div class='stok habis'>Stok Habis</div>";
        } elseif($row['stok'] <= 5){
            echo "<div class='stok sedikit'>Stok: ".$row['stok']."</div>";
        } else {
            echo "<div class='stok aman'>Stok: ".$row['stok']."</div>";
        }
        ?>
        <div class="rak">Rak A1</div>
    </div>

</div>

<?php } ?>

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

    <div class="nav-item active" onclick="location.href='CariBarang.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Cari Barang
    </div>

</div>

<!-- SEARCH LIVE -->
<script>
document.getElementById("search").addEventListener("keyup", function(){
    let keyword = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "Cari.php?keyword=" + keyword, true);

    xhr.onload = function(){
        document.getElementById("hasil").innerHTML = this.responseText;
    }

    xhr.send();
});
</script>

</body>
</html>