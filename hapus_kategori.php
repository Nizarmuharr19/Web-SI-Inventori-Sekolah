<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$id'");
echo "<script>location='kategori.php';</script>";
?>