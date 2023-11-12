<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$id_inv = $_GET['id_inv'];
$tipe = $_GET['tipe'];

// update data berdasarkan id_inv yg dikirimkan
$query = mysqli_query($kon,"UPDATE invoice SET payment = 'Dibayar' WHERE id_inv = '$id_inv' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Invoice dibayar langsung!";
    
//redirect ke halaman config bca
header("Location: detail?id_inv=$id_inv&tipe=next");   
 
?>