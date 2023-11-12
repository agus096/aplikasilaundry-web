<?php
session_start();
require 'koneksi.php';

$service = $_POST['service'];
$harga = $_POST['harga'];
$unit = $_POST['unit'];
$deadline = $_POST['angka'].' '.$_POST['jam/hari'];
$notif = $_POST['angka']-1 .' '.$_POST['jam/hari'];

// mengintip data service
$serv = mysqli_query($kon,"SELECT * FROM service WHERE service = '$service' ");                               
// menghitung jumlah service
$j_serv = mysqli_num_rows($serv); 

if ($j_serv < 1 ) {
    // tambah data berdasarkan id yg dikirimkan
    mysqli_query($kon,"INSERT into service values('','$service', '$harga','$unit','$notif','$deadline') ");
    $_SESSION["sukses"] = "$service berhasil ditambah!";
} else {
    //set session sukses untuk sweet alert
    $_SESSION["gagal"] = "$service sudah ada!";
}

//redirect ke halaman config serv
header('Location: config-service');   