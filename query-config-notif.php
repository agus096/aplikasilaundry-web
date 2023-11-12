<?php

$email_penerima= mysqli_query($kon, "SELECT val FROM config_notifikasi WHERE config='email_penerima'");
$d_email_penerima = mysqli_fetch_array($email_penerima);

$email_pengirim= mysqli_query($kon, "SELECT val FROM config_notifikasi WHERE config='email_pengirim'");
$d_email_pengirim = mysqli_fetch_array($email_pengirim);

$password= mysqli_query($kon, "SELECT val FROM config_notifikasi WHERE config='password'");
$d_password = mysqli_fetch_array($password);