<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM lokasi");
?>
<h2>Lokasi Barang</h2>
<a href="tambah_lokasi.php" class="btn">Tambah lokasi</a><br><br>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nama lokasi</th>
    <th>Aksi</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $row['id_lokasi'] ?></td>
      <td><?= $row['nama_lokasi'] ?></td>
      <td>
        <a href="edit_lokasi.php?id=<?= $row['id_lokasi'] ?>">Edit</a> |
        <a href="hapus_lokasi.php?id=<?= $row['id_lokasi'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>