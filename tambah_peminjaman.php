<?php
include 'koneksi.php';
$barang = mysqli_query($conn, "SELECT * FROM barang");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = $_POST['id_barang'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($conn, "INSERT INTO peminjaman (id_barang, nama_peminjam, tgl_pinjam, tanggal_kembali, keterangan)
                        VALUES ('$id_barang', '$nama_peminjam', '$tgl_pinjam', '$tgl_kembali', '$keterangan')");
    echo "<script>location='peminjaman.php';</script>";
}
?>
<h2>Tambah Peminjaman</h2>
<form method="post">
  Barang:
  <select name="id_barang">
    <?php while ($b = mysqli_fetch_assoc($barang)): ?>
      <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
    <?php endwhile; ?>
  </select><br>
  Nama Peminjam: <input type="text" name="nama_peminjam" required><br>
  Tanggal Pinjam: <input type="date" name="tgl_pinjam" required><br>
  Tanggal Kembali: <input type="date" name="tgl_kembali"><br>
  Keterangan: <textarea name="keterangan"></textarea><br>
  <button type="submit">Pinjam</button>
</form>