<?php
include "../proses/config.php";

$keyword = $_GET['keyword'] ?? '';

$data = mysqli_query($connect, "
    SELECT * FROM barang 
    WHERE nama_barang LIKE '%$keyword%' 
    ORDER BY nama_barang ASC
");

while($row = mysqli_fetch_assoc($data)) {

    // ICON DINAMIS
    $nama = strtolower($row['nama_barang']);
    if(strpos($nama, 'oli') !== false){
        $icon = '<path d="M12 2C12 2 7 8 7 12a5 5 0 0010 0c0-4-5-10-5-10z"/>';
    } elseif(strpos($nama, 'busi') !== false){
        $icon = '<line x1="12" y1="2" x2="12" y2="22"/><circle cx="12" cy="6" r="2"/>';
    } elseif(strpos($nama, 'filter') !== false){
        $icon = '<rect x="4" y="6" width="16" height="12"/>';
    } else {
        $icon = '<circle cx="12" cy="12" r="8"/>';
    }
?>

<div class="item" onclick="klikItem(this)">

    <div class="left">
        <div class="icon">
            <svg width="20" height="20" fill="none" stroke="#1e88e5" stroke-width="2">
                <?= $icon ?>
            </svg>
        </div>

        <div>
            <div class="name"><?= $row['nama_barang']; ?></div>
            <div class="kode"><?= $row['kode_barang'] ?? 'BRG-00'.$row['id']; ?></div>
        </div>
    </div>

    <div class="right">
        <?php
        if($row['stok'] <= 0){
            echo "<div class='stok habis'>Stok Habis</div>";
        } elseif($row['stok'] <= 5){
            echo "<div class='stok sedikit'>Stok: ".$row['stok']."</div>";
        } else {
            echo "<div class='stok aman'>Stok: ".$row['stok']."</div>";
        }
        ?>
        <div class="rak">Rak <?= $row['rak'] ?? 'A1'; ?></div>
    </div>

</div>

<?php } ?>