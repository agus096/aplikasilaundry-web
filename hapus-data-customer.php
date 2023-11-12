<?php
session_start();

include 'koneksi.php' ;
$id = $_GET['id'];

mysqli_query($kon, "DELETE FROM customer WHERE id='$id'");

$_SESSION["sukses"] = "Customer berhasil di hapus!";

header('Location: config-customer');   

?>