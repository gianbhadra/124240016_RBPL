<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($connect,"SELECT * FROM users WHERE username='$username' OR email='$username'");
$data = mysqli_fetch_assoc($query);

if($data){

    if($password === $data['password']){

        // simpan session
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // redirect sesuai role
        if($data['role'] == 'admin'){
            header("Location: http://localhost/124240016_RBPL/pages/Dashboard_admin.php");
        }
        elseif($data['role'] == 'mekanik'){
            header("Location: http://localhost/124240016_RBPL/pages/Dashboard_mekanik.php");
        }
        elseif($data['role'] == 'petugas'){
            header("Location: http://localhost/124240016_RBPL/pages/Dashboard_petugas.php");
        }
        else{
            header("Location: http://localhost/124240016_RBPL/pages/Login.php");
        }

        exit;

    }else{
        header("Location: http://localhost/124240016_RBPL/pages/Login.php?error=1");
        exit;
    }

}else{
    header("Location: http://localhost/124240016_RBPL/pages/Login.php?error=1");
    exit;
}
?>