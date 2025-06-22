<?php
include 'koneksi.php';

// Tambah Barang
if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_lokasi   = $_POST['id_lokasi'];
    $kode_barang = $_POST['kode_barang'];
    $kondisi     = $_POST['kondisi'];
    $jumlah      = $_POST['jumlah'];
    mysqli_query($conn, "INSERT INTO barang(nama_barang,id_kategori,id_lokasi,kode_barang,kondisi,jumlah) 
                VALUES ('$nama_barang','$id_kategori','$id_lokasi','$kode_barang','$kondisi','$jumlah')");
    header('Location: index.php?page=barang');exit;
}

// Update Barang
if (isset($_POST['update'])) {
    $id_barang   = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_lokasi   = $_POST['id_lokasi'];
    $kode_barang = $_POST['kode_barang'];
    $kondisi     = $_POST['kondisi'];
    $jumlah      = $_POST['jumlah'];
    mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$nama_barang',
        id_kategori='$id_kategori',
        id_lokasi='$id_lokasi',
        kode_barang='$kode_barang',
        kondisi='$kondisi',
        jumlah='$jumlah'
        WHERE id_barang='$id_barang'");
    header('Location: index.php?page=barang');exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $id_barang = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id_barang'");
    header('Location: index.php?page=barang');exit;
}

// Ambil untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id_barang = $_GET['edit'];
    $editData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id_barang'"));
}

// Ambil data list
$barang = mysqli_query($conn, "SELECT b.*, k.nama_kategori, l.nama_lokasi 
    FROM barang b 
    JOIN kategori k USING(id_kategori) 
    JOIN lokasi l USING(id_lokasi)");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$lokasi = mysqli_query($conn, "SELECT * FROM lokasi");
?>

<h1 class="header-title">Manajemen Barang</h1>

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
        margin-right: 5px;
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
    <!-- Form -->
    <div class="form-box">
        <form method="post">
            <input type="hidden" name="id_barang" value="<?= $editData['id_barang'] ?? '' ?>">
            <label>Nama Barang</label>
            <input class="input" name="nama_barang" value="<?= $editData['nama_barang'] ?? '' ?>" required>

            <label>Kategori</label>
            <select class="input" name="id_kategori" required>
                <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
                    <option value="<?= $k['id_kategori'] ?>" <?= $editData && $editData['id_kategori']==$k['id_kategori']?'selected':'' ?>><?= $k['nama_kategori'] ?></option>
                <?php } ?>
            </select>

            <label>Lokasi</label>
            <select class="input" name="id_lokasi" required>
                <?php while ($l = mysqli_fetch_assoc($lokasi)) { ?>
                    <option value="<?= $l['id_lokasi'] ?>" <?= $editData && $editData['id_lokasi']==$l['id_lokasi']?'selected':'' ?>><?= $l['nama_lokasi'] ?></option>
                <?php } ?>
            </select>

            <label>Kode Barang</label>
            <input class="input" name="kode_barang" value="<?= $editData['kode_barang'] ?? '' ?>" required>

            <label>Kondisi</label>
            <select class="input" name="kondisi" required>
                <option value="Baik" <?= $editData && $editData['kondisi']=='Baik'?'selected':'' ?>>Baik</option>
                <option value="Rusak Ringan" <?= $editData && $editData['kondisi']=='Rusak Ringan'?'selected':'' ?>>Rusak Ringan</option>
                <option value="Rusak Berat" <?= $editData && $editData['kondisi']=='Rusak Berat'?'selected':'' ?>>Rusak Berat</option>
            </select>

            <label>Jumlah</label>
            <input class="input" type="number" name="jumlah" value="<?= $editData['jumlah'] ?? '1' ?>" required>

            <button type="submit" name="<?= $editData?'update':'simpan' ?>" class="btn"><?= $editData?'Update':'Simpan' ?></button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Nama</th><th>Kategori</th><th>Lokasi</th><th>Kode</th><th>Kondisi</th><th>Jumlah</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($barang)) { ?>
                <tr>
                    <td><?= $row['id_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['nama_kategori'] ?></td>
                    <td><?= $row['nama_lokasi'] ?></td>
                    <td><?= $row['kode_barang'] ?></td>
                    <td><?= $row['kondisi'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>
                        <a href="index.php?page=barang&edit=<?= $row['id_barang'] ?>" class="btn">Edit</a>
                        <a href="index.php?page=barang&hapus=<?= $row['id_barang'] ?>" class="btn gray" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
