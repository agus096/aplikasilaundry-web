<?php
require 'koneksi.php';
require 'class.php';

$queryIntrvl = mysqli_query($kon, "SELECT * FROM waktu_mutasi");
$dataIntrvl = mysqli_fetch_array($queryIntrvl);
$now    = date('d/m/Y');
$start  = date('d/m/Y', strtotime("-$dataIntrvl[waktu_mutasi] day", strtotime(date("Y/m/d"))));

$queryBca = mysqli_query($kon, "SELECT * FROM bca");
$dataBca = mysqli_fetch_array($queryBca);
$cookie = cookie();
$login = login($dataBca['username'], $dataBca['password']);
$saldo = saldo();
$mutasi = mutasi($start, $now);
$logout = logout();

?>

<!-- script cek mutasi telah saya modifikasi pembuat aslinya IrfanMaulana00-->
<!--https://github.com/IrfanMaulana00/mutasi-bca/blob/main/run.php-->
