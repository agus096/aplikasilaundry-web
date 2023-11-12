<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';
require 'query-config-umum.php';

//mengambil data
$id_inv = $_POST['id_inv'];
$tanggal = explode("-",$_POST['tanggal']);
$datefull = implode("-",$tanggal);
$whatsapp = $_POST['whatsapp'];
$nama = ucfirst($_POST['nama']);
$status = $_POST['status'];

// mengintip data customer
$customer = mysqli_query($kon,"SELECT * FROM customer WHERE whatsapp = '$whatsapp' ");                               
// menghitung jumlah transaksi
$j_customer = mysqli_num_rows($customer);

// jika belum pernah terinput masukan customer ke database (berdasarkan wa)
if ($j_customer < 1){
   mysqli_query($kon,"INSERT into customer values('','$nama','$whatsapp ') ");
}
  
// update data berdasarkan id yg dikirimkan
$edit_invoice = mysqli_query($kon,"UPDATE invoice SET nama = '$nama', whatsapp = '$whatsapp', status = '$status' WHERE id_inv = '$id_inv' ");

$edit_transaksi = mysqli_query($kon,"UPDATE transaksi SET nama = '$nama', status = '$status' WHERE id_inv = '$id_inv' ");
    

if ($status == 'Selesai'){
    $ubahpayment = mysqli_query($kon, "UPDATE invoice SET payment='Dibayar'");
    header("Location: index");
    $_SESSION["bukawa"] = "https://web.whatsapp.com/send/?phone=62$whatsapp&text=$d_pesan[val]";
    $_SESSION["sukses"] = "$id_inv Data Berhasil Di Edit . silahkan kirim notif wa!";


} else if ($status == 'Proses') {
    $ubahpayment = mysqli_query($kon, "UPDATE invoice SET payment='Belum'");
    header("Location: index");
    $_SESSION["sukses"] = "$id_inv Data Berhasil Di Edit!";
}

else {
    header("Location: index");
    $_SESSION["sukses"] = "$id_inv Data Berhasil Di Edit!";
}


?>