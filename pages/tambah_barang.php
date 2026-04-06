<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Barang</title>
<link rel="stylesheet" href="style.css">
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

body{
    background:linear-gradient(180deg,#081826,#0b2233);
    color:white;
    font-size:16px;
    line-height:1.6;
}

/* CONTAINER */
.container{
    max-width:400px;
    margin:40px auto;
    padding:20px;
}

/* TITLE */
.title{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
    text-align:center;
}

/* CARD FORM */
.form-box{
    background:#12283b;
    padding:20px;
    border-radius:16px;
    box-shadow:0 6px 16px rgba(0,0,0,0.3);
}

/* LABEL */
label{
    font-size:14px;
    color:#9bb6cc;
    display:block;
    margin-bottom:6px;
}

/* INPUT */
input{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    margin-bottom:16px;
    font-size:15px;
    background:#0e2232;
    color:white;
}

input:focus{
    border:1px solid #2f86ff;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#2f86ff;
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

button:hover{
    background:#1e6fd9;
}

/* BUTTON GROUP */
.btn-group{
    display:flex;
    gap:10px;
}

/* PRIMARY BUTTON */
.btn-primary{
    flex:1;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#2f86ff;
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.btn-primary:hover{
    background:#1e6fd9;
}

/* SECONDARY BUTTON */
.btn-secondary{
    flex:1;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#2a3f54;
    color:#9bb6cc;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.btn-secondary:hover{
    background:#3a556f;
    color:white;
}

</style>
</head>

<body>

<div class="container">

    <div class="title">Tambah Barang</div>

    <div class="form-box">
        <form method="POST" action="/124240016_RBPL/proses/proses_barang.php">
            
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>

            <label>Stok</label>
            <input type="number" name="stok" required>

            <label>Harga</label>
            <input type="number" name="harga" required>

<div class="btn-group">
    <button type="submit" name="simpan" class="btn-primary">Simpan</button>
    <button type="button" class="btn-secondary" onclick="history.back()">Batal</button>
</div>
        </form>
    </div>

</div>

<script>
if(localStorage.getItem("theme") === "light"){
    document.body.classList.add("light");
}
</script>

</body>
</html>