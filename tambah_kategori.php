<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'];
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
    echo "<script>location='kategori.php';</script>";
}
?>
<h2>Tambah Kategori</h2>
<form method="post">
  Nama Kategori: <input type="text" name="nama_kategori" required><br>
  <button type="submit">Simpan</button>
</form>