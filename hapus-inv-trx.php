<?php
session_start();

include 'koneksi.php' ;

$id_inv = mysqli_real_escape_string($kon,$_GET['id_inv']);
$tipe = mysqli_real_escape_string($kon,$_GET['tipe']);
$nama = mysqli_real_escape_string($kon,$_GET['nama']);

$delete_invoice = mysqli_query($kon, "DELETE FROM invoice WHERE id_inv='$id_inv'");
$delete_transaksi = mysqli_query($kon, "DELETE FROM transaksi WHERE id_inv='$id_inv'");

if($tipe == 'batal') {
   $_SESSION["sukses"] = "Transaksi $nama Berhasil Dibatalkan!";
} else {
   $_SESSION["sukses"] = "$id_inv Berhasil Dihapus!";
}

header('Location: index');   

?>