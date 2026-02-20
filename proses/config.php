<?php
    $hostname = "localhost"; 
    $username = "root"; 
    $password = "";
    $database = "eko_bengkel";
$connect = mysqli_connect($hostname, $username, $password, $database);
    if (!$connect) { 
        die('maaf koneksi gagal: ' . mysqli_connect_error()); 
    }
?>