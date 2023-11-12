<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';
require 'bca.php';

//mengambil data
$username = $_POST['username'];
$password = $_POST['password'];

// update data berdasarkan id yg dikirimkan
$query = mysqli_query($kon,"UPDATE bca SET username = '$username', password = '$password' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Data KlikBca berhasil di ubah!";
    
//redirect ke halaman config bca
header('Location: config-bca');   
 
?>