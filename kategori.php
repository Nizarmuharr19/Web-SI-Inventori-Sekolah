<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM kategori");
?>
<h2>Kategori Barang</h2>
<a href="tambah_kategori.php" class="btn">Tambah Kategori</a><br><br>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $row['id_kategori'] ?></td>
      <td><?= $row['nama_kategori'] ?></td>
      <td>
        <a href="edit_kategori.php?id=<?= $row['id_kategori'] ?>">Edit</a> |
        <a href="hapus_kategori.php?id=<?= $row['id_kategori'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>