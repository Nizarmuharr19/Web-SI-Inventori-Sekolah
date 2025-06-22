<?php
include 'koneksi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasi WHERE id_lokasi='$id'"));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_lokasi'];
    mysqli_query($conn, "UPDATE lokasi SET nama_lokasi='$nama_kategori' WHERE id_lokasi='$id'");
    echo "<script>location='lokasi.php';</script>";
}
?>
<h2>Edit Lokasi</h2>
<form method="post">
  Nama Kategori: <input type="text" name="nama_lokasi" value="<?= $row['nama_lokasi'] ?>" required><br>
  <button type="submit">Perbarui</button>
</form>