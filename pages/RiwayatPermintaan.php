<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$id_user = $_SESSION['id_user'];

// ambil semua riwayat
$data = mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id_user='$id_user'
    ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Permintaan</title>

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
    border-bottom:1px solid #142c3f;
}

/* LIST */
.list{
    padding:20px;
    display:flex;
    flex-direction:column;
    gap:12px;
}

/* ITEM */
.item{
    background:#12283b;
    padding:16px;
    border-radius:14px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:0.2s;
}

.item:hover{
    background:#16344d;
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
    background:#1a2f44;
    display:flex;
    align-items:center;
    justify-content:center;
}

.text small{
    color:#9bb6cc;
    font-size:12px;
}

/* STATUS */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:500;
}

.proses{background:#5a2d14;color:#ff9c42;}
.selesai{background:#134b2b;color:#4caf50;}
.tolak{background:#4b1313;color:#ff6b6b;}

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
<div class="header">Riwayat Permintaan</div>

<!-- LIST -->
<div class="list">

<?php while($row = mysqli_fetch_assoc($data)){ ?>
<div class="item" onclick="location.href='detail_permintaan.php?id=<?php echo $row['id']; ?>'">

    <div class="left">
        <div class="icon">
            <svg width="20" height="20" fill="none" stroke="#1e88e5" stroke-width="2">
                <path d="M21 16V8l-9-5-9 5v8l9 5 9-5z"/>
            </svg>
        </div>

        <div class="text">
            <div><b><?php echo $row['kode_permintaan']; ?></b></div>
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

<!-- NAVBAR -->
<div class="navbar">

    <div class="nav-item" onclick="location.href='Dashboard_mekanik.php'">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11H3z"/>
        </svg>
        Dashboard
    </div>

    <div class="nav-item active" onclick="location.href='RiwayatPermintaan.php'">
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