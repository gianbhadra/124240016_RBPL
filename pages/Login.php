<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Bengkel</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

/* ===== TOAST LOGIN ===== */
.toast{
    position:fixed;
    top:20px;
    left:50%;
    transform:translateX(-50%);
    background:#ff5252;
    padding:12px 20px;
    border-radius:8px;
    font-size:14px;
    z-index:999;
    opacity:0;
    animation:fadein .4s forwards;
}
@keyframes fadein{ to{opacity:1;} }
.fadeout{ animation:fadeout .5s forwards; }
@keyframes fadeout{ to{opacity:0; top:0;} }
/* ======================= */

.container{
    width:100%;
    max-width:360px;
    padding:20px;
}

.logo{
    width:80px;
    height:80px;
    background:#1e88e5;
    border-radius:50%;
    margin:0 auto 20px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
}

h1{ text-align:center; font-size:24px; margin-bottom:5px; }

.subtitle{
    text-align:center;
    font-size:14px;
    color:#a9c3d8;
    margin-bottom:25px;
}

label{ font-size:14px; color:#bcd2e3; }
.input-group{ margin-bottom:15px; }

input{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    margin-top:6px;
    background:#1a2f44;
    color:white;
    outline:none;
}

input::placeholder{ color:#7f9db7; }

.forgot{
    text-align:right;
    font-size:13px;
    color:#2da2ff;
    margin-top:5px;
    cursor:pointer;
}

/* PASSWORD TOGGLE */
.password-wrap{ position:relative; }
.password-wrap input{ padding-right:45px; }

.toggle{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    display:flex;
}
/* ================= */

button{
    width:100%;
    padding:14px;
    margin-top:20px;
    border:none;
    border-radius:10px;
    background:#1e88e5;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{ background:#1976d2; }

@media(max-width:400px){
    .container{ padding:15px; }
}
</style>
</head>

<body>

<?php if(isset($_GET['error'])){ ?>
<div id="toast" class="toast">
    Login gagal, cek username & password
</div>
<?php } ?>

<div class="container">

<form method="POST" action="/124240016_RBPL/proses/login.php">

<div class="logo">🔧</div>

<h1>Selamat Datang</h1>
<div class="subtitle">Login ke akun Bengkel Eko Motor</div>

<div class="input-group">
<label>Username atau Email</label>
<input type="text" name="username" placeholder="Masukkan username atau email Anda" required>
</div>

<div class="input-group">
<label>Password</label>

<div class="password-wrap">

<input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>

<span class="toggle" onclick="togglePassword()">

<!-- eye open -->
<svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
<circle cx="12" cy="12" r="3"/>
</svg>

<!-- eye close -->
<svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
<path d="M17.94 17.94A10.94 10.94 0 0112 19C5 19 1 12 1 12a21.77 21.77 0 015.06-6.94"/>
<path d="M1 1l22 22"/>
</svg>

</span>

</div>

<div class="forgot">Lupa Password?</div>
</div>

<button type="submit">Login</button>

</form>
</div>

<script>
/* TOAST */
const toast=document.getElementById("toast");
if(toast){
setTimeout(()=>toast.classList.add("fadeout"),2500);
setTimeout(()=>toast.remove(),3000);
}

/* TOGGLE PASSWORD + ICON */
function togglePassword(){
const pass=document.getElementById("password");
const open=document.getElementById("eyeOpen");
const close=document.getElementById("eyeClose");

if(pass.type==="password"){
pass.type="text";
open.style.display="none";
close.style.display="block";
}else{
pass.type="password";
open.style.display="block";
close.style.display="none";
}
}
</script>

</body>
</html>