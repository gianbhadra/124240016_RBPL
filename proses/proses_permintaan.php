<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'mekanik'){
    header("Location: ../Login.php");
    exit;
}

include "config.php"; // pastikan path benar

if(isset($_POST['kirim'])){

    // ambil data
    $id_user = $_SESSION['id_user'];
    $nama_barang = mysqli_real_escape_string($connect, $_POST['nama_barang']);
    $jumlah = (int)$_POST['jumlah'];

    // validasi
    if(empty($nama_barang) || $jumlah <= 0){
        echo "Data tidak valid";
        exit;
    }

    // generate kode otomatis
    $query = mysqli_query($connect, "SELECT kode_permintaan FROM permintaan ORDER BY id DESC LIMIT 1");

    $kode = 'REQ-0001';

    if($query && mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $lastKode = $row['kode_permintaan'];

        $num = (int)str_replace('REQ-', '', $lastKode);
        $num++;

        $kode = 'REQ-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    // insert ke tabel permintaan
    $sql = "INSERT INTO permintaan 
            (id_user, kode_permintaan, nama_barang, jumlah, status, tanggal)
            VALUES 
            ('$id_user', '$kode', '$nama_barang', '$jumlah', 'diproses', NOW())";

    if(mysqli_query($connect, $sql)){

        // ambil id terakhir
        $id_permintaan = mysqli_insert_id($connect);

        // insert notifikasi ke gudang
        mysqli_query($connect, "INSERT INTO notifikasi 
        (id_permintaan, pesan, status_baca, tanggal)
        VALUES 
        ('$id_permintaan', 'Permintaan baru: $nama_barang ($jumlah)', 'belum', NOW())");

        // redirect ke riwayat (sesuaikan folder kamu)
        header("Location: ../pages/RiwayatPermintaan.php");
        exit;

    } else {
        echo "Gagal menambahkan permintaan <br>";
        echo "Error: " . mysqli_error($connect);
    }

} else {
    header("Location: ../pages/PermintaanBaru.php");
    exit;
}
?>