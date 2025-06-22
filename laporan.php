<?php
include 'koneksi.php';
$data=mysqli_query($conn,"SELECT b.nama_barang, k.nama_kategori, l.nama_lokasi, b.kondisi, b.jumlah 
FROM barang b JOIN kategori k USING(id_kategori) JOIN lokasi l USING(id_lokasi)");
?>
<h2>Laporan Inventori</h2>
<table border="1" cellpadding="8" style="width:100%;">
    <tr><th>Nama Barang</th><th>Kategori</th><th>Lokasi</th><th>Kondisi</th><th>Jumlah</th></tr>
    <?php while($row=mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['nama_barang']?></td>
        <td><?= $row['nama_kategori']?></td>
        <td><?= $row['nama_lokasi']?></td>
        <td><?= $row['kondisi']?></td>
        <td><?= $row['jumlah']?></td>
    </tr>
    <?php } ?>
</table>
