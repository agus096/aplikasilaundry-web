<?php
    // melakukan koneksi 
    require 'koneksi.php';
    date_default_timezone_set('Asia/Jakarta');
    
    $tgl = date('Y-m-d');
    $jam = date('H:i');

    //mengambil data 5 pesan terbaru 
    $sql = mysqli_query($kon, "SELECT * FROM transaksi WHERE status ='Proses' AND notif IN ('$jam','$tgl')  ORDER BY id DESC limit 1 ");
    $result = array();
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(array("result" => $data));
?>