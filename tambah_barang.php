<?php
include 'koneksi.php';

// Ambil data dari database
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$lokasi = mysqli_query($conn, "SELECT * FROM lokasi");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_lokasi = $_POST['id_lokasi'];
    $kode_barang = $_POST['kode_barang'];
    $kondisi = $_POST['kondisi'];
    $jumlah = $_POST['jumlah'];

    $sql = "INSERT INTO barang (nama_barang, id_kategori, id_lokasi, kode_barang, kondisi, jumlah)
            VALUES ('$nama_barang', '$id_kategori', '$id_lokasi', '$kode_barang', '$kondisi', '$jumlah')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Barang berhasil ditambahkan'); location='barang.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<h2>Tambah Barang</h2>
<form method="post">
  Nama Barang: <input type="text" name="nama_barang" required><br>
  Kategori:
  <select name="id_kategori">
    <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
      <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
    <?php endwhile; ?>
  </select><br>
  Lokasi:
  <select name="id_lokasi">
    <?php while ($l = mysqli_fetch_assoc($lokasi)): ?>
      <option value="<?= $l['id_lokasi'] ?>"><?= $l['nama_lokasi'] ?></option>
    <?php endwhile; ?>
  </select><br>
  Kode Barang: <input type="text" name="kode_barang"><br>
  Kondisi:
  <select name="kondisi">
    <option value="Baik">Baik</option>
    <option value="Rusak Ringan">Rusak Ringan</option>
    <option value="Rusak Berat">Rusak Berat</option>
  </select><br>
  Jumlah: <input type="number" name="jumlah" min="1" required><br>
  <button type="submit">Simpan</button>
</form>