<?php
$merek = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='merek'");
$d_merek = mysqli_fetch_array($merek);

$font = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='font'");
$d_font = mysqli_fetch_array($font);

$fontsize = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='fontsize' ");
$d_fontsize = mysqli_fetch_array($fontsize);

$maxinput = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='maxinput'");
$d_maxinput = mysqli_fetch_array($maxinput);

$merek = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='merek'");
$d_merek = mysqli_fetch_array($merek);

$pesan = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='pesan'");
$d_pesan = mysqli_fetch_array($pesan);

$footer = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='footer'");
$d_footer = mysqli_fetch_array($footer);

$alamat = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='alamat'");
$d_alamat = mysqli_fetch_array($alamat);

$kontak = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='kontak'");
$d_kontak = mysqli_fetch_array($kontak);

$tanggal = mysqli_query($kon, "SELECT val FROM config_umum WHERE config='tanggal'");
$d_tanggal = mysqli_fetch_array($tanggal);
