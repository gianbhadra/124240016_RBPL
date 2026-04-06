<?php
include "config.php";

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query($connect, "INSERT INTO barang (nama_barang, stok, harga) 
    VALUES ('$nama','$stok','$harga')");

    header("Location: ../pages/DaftarBarang_admin.php");
    exit;
}
?>