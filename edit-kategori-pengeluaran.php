<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$id = $_POST['id'];
$kategori = ucfirst($_POST['kategori']);

// update data berdasarkan id yg dikirimkan
mysqli_query($kon,"UPDATE kategori_pengeluaran SET kategori = '$kategori' WHERE id = '$id' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = 'Kategori Berhasil Di Edit!';
    
//redirect ke halaman kat pengeluaran
header('Location: kategori-pengeluaran');   
 
?>