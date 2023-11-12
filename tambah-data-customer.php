<?php
session_start();
require 'koneksi.php';

$nama =  ucfirst($_POST['nama']);
$whatsapp = $_POST['whatsapp'];

// mengintip data wa
$wa = mysqli_query($kon,"SELECT * FROM customer WHERE whatsapp = '$whatsapp' ");                               
// menghitung jumlah wa
$j_wa = mysqli_num_rows($wa); 

if ($j_wa < 1 ) {
    // tambah data berdasarkan id yg dikirimkan
    mysqli_query($kon,"INSERT into customer values('','$nama', '$whatsapp') ");
    $_SESSION["sukses"] = "$nama berhasil ditambah!";
} else {
    //set session sukses untuk sweet alert
    $_SESSION["gagal"] = "No whatsapp sudah ada!";
}

    
//redirect ke halaman config cust
header('Location: config-customer');   
