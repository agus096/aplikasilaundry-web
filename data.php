<?php

   require 'koneksi.php';
    
    //menghitung jumlah pesan dari tabel pesan
    $query= mysqli_query($kon, "Select Count(id) as jumlah From transaksi WHERE status ='Proses'");
    
    //menampilkan data
    $hasil = mysqli_fetch_array($query);
    
    //membuat data json
    echo json_encode(array('jumlah' => $hasil['jumlah']));
    
    ?>