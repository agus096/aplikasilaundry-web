<!DOCTYPE html>
<html lang="en" >

<?php
session_start();
error_reporting(0);
require 'koneksi.php';
require 'function.php';
require 'query-config-umum.php';

$tipe = mysqli_real_escape_string($kon,$_GET['tipe']);
$id_inv = mysqli_real_escape_string($kon,$_GET['id_inv']);

//ambil data invoice
$invoice = mysqli_query($kon, "SELECT * FROM invoice where id_inv = '$id_inv' ");
$data_invoice = mysqli_fetch_array($invoice);
$j_inv = mysqli_num_rows($invoice);

// jika id_inv tidak ada direct ke 404 & akhiri script
if ($j_inv == 0) {
   header("Location: 404");
   die();
}

// mengintip data transaksi
$transaksi = mysqli_query($kon,"SELECT * FROM transaksi WHERE id_inv = '$id_inv' ");                               
// menghitung jumlah transaksi
$j_transaksi = mysqli_num_rows($transaksi);

?>

<?php include 'assets/html/head.php'; ?>

<head>
    <style>
        body {
        background: gray;
        }

        .StyledReceipt {
        background-color: #fff;
        width: 22rem;
        position: relative;
        padding: 1rem;
        box-shadow: 0 -0.4rem 1rem -0.4rem rgba(0, 0, 0, 0.2);
        }

        .StyledReceipt::after {
        background-image: linear-gradient(135deg, #fff 0.5rem, transparent 0),
        linear-gradient(-135deg, #fff 0.5rem, transparent 0);
        background-position: left-bottom;
        background-repeat: repeat-x;
        background-size: 1rem;
        content: '';
        display: block;
        position: absolute;
        bottom: -1rem;
        left: 0;
        width: 100%;
        height: 1rem;
        }
    </style>
</head>

<body>
  <div class="StyledReceipt">
    <div class="row">
        <div class="col-lg-12">
            <center><span class="<?= $d_font['val'] ?>" style="font-size:<?= $d_fontsize['val'] ?>px;"><?= $d_merek['val'] ?></span></center>
        </div>
    </div>
    ==========================================
    <div class="row">
        <div class="col-lg-12">
            <table>
            <tbody>
            <tr>
                <td><?= $id_inv ?></td>
            </tr>
            <tr>
                <td><?= $data_invoice['datefull'] ?></td>
            </tr>
            <tr>
                <td><?= $data_invoice['nama'] ?> / <?= '0'.$data_invoice['whatsapp'] ?></td>
            </tr>
            <tr>
                <td><?= $data_invoice['cashier'] ?> (Cashier)</td>
            </tr>
            </tbody>
            </table>
        </div>
    </div>
    ==========================================
    <table class="table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Qty</th>
                <th>Harga perUnit</th>
                <th>Sub total</th>
            </tr>
        </thead>
        <tbody>
            
        <!--tampilkan data transaksi berdasarkan id invoice-->
        <?php
        $l_transaksi = mysqli_query($kon,"select * from transaksi WHERE id_inv ='$id_inv' ");
        while ($r_transaksi = mysqli_fetch_array($l_transaksi))
        {
        ?>

        <!--tampilkan harga perKG/pcs berdasarkan service-->
        <?php
        $l_service = mysqli_query($kon,"select * from service WHERE service ='$r_transaksi[service]' ");
        while ($r_service = mysqli_fetch_array($l_service))
        {
        ?>

        <!-- buat variablle array untuk sum -->
        <?php
        $total_ary[] = $r_transaksi['harga']; 
        $total       = array_sum($total_ary); 
        $id          = $r_transaksi['id'];
        ?>

            <tr>
                <td> 
                    <?= $r_transaksi['service'];  ?>
                </td>

                <td>
                    <?php 
                    if ($r_transaksi['berat'] == ''){
                        echo "Belum di input";
                    } else {
                        echo $r_transaksi['berat'] . $r_service['unit'] ;
                    }
                    ?>
                </td>
                <td><?= rupiah($r_service['harga']) ?></td>
                <td>
                    <?php 
                    if (rupiah($r_transaksi['harga']) == '0,00'){
                        echo "Tak bisa di hitung";
                    } else {
                        echo rupiah($r_transaksi['harga']);
                    }
                    ?>
                </td>
            </tr>

            <?php } ?>
            <?php } ?>
        </tbody>
        </table>
        <div class="row mb-3" style="border:1px solid #979b9f;">
            <div class="col-lg-6">
                <h5>Total :</h5>
            </div>
            <div class="col-lg-6">
                <h5 style="text-align:right;">Rp. <?= rupiah($total) ?></h5>
            </div>
        </div>
        ==========================================
        <div class="row">
            <center><span><?= $d_footer['val'] ?></span></center>
            <center><span><?= $d_alamat['val'] ?></span></center>
            <center><small><?= $d_kontak['val'] ?></small></center>
        </div>
    </div>
   
</body>

<br>
<br>
<br>
<br>
<br>


