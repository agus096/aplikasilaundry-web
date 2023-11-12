<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data
$id = $_POST['id'];
$service = $_POST['service'];
$harga = $_POST['harga'];
$unit = $_POST['unit'];
$deadline = $_POST['angka'].' '.$_POST['jam/hari'];
$notif = $_POST['angka']-1 .' '.$_POST['jam/hari'];

// update data berdasarkan id yg dikirimkan
$query = mysqli_query($kon,"UPDATE service SET service = '$service', harga = '$harga', unit = '$unit', notif= '$notif', deadline = '$deadline' WHERE id = '$id' ");

//set session sukses untuk sweet alert
$_SESSION["sukses"] = "Data berhasil di ubah";
    
//redirect ke halaman service php
header('Location: config-service');   
 
?>