<?php
include "../proses/config.php";

$keyword = $_GET['keyword'];

$query = mysqli_query($connect, "
    SELECT * FROM barang 
    WHERE nama_barang LIKE '%$keyword%'
    ORDER BY id DESC
");

while($row = mysqli_fetch_assoc($query)){
?>

<div class="item">
    <div class="left">
        <div class="icon-box">
<svg width="20" height="20" fill="none" stroke="white" stroke-width="2">
<rect x="3" y="3" width="18" height="18"/>
</svg>
</div>
        <div>
            <div class="name"><?= $row['nama_barang']; ?></div>
            <div class="sub <?= ($row['stok'] <= 5 ? 'low' : '') ?>">
                Stok: <?= $row['stok']; ?> | 
                Rp <?= number_format($row['harga'],0,',','.'); ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>