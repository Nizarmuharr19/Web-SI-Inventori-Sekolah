<?php
include 'koneksi.php';
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'"));
$barang = mysqli_query($conn, "SELECT * FROM barang");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = $_POST['id_barang'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($conn, "UPDATE peminjaman SET id_barang='$id_barang', nama_peminjam='$nama_peminjam',
                      tgl_pinjam='$tgl_pinjam', tanggal_kembali='$tgl_kembali', keterangan='$keterangan'
                      WHERE id_peminjaman='$id'");
    echo "<script>location='peminjaman.php';</script>";
}
?>
<h2>Edit Peminjaman</h2>
<form method="post">
  Barang:
  <select name="id_barang">
    <?php while ($b = mysqli_fetch_assoc($barang)): ?>
      <option value="<?= $b['id_barang'] ?>" <?= $b['id_barang'] == $row['id_barang'] ? 'selected' : '' ?>>
        <?= $b['nama_barang'] ?>
      </option>
    <?php endwhile; ?>
  </select><br>
  Nama Peminjam: <input type="text" name="nama_peminjam" value="<?= $row['nama_peminjam'] ?>" required><br>
  Tanggal Pinjam: <input type="date" name="tgl_pinjam" value="<?= $row['tgl_pinjam'] ?>"><br>
  Tanggal Kembali: <input type="date" name="tgl_kembali" value="<?= $row['tanggal_kembali'] ?>"><br>
  Keterangan: <textarea name="keterangan"><?= $row['keterangan'] ?></textarea><br>
  <button type="submit">Perbarui</button>
</form>