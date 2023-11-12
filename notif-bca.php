<?php
require 'koneksi.php';
require 'bca.php';
require 'query-config-notif.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php'; 
require 'PHPMailer/src/SMTP.php'; 
require 'PHPMailer/src/Exception.php';

//tampilkan list dari array mutasi terakhir masukan ke variable $end_mutasi
$end_mutasi = (end($mutasi));

$ket    =   $end_mutasi[1];
$tipe   =   $end_mutasi[2];
$jumlah =   $end_mutasi[3];

//masukan hasil extraksi array mutasi terakhir ke DB
mysqli_query($kon, "INSERT INTO mutasi_trigger values ('','$jumlah','$ket','$tipe','belum') ");

// mengintip data mutasi yg berstatus belum
$mbelum = mysqli_query($kon,"SELECT * FROM  mutasi_trigger WHERE status = 'belum' ");   

// menghitung jumlah row mutasi yg berstatus belum
$j_mbelum = mysqli_num_rows($mbelum);


if ($j_mbelum > 0){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = ($d_email_pengirim['val']);
    $mail->Password = ($d_password['val']);
    $mail->setFrom    ("$d_email_pengirim[val]", 'Notif BCA');    //pengirim
    $mail->addReplyTo ("$d_email_pengirim[val]", 'Notif BCA');
    $mail->AddAddress ($d_email_penerima['val']);  //email dan nama penerima
    $mail->Subject =  'Saldo anda sekarang Rp.'. $saldo['saldo'];
    $mail->isHTML(true);

    $mail->Body     	=       

                        "
                        <span>Transaksi terakhir pada rekening anda</span>
                        <br>
                        <br>
                         <table border='1'>
                            <thead>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </thead>
                            <tbody>
                                 <td>$tipe</td>
                                 <td>$jumlah</td>
                                 <td>$ket</td>
                            </tbody>
                         </table>
                         <br>
                         <span>Pastikan selalu setting Cronjob diatas 10menit agar akses ke BCA tidak bermasalah!</span> 
                        "; 


    if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
    echo "Message sent!";
    $query = mysqli_query($kon,"UPDATE mutasi_trigger SET status = 'sudah' ");
    if ($query) {
        echo 'Status di ubah ke sudah!';
    }
    }
}



