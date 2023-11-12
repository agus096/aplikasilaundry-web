<?php
session_start();
require 'koneksi.php';

$kategori = ucfirst($_POST['kategori']);

// mengintip data kategori
$cek_kategori = mysqli_query($kon,"SELECT * FROM kategori_pengeluaran WHERE kategori = '$kategori' ");                               
// menghitung jumlah kategori
$j_kategori = mysqli_num_rows($cek_kategori); 

if ($j_kategori < 1 ) {
    // update data berdasarkan kategori yg dikirimkan
    mysqli_query($kon,"INSERT into kategori_pengeluaran values('','$kategori') ");
    $_SESSION["sukses"] = "$kategori berhasil ditambah!";
} else {
    //set session sukses untuk sweet alert
    $_SESSION["gagal"] = "$kategori sudah ada!";
}

    
//redirect ke halaman kat pengeluaran
header('Location: kategori-pengeluaran');   
