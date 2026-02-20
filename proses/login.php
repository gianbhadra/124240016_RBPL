<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($connect,"SELECT * FROM users WHERE username='$username' OR email='$username'");
$data = mysqli_fetch_assoc($query);

if($data){

    if($password === $data['password']){

        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];

        header("Location: http://localhost/124240016_RBPL/pages/Dashboard_admin.php");
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