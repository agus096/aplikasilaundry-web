<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';
require 'query-config-umum.php';
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
                                    <h4 class="page-title">Pengaturan umum</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                <div class="card-body">
                                    
                                    <form class="needs-validation parsley-examples" action="edit-config-umum" method="POST" novalidate>

                                      <div class="row">
                                        <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="merek" class="form-label">Merek</label>
                                            <input type="text" name="val[]" value="<?= $d_merek['val'] ?>" data-parsley-maxlength="20" class="form-control" id="merek" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="font" class="form-label">Logo font</label>
                                            <select class="form-control" id="selectize-select" name="val[]" required>
                                                <option data-display="Select" value="<?= $d_font['val'] ?>"><?= $d_font['val'] ?></option>
                                                <option value="bellania">bellania</option>
                                                <option value="GraySkin">GraySkin</option>
                                            </select>
                                        </div>  
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="fontsize" class="form-label">Font size</label>
                                            <input type="text" data-toggle="touchspin" name="val[]" value="<?= $d_fontsize['val'] ?>"  class="form-control" id="fontsize" data-bts-button-down-class="btn btn-danger" data-bts-button-up-class="btn btn-info" required>
                                        </div>
                                        </div>
                                      </div>

                                        <div class="mb-3">
                                            <label for="slidermaxiservice" class="form-label">Max input service</label>
                                            <input type="text" name="val[]" value="<?= $d_maxinput['val'] ?>" id="slidermaxiservice" required>
                                        </div>


                                        <div class="mb-3">
                                            <label for="footer" class="form-label">Footer</label>
                                            <input type="text" name="val[]" value="<?= $d_footer['val'] ?>"  class="form-control" id="footer" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" name="val[]" value="<?= $d_alamat['val'] ?>"  class="form-control" id="alamat" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">Kontak</label>
                                            <input type="text" name="val[]" value="<?= $d_kontak['val'] ?>"  class="form-control" id="kontak" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pesan" class="form-label">Pesan wa</label>
                                            <input type="text" name="val[]" value="<?= $d_pesan['val'] ?>"  class="form-control" id="pesan" required>
                                        </div>       

                                       <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>

                                </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="toast fade show d-flex align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-body">
                                    🔔 <b>Max input</b> adalah jumlah maximal service pada saat input transaksi!
                                    </div>
                                    <button type="button" class="btn-close ms-auto me-2" data-bs-dismiss="toast"
                                        aria-label="Close">
                                    </button>
                                </div>
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
         
        <!-- pengurutan js ulang untuk wizard bekerja-->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Parsley js-->
         <script src="assets/libs/parsleyjs/parsley.min.js"></script>

        <!-- Validation init js-->
        <script src="assets/js/pages/form-validation.init.js"></script>

        <!-- Ion Range Slider-->
        <script src="assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <!-- Range slider init js-->
        <script src="assets/js/pages/range-sliders.init.js"></script>

    
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