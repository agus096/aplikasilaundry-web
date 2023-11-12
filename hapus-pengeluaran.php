<?php
session_start();

include 'koneksi.php' ;
$id = $_GET['id'];
$kategori = $_GET['kategori'];

//hapus data pengeluran berdarakan id
$to_pengeluaran = mysqli_query($kon, "DELETE FROM pengeluaran WHERE id='$id'");

$_SESSION["sukses"] = "Data berhasil di hapus!";

header('Location: pengeluaran');   

?>