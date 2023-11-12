<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';
require 'bca.php';
require 'function.php';
require 'query-config-notif.php';
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
                            <div class="col-lg-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">Pengaturan BCA</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <?php 
                            if ( $saldo['saldo'] == '') {
                                
                            }
                                else {
                                        echo "
                                        
                                                <div class='row'>
                                                <div class='col-lg-3'>
                                                <div class='widget-rounded-circle card bg-pattern'>
                                                        <div class='card-body '>
                                                            <div class='row'>
                                                                <div class='col-4'>
                                                                        <img src='assets/images/bcacard.png' class='avatar-title'>
                                                                </div>
                                                                <div class='col-lg-8'>
                                                                    <div class='text-end'>
                                                                        <a href='#' class='text-dark mt-1' data-bs-toggle='modal' data-bs-target='#mutasi-modal'><h3 class='text-primary'> Rp. $saldo[saldo] </h3></a>
                                                                        <p class='text-muted mb-1 text-truncate'>Saldo BCA</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-lg-3'>
                                                <div class='widget-rounded-circle card'>
                                                        <div class='card-body bg-pattern'>
                                                            <div class='row'>
                                                                <div class='col-4'>
                                                                        <img src='assets/images/bcacard.png' class='avatar-title'>
                                                                </div>
                                                                <div class='col-lg-8'>
                                                                    <div class='text-end'>
                                                                        <h3>$saldo[norek]</h3>
                                                                        <p class='text-muted mb-1 text-truncate'>Norek BCA</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        " ;
                            }
                        ?>

                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                   <div class="card-body">
                                        <div id="basicwizard">
                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                                                <li class="nav-item">
                                                    <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" class="nav-link  rounded-0 pt-2 pb-2"> 
                                                        <i class="fas fa-user-circle"></i>
                                                        <span class="d-none d-sm-inline">Akun</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="fas fa-file-alt"></i>
                                                        <span class="d-none d-sm-inline">Mutasi</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="fas fa-envelope-open-text"></i>
                                                        <span class="d-none d-sm-inline">Notifikasi</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content b-0 mb-0 pt-0">
                                                <div class="tab-pane" id="basictab1">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <form class="needs-validation" action="edit-databca.php" method="POST" novalidate>
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" name="username" value="<?= $dataBca['username'] ?>"  class="form-control" id="username" required>
                                                                <div class="invalid-feedback">
                                                                Tolong masukan username klik BCA!
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input type="password" name="password" value="<?= $dataBca['password'] ?>"  class="form-control" id="password" required>
                                                                <div class="invalid-feedback">
                                                                    Tolong masukan password klik BCA!
                                                                </div>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="basictab2">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <form class="needs-validation" action="edit-waktu-mutasi.php" method="POST" novalidate>
                                                            <div class="mb-3">
                                                                <label for="waktu" class="form-label">Waktu mutasi (hari)</label>
                                                                <input type="text" name="waktu_mutasi" value="<?= $dataIntrvl['waktu_mutasi'] ?>" id="slidermutasi">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div> 
                                                    </div> 
                                                </div>

                                                <div class="tab-pane" id="basictab3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <form class="needs-validation" action="edit-config.notif.php" method="POST" novalidate>
                                                            <div class="mb-3">
                                                                <label for="emailpengirim" class="form-label">Email pengirim</label>
                                                                <input type="text" class="form-control" name="val[]" value="<?= $d_email_pengirim['val'] ?>" id="emailpengirim" required>
                                                                <div class="invalid-feedback">
                                                                    Tolong masukan email!
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="emailpenerima" class="form-label">Email penerima</label>
                                                                <input type="text" class="form-control" name="val[]" value="<?= $d_email_penerima['val'] ?>" id="emailpenerima" required>
                                                                <div class="invalid-feedback">
                                                                    Tolong masukan email!
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="passwordkhusus" class="form-label">Password khusus</label>
                                                                <input type="text" class="form-control" name="val[]" value="<?= $d_password['val'] ?>" id="passwordkhusus" required>
                                                                <div class="invalid-feedback">
                                                                    Tolong masukan password email!
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div> 
                                                    </div> 
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                              <div class="card card-body">
                              <div class="row">
                                 <h4 class="header-title mb-4"><i class="fas fa-life-ring"></i> Panduan</h4>
                                    <div class="col-sm-3">
                                        <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active show mb-1" id="akun" data-bs-toggle="pill" href="#v-pills-akun" role="tab" aria-controls="v-pills-akun"
                                                aria-selected="true">
                                                Akun
                                            </a>
                                            <a class="nav-link mb-1" id="mutasi" data-bs-toggle="pill" href="#v-pills-mutasi" role="tab" aria-controls="v-pills-mutasi"
                                                aria-selected="false">
                                                Mutasi
                                            </a>
                                            <a class="nav-link mb-1" id="notifikasi" data-bs-toggle="pill" href="#v-pills-notifikasi" role="tab" aria-controls="v-pills-notifikasi"
                                                aria-selected="false">
                                                Notifikasi
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="tab-content pt-0">
                                            <div class="tab-pane fade active show" id="v-pills-akun" role="tabpanel" aria-labelledby="akun">
                                                <p>
                                                    Masukan username & password akun KlikBCA bukan akun Mbanking, MobileBCA atau yang lain.
                                                    Silahkan buat akun KlikBCA terlebih dulu jika anda tidak mempunyai akun klikBCA
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-mutasi" role="tabpanel" aria-labelledby="mutasi">
                                                <p>
                                                    Anda bisa memilih range/interval mutasi mulai dari 1hari - 29hari sesuai kebutuhan anda
                                                    & untuk melihat list mutasi silahkan klik saldo anda
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-notifikasi" role="tabpanel" aria-labelledby="notifikasi">
                                                <p>
                                                   Pastikan Akun gmail yang anda gunakan untuk mengirim notifikasi sudah mempunyai akses
                                                   silahkan ikuti panduan berikut.
                                                   jika sudah memasukan email penerima,pengirim & password khusus nya silahkan save & jalankan cronjob 
                                                   file untuk cronjobnya adalah (notif-bca.php) setting cronjob minimal 10menit
                                                   & sistem akan mengirimkan email notifikasi berdasarkan transaksi terkahir pada waktu 10menit tersebut (notif tidak bisa realtime)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                           
                        

                        </div>

                        <!-- mutasi modal -->
                        <div class="modal fade" id="mutasi-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Mutasi BCA</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">     
                                      <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="header-title">Filtering</h4>
                                                    <p class="sub-header">
                                                        require filtering in your FooTable.
                                                    </p>
                
                                                        <div class="mb-2">
                                                            <div class="row row-cols-sm-auto g-2 align-items-center">
                                                                <div class="col-12 text-sm-center">
                                                                    <select id="demo-foo-filter-status" class="form-select form-select-sm">
                                                                        <option value="">Show all</option>
                                                                        <option value="DB">DB</option>
                                                                        <option value="CR">CR</option>
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
                                                                    <th>Tanggal</th>
                                                                    <th>Tipe</th>
                                                                    <th>Keterangan</th>
                                                                    <th>jumlah</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <div class="alert alert-warning">Menampilakan mutasi <?= $dataIntrvl['waktu_mutasi'] ?> hari kebelakang dari <?= $start ?> sampai <?= $now ?> </div>
                                                                    <?php
                                                                        // hitung total array dari mutasi
                                                                        $totalArray = count($mutasi);

                                                                        // looping datanya
                                                                        for ($i=0; $i < $totalArray; $i++) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $mutasi[$i][0] ?></td>
                                                                        <td>
                                                                            <?php
                                                                             if ($mutasi[$i][2] == 'CR') {
                                                                                  echo "<div class='badge bg-success'>CR</div>";
                                                                             } elseif ($mutasi[$i][2] == 'DB') {
                                                                                  echo "<div class='badge bg-danger'>DB</div>";
                                                                             }
                                                                            ?>
                                                                        </td>
                                                                        <td><?= $mutasi[$i][1] ?></td>
                                                                        <td><?= rupiah($mutasi[$i][3]) ?></td>
                                                                    </tr>
                                                                    <?php } ?> 
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
                                                        </div> <!-- end .table-responsive-->
                                                    </div>
                                                </div> <!-- end card -->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row --> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- mutasi modal -->

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

        <!-- Ion Range Slider-->
        <script src="assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <!-- Range slider init js-->
        <script src="assets/js/pages/range-sliders.init.js"></script>

        <!-- wizard -->
        <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

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
    
        
