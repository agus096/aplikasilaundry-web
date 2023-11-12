<!DOCTYPE html>
<html lang="en">

<?php
session_start();

require 'koneksi.php';
require 'function.php';
require 'query-config-umum.php';

//jika tipe kosong kembalikan ke index
if (!isset($_GET['tipe'])) {
    header("Location: 404"); 
    die();  
}

//STEP 1 tangkap isi dari URL dan lakukan sanitasi
$tipe = mysqli_real_escape_string($kon, $_GET['tipe'] );
$id_inv = mysqli_real_escape_string($kon, $_GET['id_inv'] );

//ambil data invoice
$invoice = mysqli_query($kon, "SELECT * FROM invoice where id_inv = '$id_inv' ");
$data_invoice = mysqli_fetch_array($invoice);
$j_invoice = mysqli_num_rows($invoice);

//STEP 2 data yang sudah di sanitasi akan dicari jumlah data nya. jika data invoice tidak ada arahkan ke 404
if ($j_invoice == 0) {
    header("Location: 404");
    die();
 }

// mengintip data transaksi
$transaksi = mysqli_query($kon,"SELECT * FROM transaksi WHERE id_inv = '$id_inv' ");                               
// menghitung jumlah transaksi
$j_transaksi = mysqli_num_rows($transaksi);

?>

<?php include 'assets/html/head.php'; ?>

    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

        <!-- Begin page -->
        <div id="wrapper">

            <?php include 'assets/html/topbar.php' ?>
            <?php include 'assets/html/sidebar.php' ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="containter-fluid">

                    <!-- start page title -->
                       <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">Detail <?= $id_inv ?> </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-8">
                                <div class="card" >
                                <div class="card-body">


                                <div class="row">
                                    <div class="col-lg-6">
                                        <table>
                                        <tbody>
                                        <tr>
                                            <td>ID invoice:</td>
                                            <td><?= $id_inv ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal:</td>
                                            <td><?= $data_invoice['datefull'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cust:</td>
                                            <td><?= $data_invoice['nama'] ?> / <?= '0'.$data_invoice['whatsapp'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cashier:</td>
                                            <td><?= $data_invoice['cashier'] ?></td>
                                        </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <table class="table">
                                <thead>
                                    <tr>
                                      <th>Service</th>
                                      <th>Qty</th>
                                      <th>Harga perUnit</th>
                                      <th>Sub total</th>
                                      <th></th>
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
                                        <td><?= $r_transaksi['service'];  ?></td>
                                            
                                        <!-- logika untuk notif-->
                                        <?php
                                            //ambil data di tabel notif kemudian pecah ambil angakanya      
                                            $notif =  explode(" ",$r_service['notif']);

                                            //Tanggal besok
                                            $up = $notif[0];
                                            $tgl_notif =date('Y-m-d', strtotime("+$up day", strtotime(date("Y-m-d"))));

                                            //jam selanjutnya
                                            $date = date_create("$r_transaksi[jam]");
                                            date_add($date, date_interval_create_from_date_string("$notif[0] hours"));
                                            $jam_notif = date_format($date, 'H:i');

                                            //tampilkan berdasarkan jam/hari
                                            if ( $notif[1] == 'Jam') {
                                                $hnotif = $jam_notif;
                                                $tgl_sort = date("Y-m-d");

                                            } else if ( $notif[1] == 'Hari') {
                                                $hnotif = $tgl_notif;
                                                $tgl_sort = $tgl_notif;
                                            } 
                                            
                                            //masukan waktu notif dan tanggal untuk sort ke hal.listdeadline. ke db transaksi jika tipe = next
                                            if ($tipe == 'next') {
                                                mysqli_query($kon,"UPDATE transaksi SET notif='$hnotif', tgl_sort='$tgl_sort' WHERE id='$r_transaksi[id]' ");
                                            }
                                        ?>

                                        <!-- logika untuk deadline-->
                                        <?php
                                        //ambil data di tabel deadline kemudian pecah ambil angakanya      
                                        $deadline =  explode(" ",$r_service['deadline']);

                                        //Tanggal besok
                                        $up = $deadline[0];
                                        $tgl_deadline =date('Y-m-d', strtotime("+$up day", strtotime(date("Y-m-d"))));

                                        //jam selanjutnya
                                        $date = date_create("$r_transaksi[jam]");
                                        date_add($date, date_interval_create_from_date_string("$deadline[0] hours"));
                                        $jam_deadline = date_format($date, 'H:i');

                                        //tampilkan berdasarkan jam/hari
                                        if ( $deadline[1] == 'Jam') {
                                        $hdeadline = $jam_deadline;
                                        $tgl_sort = date("Y-m-d");

                                        } else if ( $deadline[1] == 'Hari') {
                                        $hdeadline = $tgl_deadline;
                                        $tgl_sort = $tgl_deadline;
                                        } 

                                        //masukan waktu deadline dan tanggal untuk sort ke hal.listdeadline. ke db transaksi jika tipe = next
                                        if ($tipe == 'next') {
                                        mysqli_query($kon,"UPDATE transaksi SET deadline='$hdeadline' WHERE id='$r_transaksi[id]' ");
                                        }
                                        ?>

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
                                        <td>
                                           <?php 
                                            if ($j_transaksi > '1') {
                                                echo "<a href='delete?id=$id?&id_inv=$id_inv' data-toggle='tooltip' title='Klik untuk hapus'><i class='fas fa-times text-danger'></i></a> ";
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
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <!-- membuat button dengan struktur flex-->
                            <div class="col-lg-8 d-flex">

                                <?php 
                                    if($tipe == 'next'){
                                    echo "
                                         <div class='p-2'>
                                           <a href='hapus-inv-trx?id_inv=$id_inv&tipe=batal' class='btn btn-danger'> <i class='fas fa-ban'></i> Batal </a>
                                        </div> 
                                           ";
                                    }
                                ?> 

                               <div class="dropdown p-2" style="display: inline;">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='fas fa-print'></i> Print
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" target="_blank" href="print-sm?id_inv=<?=$id_inv?>&tipe=next">Kecil</a></li>
                                        <li><a class="dropdown-item" target="_blank" href="#">Besar</a></li>
                                    </ul>
                                </div>

                                <?php 
                                    if($tipe == 'next' && $data_invoice['payment'] == 'Belum')
                                    { ?>

                                    <div class="ms-auto p-2"> <a href="bayar?id_inv=<?= $id_inv ?>&tipe=next" class="btn btn-success"><i class="fa fa-solid fa-money-bill-wave"></i> Langsung bayar</a> </div>  
                                  
                                <?php } ?>
                                  
                            </div>
                        </div> 

                    </div>
                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Mylaundry UBold theme by <a href="#">Coderthemes</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>

            <!-- END wrapper -->

            <!-- semua js di footer.js-->                                             
            <?php include 'assets/html/footerjs.php' ?>

            <!-- alert jika invoice berhasil di bayar-->
            <?php if(@$_SESSION['sukses']){ ?>
                <script>
                    swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
                </script>
            <!-- menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
            <?php unset($_SESSION['sukses']); } ?>

        </body>
    </html>
