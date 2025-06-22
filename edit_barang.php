<?php
include 'koneksi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'"));

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$lokasi = mysqli_query($conn, "SELECT * FROM lokasi");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_lokasi = $_POST['id_lokasi'];
    $kode_barang = $_POST['kode_barang'];
    $kondisi = $_POST['kondisi'];
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE barang SET nama_barang='$nama_barang', id_kategori='$id_kategori', id_lokasi='$id_lokasi',
             kode_barang='$kode_barang', kondisi='$kondisi', jumlah='$jumlah' WHERE id_barang='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Barang berhasil diupdate'); location='barang.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<h2>Edit Barang</h2>
<form method="post">
  Nama Barang: <input type="text" name="nama_barang" value="<?= $row['nama_barang'] ?>" required><br>
  Kategori:
  <select name="id_kategori">
    <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
      <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
        <?= $k['nama_kategori'] ?>
      </option>
    <?php endwhile; ?>
  </select><br>
  Lokasi:
  <select name="id_lokasi">
    <?php while ($l = mysqli_fetch_assoc($lokasi)): ?>
      <option value="<?= $l['id_lokasi'] ?>" <?= $l['id_lokasi'] == $row['id_lokasi'] ? 'selected' : '' ?>>
        <?= $l['nama_lokasi'] ?>
      </option>
    <?php endwhile; ?>
  </select><br>
  Kode Barang: <input type="text" name="kode_barang" value="<?= $row['kode_barang'] ?>"><br>
  Kondisi:
  <select name="kondisi">
    <option value="Baik" <?= $row['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
    <option value="Rusak Ringan" <?= $row['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
    <option value="Rusak Berat" <?= $row['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
  </select><br>
  Jumlah: <input type="number" name="jumlah" value="<?= $row['jumlah'] ?>" min="1" required><br>
  <button type="submit">Perbarui</button>
</form>