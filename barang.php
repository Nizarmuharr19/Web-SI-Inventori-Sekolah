<?php
include 'koneksi.php';
$sql = "SELECT barang.*, kategori.nama_kategori, lokasi.nama_lokasi FROM barang 
        JOIN kategori ON barang.id_kategori = kategori.id_kategori 
        JOIN lokasi ON barang.id_lokasi = lokasi.id_lokasi";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
</head>
<body>
    <h2>Daftar Barang</h2>
    <a href="tambah_barang.php">Tambah Barang</a>
    <table border="1">
        <tr>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Kode Barang</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['nama_kategori'] ?></td>
                <td><?= $row['nama_lokasi'] ?></td>
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['kondisi'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>
                    <a href="edit_barang.php?id=<?= $row['id_barang'] ?>">Edit</a> |
                    <a href="hapus_barang.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>