<?php

//set session start untuk sweet alert
session_start();

//kon ke database
require 'koneksi.php';

//mengambil data dari name
$val = $_POST['val'];
  
// looping array & input berdasarkan id yang di loop
//id di database pun harus mulai dari 0
for($x=0; $x < count($val); $x++){
    
	if($val[$x] != ""){

    mysqli_query($kon,"UPDATE config_umum SET val = '$val[$x]' WHERE id = $x ");

   
	}
}

//set session sukses untuk sweet alert
$_SESSION["sukses"] = 'Data Berhasil Di Edit';
    
//redirect ke halaman config-umum
header('Location: config-umum');   
     

 
?>