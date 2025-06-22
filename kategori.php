<?php
include 'koneksi.php';

// Simpan
if (isset($_POST['simpan'])) {
    $nama_kategori = $_POST['nama_kategori'];
    mysqli_query($conn, "INSERT INTO kategori(nama_kategori) VALUES('$nama_kategori')");
    header('Location: index.php?page=kategori');exit;
}
// Update
if (isset($_POST['update'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
    header('Location: index.php?page=kategori');exit;
}
// Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$id'");
    header('Location: index.php?page=kategori');exit;
}
// Edit
$editData=null;
if (isset($_GET['edit'])) {
    $id=$_GET['edit'];
    $editData=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id'"));
}
// Ambil semua
$data=mysqli_query($conn, "SELECT * FROM kategori");
?>

<h1 class="header-title">Manajemen Kategori</h1>

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
    .form-box, .table-box {
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .form-box { flex:1; max-width: 400px; }
    .table-box { flex:2; overflow-x: auto; }
    label { font-weight: 600; font-size: 14px; }
    .input {
        width: 100%; padding: 10px; font-size: 14px;
        margin-top: 5px; margin-bottom: 16px;
        border: 1px solid #cbd5e1; border-radius: 6px;
    }
    .btn {
        background: #3b82f6; color: white; padding: 10px 16px;
        border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none;
    }
    .btn.gray { background: #e2e8f0; color: #1e293b; }
    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    table th, table td { border: 1px solid #e2e8f0; padding: 10px; text-align: left; }
    table thead { background-color: #f8fafc; }
</style>

<div class="flex-container">
    <div class="form-box">
        <form method="post">
            <input type="hidden" name="id_kategori" value="<?= $editData['id_kategori']??'' ?>">
            <label>Nama Kategori</label>
            <input class="input" name="nama_kategori" value="<?= $editData['nama_kategori']??'' ?>" required>
            <button type="submit" name="<?= $editData?'update':'simpan' ?>" class="btn"><?= $editData?'Update':'Simpan' ?></button>
        </form>
    </div>

    <div class="table-box">
        <table>
            <thead><tr><th>ID</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while ($row=mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['id_kategori'] ?></td>
                    <td><?= $row['nama_kategori'] ?></td>
                    <td>
                        <a href="index.php?page=kategori&edit=<?= $row['id_kategori'] ?>" class="btn">Edit</a>
                        <a href="index.php?page=kategori&hapus=<?= $row['id_kategori'] ?>" class="btn gray" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
