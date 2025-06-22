<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $id_barang=$_POST['id_barang'];
    $nama_peminjam=$_POST['nama_peminjam'];
    $tgl_pinjam=$_POST['tgl_pinjam'];
    $tanggal_kembali=$_POST['tanggal_kembali'];
    $keterangan=$_POST['keterangan'];
    mysqli_query($conn,"INSERT INTO peminjaman(id_barang,nama_peminjam,tgl_pinjam,tanggal_kembali,keterangan)
        VALUES('$id_barang','$nama_peminjam','$tgl_pinjam','$tanggal_kembali','$keterangan')");
    header('Location: index.php?page=peminjaman');exit;
}
if (isset($_POST['update'])) {
    $id_peminjaman=$_POST['id_peminjaman'];
    $id_barang=$_POST['id_barang'];
    $nama_peminjam=$_POST['nama_peminjam'];
    $tgl_pinjam=$_POST['tgl_pinjam'];
    $tanggal_kembali=$_POST['tanggal_kembali'];
    $keterangan=$_POST['keterangan'];
    mysqli_query($conn,"UPDATE peminjaman SET id_barang='$id_barang', nama_peminjam='$nama_peminjam',
                tgl_pinjam='$tgl_pinjam', tanggal_kembali='$tanggal_kembali', keterangan='$keterangan'
                WHERE id_peminjaman='$id_peminjaman'");
    header('Location: index.php?page=peminjaman');exit;
}
if (isset($_GET['hapus'])) {
    $id=$_GET['hapus'];
    mysqli_query($conn,"DELETE FROM peminjaman WHERE id_peminjaman='$id'");
    header('Location: index.php?page=peminjaman');exit;
}
$editData=null;
if (isset($_GET['edit'])) {
    $id=$_GET['edit'];
    $editData=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM peminjaman WHERE id_peminjaman='$id'"));
}
$data=mysqli_query($conn,"SELECT p.*, b.nama_barang FROM peminjaman p JOIN barang b USING(id_barang)");
$barang=mysqli_query($conn,"SELECT * FROM barang");
?>
<h1 class="header-title">Manajemen Peminjaman</h1>

<style>
    .header-title { font-size:24px; font-weight:bold; margin:30px; color:#1e293b; }
    .flex-container { display:flex; gap:30px; margin:0 30px 40px; align-items:flex-start; }
    .form-box,.table-box { background:#fff; padding:25px 30px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
    .form-box { flex:1; max-width:400px; } .table-box { flex:2; overflow-x:auto; }
    label { font-weight:600; font-size:14px; } .input { width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px; margin-bottom:16px; }
    .btn { background:#3b82f6; color:#fff; padding:10px 16px; border:none; border-radius:8px; font-weight:600; cursor:pointer; text-decoration:none; }
    .btn.gray { background:#e2e8f0; color:#1e293b; } table { width:100%; border-collapse: collapse; } table th,table td { padding:10px; border:1px solid #e2e8f0; } table thead { background:#f8fafc; }
</style>

<div class="flex-container">
    <div class="form-box">
        <form method="post">
            <input type="hidden" name="id_peminjaman" value="<?= $editData['id_peminjaman']??'' ?>">
            <label>Barang</label>
            <select class="input" name="id_barang" required>
                <?php while ($b=mysqli_fetch_assoc($barang)) { ?>
                    <option value="<?= $b['id_barang']?>" <?= $editData && $editData['id_barang']==$b['id_barang']?'selected':'' ?>><?= $b['nama_barang']?></option>
                <?php } ?>
            </select>
            <label>Nama Peminjam</label>
            <input class="input" name="nama_peminjam" value="<?= $editData['nama_peminjam']??'' ?>" required>
            <label>Tgl Pinjam</label>
            <input class="input" type="date" name="tgl_pinjam" value="<?= $editData['tgl_pinjam']??'' ?>" required>
            <label>Tanggal Kembali</label>
            <input class="input" type="date" name="tanggal_kembali" value="<?= $editData['tanggal_kembali']??'' ?>">
            <label>Keterangan</label>
            <input class="input" name="keterangan" value="<?= $editData['keterangan']??'' ?>">
            <button type="submit" name="<?= $editData?'update':'simpan' ?>" class="btn"><?= $editData?'Update':'Simpan' ?></button>
        </form>
    </div>
    <div class="table-box">
        <table>
            <thead><tr><th>ID</th><th>Barang</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Keterangan</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while ($row=mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['id_peminjaman']?></td>
                    <td><?= $row['nama_barang']?></td>
                    <td><?= $row['nama_peminjam']?></td>
                    <td><?= $row['tgl_pinjam']?></td>
                    <td><?= $row['tanggal_kembali']?></td>
                    <td><?= $row['keterangan']?></td>
                    <td>
                        <a href="index.php?page=peminjaman&edit=<?= $row['id_peminjaman']?>" class="btn">Edit</a>
                        <a href="index.php?page=peminjaman&hapus=<?= $row['id_peminjaman']?>" class="btn gray" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
