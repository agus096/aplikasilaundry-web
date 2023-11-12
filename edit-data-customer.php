<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$id = $_POST['id'];
$nama = ucfirst($_POST['nama']);
$whatsapp = $_POST['whatsapp'];

// update data berdasarkan id yg dikirimkan
mysqli_query($kon,"UPDATE customer SET nama = '$nama', whatsapp = '$whatsapp' WHERE id = '$id' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Data berhasil di ubah!";
    
//redirect ke halaman customer php
header('Location: config-customer');   
 
?>