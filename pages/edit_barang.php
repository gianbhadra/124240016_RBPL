<?php
include "../proses/config.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM barang WHERE id='$id'"));

if(isset($_POST['update'])){
    $nama = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query($connect, "UPDATE barang SET 
        nama_barang='$nama',
        stok='$stok',
        harga='$harga'
        WHERE id='$id'
    ");

    echo "<script>
        alert('Data berhasil diupdate!');
        window.location='DaftarBarang_admin.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Barang</title>
<link rel="stylesheet" href="style.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
}

/* HEADER */
.header{
    padding:20px;
    font-size:20px;
    font-weight:bold;
}

/* CARD FORM */
.card{
    background:#12283b;
    margin:20px;
    padding:20px;
    border-radius:16px;
}

/* INPUT */
input{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:none;
    border-radius:10px;
    background:#1a2f44;
    color:white;
    outline:none;
}

/* BUTTON */
.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#1e88e5;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{
    opacity:0.9;
}

.btn-batal{
    display:flex;
    align-items:center;
    justify-content:center;
    width:100%;
    padding:12px;
    border-radius:10px;
    background:#ff6b6b;
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.btn-batal:hover{
    opacity:0.9;
}
</style>

</head>
<body>

<div class="header">Edit Barang</div>

<div class="card">
<form method="POST" id="formEdit">
<input type="hidden" name="update" value="1">

    Nama Barang:
    <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>

    Stok:
    <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

    Harga:
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

    <div style="display:flex; gap:10px;">
    <button type="button" class="btn" onclick="konfirmasiUpdate()">Update</button>        
    <a href="DaftarBarang_admin.php" class="btn-batal">Batal</a>
    </div>

</form>
</div>

<script>
function konfirmasiUpdate(){
    if(confirm("Yakin ingin mengupdate data ini?")){
        document.getElementById("formEdit").submit();
    }
}
</script>

<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>

</body>
</html>