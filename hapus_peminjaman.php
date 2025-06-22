<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");
echo "<script>location='peminjaman.php';</script>";
?>