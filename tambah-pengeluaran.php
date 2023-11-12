<?php
session_start();
require 'koneksi.php';

$tanggal = explode("-",$_POST['tanggal']);
$datefull = implode("-",$tanggal);
$tujuan = ucfirst($_POST['tujuan']);
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$cashier = $_POST['cashier'];

$to_pengeluaran = mysqli_query($kon,"INSERT into pengeluaran values('','$datefull','$tanggal[0]','$tanggal[1]','$tanggal[2]','$tujuan','$kategori','$harga','$keterangan','$cashier') ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Pengeluaran Berhasil Di input!";
    
//redirect ke halaman pengeluaran
header('Location: pengeluaran');   