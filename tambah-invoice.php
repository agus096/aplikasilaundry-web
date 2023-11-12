<?php 

// kon database
include 'koneksi.php';

// mengambil data invoice dengan kode paling besar
$query = mysqli_query($kon, "SELECT max(id_inv) as kodeTerbesar FROM invoice");
$data = mysqli_fetch_array($query);
$no_invoice = $data['kodeTerbesar'];
 
// mengambil angka dari kode invoice terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($no_invoice, 3, 3);
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
 
// membentuk kode invoice baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya inv
$huruf = "INV";
$no_invoice = $huruf . sprintf("%03s", $urutan);

// menangkap data yang di kirim dari form
$tanggal = explode("-",$_POST['tanggal']) ;
$datefull = implode("-",$tanggal);
$jam = $_POST['jam'];
$service = $_POST['service'];
$berat = $_POST['berat'];
$whatsapp = $_POST['whatsapp'];
$nama = ucfirst($_POST['nama']);
$cashier = $_POST['cashier'];


// mengintip data customer
$customer = mysqli_query($kon,"SELECT * FROM customer WHERE whatsapp = '$whatsapp' ");                               
// menghitung jumlah transaksi
$j_customer = mysqli_num_rows($customer);

// jika belum pernah terinput masukan customer ke database (berdasarkan wa)
if ($j_customer < 1){
   mysqli_query($kon,"INSERT into customer values('','$nama','$whatsapp ') ");
}

// input ke transaksi
for($x=0; $x<count($service); $x++){
	if($service[$x] != ""){
 
    $h = mysqli_query($kon,"select harga from service WHERE service ='$service[$x]' ");
    $harga = mysqli_fetch_array($h);

    //hitung harga * berat
    $subtotal = $harga['harga'] * $berat[$x];
	$to_trx = mysqli_query($kon,"insert into transaksi values('','$datefull','$jam','$tanggal[0]','$tanggal[1]','$tanggal[2]','$no_invoice','$service[$x]','$berat[$x]','$subtotal','$nama',' ',' ',' ','Proses')");
	}
}

// input ke invoice
$to_inv = mysqli_query($kon,"insert into invoice values('','$datefull','$tanggal[0]','$tanggal[1]','$tanggal[2]','$no_invoice','$nama','$whatsapp','Proses','Belum','$cashier')");

//input ke tahunchart
$to_thn_chart = mysqli_query($kon,"insert into tahunchart values('','$tanggal[0]') ");

if( !$to_trx){
    die ("Gagal input : ".mysqli_errno($kon).
       " - ".mysqli_error($kon));
    } else {
        
    //redirect ke halaman index.php
    header("Location: detail?id_inv=$no_invoice&tipe=next&nama=$nama");   
    }

?>