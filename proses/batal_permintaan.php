<?php
session_start();
include "config.php";

if(!isset($_SESSION['login'])){
    header("Location: ../Login.php");
    exit;
}

$id = $_POST['id'];
$id_user = $_SESSION['id_user'];

// cek valid
$query = mysqli_query($connect, "
    SELECT * FROM permintaan 
    WHERE id='$id' AND id_user='$id_user' AND status='diproses'
");

if(mysqli_num_rows($query) > 0){

    // ubah status
    mysqli_query($connect, "
        UPDATE permintaan 
        SET status='ditolak' 
        WHERE id='$id'
    ");

    // kirim notifikasi ke gudang
    mysqli_query($connect, "
        INSERT INTO notifikasi (id_permintaan, pesan, status_baca, tanggal)
        VALUES ('$id', 'Permintaan dibatalkan oleh mekanik', 'belum', NOW())
    ");

    header("Location: ../pages/RiwayatPermintaan.php");
    exit;

} else {
    echo "Tidak bisa dibatalkan";
}
?>