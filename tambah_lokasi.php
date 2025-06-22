<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lokasi = $_POST['nama_lokasi'];
    mysqli_query($conn, "INSERT INTO lokasi (nama_lokasi) VALUES ('$nama_lokasi')");
    echo "<script>location='lokasi.php';</script>";
}
?>
<h2>Tambah Lokasi</h2>
<form method="post">
  Nama Lokasi: <input type="text" name="nama_lokasi" required><br>
  <button type="submit">Simpan</button>
</form>