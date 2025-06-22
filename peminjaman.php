<?php
include 'koneksi.php';
$sql = "SELECT peminjaman.*, barang.nama_barang FROM peminjaman 
        JOIN barang ON peminjaman.id_barang = barang.id_barang";
$result = mysqli_query($conn, $sql);
?>
<h2>Peminjaman</h2>
<a href="tambah_peminjaman.php" class="btn">Tambah Peminjaman</a><br><br>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Nama Peminjam</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Aksi</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $row['id_peminjaman'] ?></td>
      <td><?= $row['nama_barang'] ?></td>
      <td><?= $row['nama_peminjam'] ?></td>
      <td><?= $row['tgl_pinjam'] ?></td>
      <td><?= $row['tanggal_kembali'] ?></td>
      <td>
        <a href="edit_peminjaman.php?id=<?= $row['id_peminjaman'] ?>">Edit</a> |
        <a href="hapus_peminjaman.php?id=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>