<?php
include 'koneksi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id'"));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'];
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id'");
    echo "<script>location='kategori.php';</script>";
}
?>
<h2>Edit Kategori</h2>
<form method="post">
  Nama Kategori: <input type="text" name="nama_kategori" value="<?= $row['nama_kategori'] ?>" required><br>
  <button type="submit">Perbarui</button>
</form>