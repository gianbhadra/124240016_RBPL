<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: Login.php");
    exit;
}

include "../proses/config.php";

$id = $_GET['id'];
$id_user = $_SESSION['id_user'];

// ambil data sesuai id & user (biar aman)
$query = mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id='$id' AND id_user='$id_user'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "Data tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Permintaan</title>

<style>
body{
    background:#081826;
    color:white;
    font-family:system-ui;
    padding:20px;
}

.card{
    background:#12283b;
    padding:20px;
    border-radius:16px;
}

.item{
    margin-bottom:15px;
}

.label{
    font-size:13px;
    color:#9bb6cc;
}

.value{
    font-size:16px;
    font-weight:500;
}

.badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:20px;
    margin-top:10px;
}

.btn-batal{
    margin-top:15px;
    width:100%;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#d32f2f;
    color:white;
    font-weight:600;
    cursor:pointer;
}

.btn-kembali{
    margin-top:10px;
    width:100%;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#1e88e5;
    color:white;
    font-weight:600;
    cursor:pointer;
}

.proses{background:#5a2d14;color:#ff9c42;}
.selesai{background:#134b2b;color:#4caf50;}
.tolak{background:#4b1313;color:#ff6b6b;}
</style>
</head>

<body>

<h2>Detail Permintaan</h2>

<div class="card">

    <div class="item">
        <div class="label">Kode</div>
        <div class="value"><?php echo $data['kode_permintaan']; ?></div>
    </div>

    <div class="item">
        <div class="label">Nama Barang</div>
        <div class="value"><?php echo $data['nama_barang']; ?></div>
    </div>

    <div class="item">
        <div class="label">Jumlah</div>
        <div class="value"><?php echo $data['jumlah']; ?></div>
    </div>

    <div class="item">
        <div class="label">Tanggal</div>
        <div class="value"><?php echo date('d M Y H:i', strtotime($data['tanggal'])); ?></div>
    </div>

    <div class="item">
        <div class="label">Status</div>

        <div class="badge 
        <?php 
        if($data['status']=='diproses') echo 'proses';
        elseif($data['status']=='selesai') echo 'selesai';
        else echo 'tolak';
        ?>">
            <?php echo ucfirst($data['status']); ?>
        </div>

    </div>

<!-- TOMBOL BATAL -->
<?php if($data['status'] == 'diproses'){ ?>
<form method="POST" action="../proses/batal_permintaan.php">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <button type="submit" class="btn-batal">Batalkan Permintaan</button>
</form>
<?php } ?>

<!-- TOMBOL KEMBALI -->
<button onclick="location.href='RiwayatPermintaan.php'" class="btn-kembali">
    Kembali ke Riwayat
</button>
</div>

</body>
</html>