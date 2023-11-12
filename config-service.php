<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';
require 'function.php';
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
                                    <h4 class="page-title">Pengaturan service</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                <div class="card-body">
                                    
                                    <form class="needs-validation" action="tambah-data-service" method="POST" novalidate>
                                        <div class="mb-3">
                                            <label for="service" class="form-label">Service</label>
                                            <input type="text" name="service" class="form-control" id="service" autofocus autocomplete="off" required>
                                            <div class="invalid-feedback">
                                               Tolong masukan service!
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="number" name="harga" class="form-control" id="harga" autocomplete="off" required>
                                            <div class="invalid-feedback">
                                                Tolong masukan harga!
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="deadline" class="form-label">deadline</label>
                                                    <input type="number" name="angka" class="form-control" id="deadline" autocomplete="off" required>
                                                    <div class="invalid-feedback">
                                                        Masukan Jumlah hari atau jam!
                                                    </div>
                                               </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="Jam/Hari" class="form-label">Jam/Hari</label>
                                                    <select class="form-control selectize" name="jam/hari" required>
                                                        <option value="Jam">Jam</option>
                                                        <option value="Hari">Hari</option>
                                                    </select>
                                               </div>
                                            </div>
                                        </div>

                                       
                                        <div class="mb-3">
                                            <label class="form-label">Unit</label>
                                            <select class="form-control selectize" name="unit">
                                                <option value="Kg">Kg</option>
                                                <option value="Pcs">Pcs</option>
                                                <option value="M">M (Meter)</option>
                                            </select>
                                        </div>


                                       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah service</button>
                                    </form>

                                </div>
                                </div>
                            </div>

                            <div class="col-6">
                               <div class="card">
                                <div class="card-body">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Service</th>
                                        <th>Harga</th>
                                        <th>deadline</th>
                                        <th>Unit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $list = mysqli_query($kon,"select * from service");
                                        while ($row = mysqli_fetch_array($list))
                                    {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['service'] ?></td>
                                        <td><?= rupiah($row['harga']) ?></td>
                                        <td><?= $row['deadline'] ?></td>
                                        <td><?= $row['unit'] ?></td>
                                        <td> 
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal<?= $row['id'] ?>"><i class="fas fa-edit"></i>  Edit</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#hapus-modal<?= $row['id'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                   
                                    <!-- edit modal -->
                                    <div id="edit-modal<?= $row['id'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h4 class="modal-title">Edit data</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                        <form action="edit-data-service" method="POST">
                                                            
                                                            <input type="text" value="<?= $row['id'] ?>" name="id" hidden>
                                                        
                                                            <div class="mb-3">
                                                                <label for="service" class="form-label">Service</label>
                                                                <input type="text" name="service" value="<?= $row['service'] ?>"  class="form-control" id="service" required>
                                                                <div class="invalid-feedback">
                                                                    Jangan kosongkan field
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga</label>
                                                                <input type="number" name="harga" value="<?= $row['harga'] ?>" class="form-control" id="harga" required>
                                                                <div class="invalid-feedback">
                                                                    Isi dengan data yang valid
                                                                </div>
                                                            </div>

                                                            <?php $deadline = explode(" ",$row['deadline']) ?>


                                                            <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="deadline" class="form-label">deadline</label>
                                                                    <input type="number" name="angka" class="form-control" value="<?= $deadline[0] ?>" id="deadline" autocomplete="off" required>
                                                                    <div class="invalid-feedback">
                                                                        Masukan Jumlah hari atau jam!
                                                                    </div>
                                                            </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="Jam/Hari" class="form-label">Jam/Hari</label>
                                                                    <select class="form-control selectize" name="jam/hari" required>
                                                                        <option data-display="Select" value="<?= $deadline[1] ?>"><?= $deadline[1] ?></option>
                                                                        <option value="Jam">Jam</option>
                                                                        <option value="Hari">Hari</option>
                                                                    </select>
                                                            </div>
                                                            </div>
                                                        </div>

                                                            <div class="mb-3">
                                                                <label for="selectizeUnit" class="form-label">Unit</label>
                                                                <select class="form-control selectize" name="unit">
                                                                    <option value="Kg">Kg</option>
                                                                    <option value="Pcs">Pcs</option>
                                                                    <option value="M">M (Meter)</option>
                                                                </select>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--edit modal --> 

                                    <!-- hapus modal -->
                                    <div id="hapus-modal<?= $row['id'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h4 class="modal-title">Yakin hapus? <?php echo $row['service'] ?></h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4 align-self-center">  
                                                    <img src="https://i.ibb.co/GC0MCGH/ask.png" width="140px">    
                                                </div>
                                                    <div class="d-grid">
                                                        <a href="hapus-data-service?service=<?=$row['service']?>" class="btn btn-danger waves-effect waves-light" role="button"><i class="fas fa-trash"></i> Ya Hapus</a>
                                                    </div>   
                                            </div>
                                        </div>
                                        </div>
                                    <!--hapus modal --> 

                                    <?php } ?>
                                </tbody>
                                </table>
                                </div>
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
    
        <!-- jika ada session sukses/gagal maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
       
        <?php
           if(@$_SESSION['sukses']){    
        ?>
            <script>
                swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
            </script>
        <?php unset($_SESSION['sukses']); } ?>

        <?php  
            if(@$_SESSION['gagal']){
         ?>
            <script>
                swal("Failed!", "<?php echo $_SESSION['gagal']; ?>", "error");
            </script>
        <?php unset($_SESSION['gagal']); } ?>

         <!-- semua select di beri selectize -->
         <script>
            $(function() {
            $('.selectize').selectize({});
            });
        </script>

    </body>
</html>