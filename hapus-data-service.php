<?php
session_start();

include 'koneksi.php' ;
$service = $_GET['service'];

mysqli_query($kon, "DELETE FROM service WHERE service='$service'");

$_SESSION["sukses"] = "Service $service berhasil di hapus!";

header('Location: config-service');   

?>