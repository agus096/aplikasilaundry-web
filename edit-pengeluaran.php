<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$id = $_POST['id'];
$tanggal = explode("-",$_POST['tanggal']);
$datefull = implode("-",$tanggal);
$tujuan = ucfirst($_POST['tujuan']);
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];

// update data berdasarkan id yg dikirimkan
$query = mysqli_query($kon,"UPDATE pengeluaran SET datefull = '$datefull', tahun = '$tanggal[0]', bulan='$tanggal[1]', tanggal='$tanggal[2]',  tujuan = '$tujuan', kategori = '$kategori', harga = '$harga', keterangan = '$keterangan'  WHERE id = '$id' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Data berhasil di ubah";
    
//redirect ke halaman pengeluaran
header('Location: pengeluaran');   
 
?>