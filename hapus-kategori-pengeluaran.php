<?php 
session_start();
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($kon,"DELETE FROM kategori_pengeluaran WHERE id= '$id' ");

$_SESSION["sukses"] = "Kategori berhasil di hapus!";

header('Location: kategori-pengeluaran');   