<?php

require 'koneksi.php';

//variabel whatsapp yang dikirimkan dari form
$whatsapp = $_GET['whatsapp'];

//mengambil data
$query = mysqli_query($kon, "SELECT * from customer WHERE whatsapp ='$whatsapp'");
$tampilkan  = mysqli_fetch_array($query);
$data = array(
            'nama' =>  @$tampilkan['nama']
        );

//tampil data
echo json_encode($data);
?>