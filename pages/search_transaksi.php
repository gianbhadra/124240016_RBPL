<?php
include "../proses/config.php";

$keyword = $_GET['keyword'];

$query = mysqli_query($connect, "
    SELECT t.*, b.nama_barang 
    FROM transaksi t 
    JOIN barang b ON t.id_barang = b.id
    WHERE 
        b.nama_barang LIKE '%$keyword%' 
        OR t.tanggal LIKE '%$keyword%'
    ORDER BY t.tanggal DESC, t.jam DESC
");

$current_date = "";

while($row = mysqli_fetch_assoc($query)){

    $tgl = date('d F Y', strtotime($row['tanggal']));

    if($tgl != $current_date){
        echo "<div class='section'>$tgl</div>";
        $current_date = $tgl;
    }
?>

<div class="item">

    <div class="left">
        <div class="icon <?php echo $row['jenis']=='masuk' ? 'masuk' : 'keluar'; ?>">
            
            <?php if($row['jenis']=='masuk'){ ?>
            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2">
                <polyline points="12 5 12 19"/>
                <polyline points="5 12 12 19 19 12"/>
            </svg>
            <?php } else { ?>
            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2">
                <polyline points="12 19 12 5"/>
                <polyline points="5 12 12 5 19 12"/>
            </svg>
            <?php } ?>

        </div>

        <div>
            <div class="nama"><?php echo htmlspecialchars($row['nama_barang']); ?></div>
            <div class="sub"><?php echo ucfirst($row['jenis']); ?></div>
        </div>
    </div>

    <div class="right">
        <div class="<?php echo $row['jenis']=='masuk' ? 'plus' : 'minus'; ?>">
            <?php echo $row['jenis']=='masuk' ? '+' : '-'; ?>
            <?php echo $row['jumlah']; ?> Pcs
        </div>
        <div class="time">
            <?php echo date('H:i', strtotime($row['jam'])); ?>
        </div>
    </div>

</div>

<?php } ?>