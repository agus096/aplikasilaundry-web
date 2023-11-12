<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];
$id_inv = $_GET['id_inv'];
mysqli_query($kon, "DELETE FROM transaksi WHERE id= '$id' ") ;


header("Location: detail?id_inv=$id_inv&tipe=next");   
 
?>