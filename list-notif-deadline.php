<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
require 'koneksi.php';

$now = date("Y-m-d");

//tangkap input form dari pemiihan tahun untuk chart
if(isset($_POST['seltahun'])){
     //jika ada
     $seltahun = $_POST['seltahun']; 
    }else{
     //jika kosong 
     $seltahun = date("Y");
    }
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
                                    <h4 class="page-title">Notifikasi Deadline</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body pb-2">
                                            <div class="mb-2">
                                            <div class="alert bg-light" style="padding-bottom:0px;">
                                                <ul>
                                                    <li>
                                                        Deadline Perjam adalah deadline dari service express yang di janjikan selesai hanya hitungan jam
                                                    </li>
                                                    <li>
                                                        Deadline Perhari adalah deadline dari service reguler yang di janjikan selesai dalam hitungan hari
                                                    </li>
                                                </ul>
                                            </div>
                                                <div class="row row-cols-sm-auto g-2 align-items-center">
                                                    <div class="col-12 text-sm-center">
                                                        <select id="demo-foo-filter-status" class="form-select form-select-sm">
                                                            <option value="">Show all</option>
                                                            <option value="Jam">Deadline Perjam</option>
                                                            <option value="Hari">Deadline Perhari</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                            <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                              <thead>
                                                <tr>
                                                  <th> </th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php 
                                                    $list = mysqli_query($kon,"SELECT * FROM transaksi WHERE tgl_sort = '$now' ORDER by id DESC ");
                                                    while ($data = mysqli_fetch_array($list))
                                                    {
                                                ?>
                                                <tr>
                                                    <td>
                                                    <?php
                                                        if($data['notif'] == $data['tgl_sort']) {
                                                            echo '<i class="fas fa-calendar-alt"></i>';
                                                            } else {
                                                            echo '<i class="far fa-clock"></i>';
                                                            }
                                                        ?>
                                                        Deadline service <b><?= $data['service'] ?></b> di invoice <a href="detail?id_inv=<?= $data['id_inv'] ?>&tipe=detail&nama=<?= $data['nama'] ?>"><?= $data['id_inv'] ?></a> segera tiba pada <b><?= $data['deadline'] ?></b> pastikan service sudah on proses..
                                                        <br>
                                                        <br>
                                                        <small>
                                                        <?php
                                                            if($data['notif'] == $data['tgl_sort']) {
                                                                echo 'Deadline perHari';
                                                            } else {
                                                                echo 'Deadline perJam <i class="fas fa-bolt text-warning"></i>';
                                                            }
                                                            ?>
                                                        </small>
                                                    </td>
                                                </tr>
                                                <?php  } ?>
                                              </tbody>
                                              <tfoot>
                                                <tr class="active">
                                                    <td colspan="5">
                                                        <div class="text-end">
                                                            <ul class="pagination pagination-rounded justify-content-end footable-pagination mb-0"></ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                             </tfoot>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                        </div><!-- end row -->
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

         <!-- pengurutan js ulang untuk wizard bekerja-->
         <script src="assets/js/vendor.min.js"></script>
         

        <!--pengurutan js ulang Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- pengurutan js ulang Footable Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        
        <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
        <?php if(@$_SESSION['sukses']){ ?>
            <script>
                swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
            </script>
        <!-- menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']); } ?>
        </body>
        
        </html>
    
        
    </body>
