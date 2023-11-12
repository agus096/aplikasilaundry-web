<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$waktu_mutasi = $_POST['waktu_mutasi'];

// update data berdasarkan id yg dikirimkan
$query = mysqli_query($kon,"UPDATE waktu_mutasi SET waktu_mutasi = '$waktu_mutasi' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = 'Interval mutasi Berhasil Di Edit!';
    
//redirect ke halaman index.php
header('Location: config-bca');   
 
?>