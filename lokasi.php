<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $nama_lokasi = $_POST['nama_lokasi'];
    mysqli_query($conn,"INSERT INTO lokasi(nama_lokasi) VALUES('$nama_lokasi')");
    header('Location: index.php?page=lokasi');exit;
}
if (isset($_POST['update'])) {
    $id_lokasi=$_POST['id_lokasi'];
    $nama_lokasi=$_POST['nama_lokasi'];
    mysqli_query($conn,"UPDATE lokasi SET nama_lokasi='$nama_lokasi' WHERE id_lokasi='$id_lokasi'");
    header('Location: index.php?page=lokasi');exit;
}
if (isset($_GET['hapus'])) {
    $id=$_GET['hapus'];
    mysqli_query($conn,"DELETE FROM lokasi WHERE id_lokasi='$id'");
    header('Location: index.php?page=lokasi');exit;
}
$editData=null;
if (isset($_GET['edit'])) {
    $id=$_GET['edit'];
    $editData=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM lokasi WHERE id_lokasi='$id'"));
}
$data=mysqli_query($conn,"SELECT * FROM lokasi");
?>
<h1 class="header-title">Manajemen Lokasi</h1>

<style>
    .header-title {
        font-size: 24px;
        font-weight: bold;
        margin: 30px;
        color: #1e293b;
    }

    .flex-container {
        display: flex;
        gap: 30px;
        margin: 0 30px 40px;
        align-items: flex-start;
    }

    .form-box,
    .table-box {
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-box {
        flex: 1;
        max-width: 400px;
    }

    .table-box {
        flex: 2;
        overflow-x: auto;
    }

    label {
        font-weight: 600;
        font-size: 14px;
    }

    .input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 16px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
    }

    .btn {
        background: #3b82f6;
        color: white;
        padding: 10px 16px;
        font-size: 14px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
    }

    .btn.gray {
        background: #e2e8f0;
        color: #1e293b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    table th,
    table td {
        border: 1px solid #e2e8f0;
        padding: 10px;
        text-align: left;
    }

    table thead {
        background-color: #f8fafc;
    }
</style>

<div class="flex-container">
    <div class="form-box">
        <form method="post">
            <input type="hidden" name="id_lokasi" value="<?= $editData['id_lokasi']??'' ?>">
            <label>Nama Lokasi</label>
            <input class="input" name="nama_lokasi" value="<?= $editData['nama_lokasi']??'' ?>" required>
            <button type="submit" name="<?= $editData?'update':'simpan' ?>"class="btn"><?= $editData?'Update':'Simpan' ?></button>
        </form>
    </div>
    <div class="table-box">
        <table>
            <thead><tr><th>ID</th><th>Nama Lokasi</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while ($row=mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['id_lokasi'] ?></td>
                    <td><?= $row['nama_lokasi'] ?></td>
                    <td>
                        <a href="index.php?page=lokasi&edit=<?= $row['id_lokasi'] ?>" class="btn">Edit</a>
                        <a href="index.php?page=lokasi&hapus=<?= $row['id_lokasi'] ?>" class="btn gray" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
