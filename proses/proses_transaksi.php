<?php
include "../proses/config.php";

$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];
$jenis = $_POST['jenis']; // masuk / keluar

// simpan transaksi
mysqli_query($connect, "
    INSERT INTO transaksi (id_barang, jumlah, jenis, tanggal, jam)
    VALUES ('$id_barang','$jumlah','$jenis',NOW(),NOW())
");

// UPDATE STOK
if($jenis == 'masuk'){
    mysqli_query($connect, "
        UPDATE barang SET stok = stok + $jumlah WHERE id='$id_barang'
    ");
}else{
    mysqli_query($connect, "
        UPDATE barang SET stok = stok - $jumlah WHERE id='$id_barang'
    ");
}

header("Location: Transaksi_admin.php");