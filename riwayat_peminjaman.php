<?php
include 'koneksi.php';
?>
<h2>Riwayat Peminjaman</h2>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>ID Peminjaman</th>
    <th>Nama Barang</th>
    <th>Nama Peminjam</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
  </tr>
  <?php
  $sql = "SELECT peminjaman.*, barang.nama_barang 
          FROM peminjaman 
          JOIN barang ON peminjaman.id_barang = barang.id_barang";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id_peminjaman'] . "</td>";
      echo "<td>" . $row['nama_barang'] . "</td>";
      echo "<td>" . $row['nama_peminjam'] . "</td>";
      echo "<td>" . $row['tgl_pinjam'] . "</td>";
      echo "<td>" . $row['tanggal_kembali'] . "</td>";
      echo "</tr>";
  }
  ?>
</table>