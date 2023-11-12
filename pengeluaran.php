<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';
require 'function.php';
require 'query-config-umum.php';
?>

   <?php include 'assets/html/head.php' ?>

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
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">Pengeluaran</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body bg-pattern">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="assets/images/outcome.png" class="avatar-title">
                                            </div>
                                            <!-- SUM total outcome hari ini saja -->
                                            <?php
                                                $now = date('Y-m-d');
                                                $outcome = mysqli_query($kon, " SELECT SUM(harga) FROM pengeluaran WHERE datefull = '$now' ");
                                                $d_outcome = mysqli_fetch_array($outcome);
                                            ?>
                                            <div class="col-8">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span><?= rupiah($d_outcome['SUM(harga)']) ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Outcome hari ini</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body bg-pattern">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="assets/images/down.png" class="avatar-title">
                                            </div>
                                            <!-- Total outcome hari ini saja -->
                                            <?php
                                                $now = date('Y-m-d');
                                                $out_today = mysqli_query($kon, " SELECT * FROM pengeluaran WHERE datefull = '$now' ");
                                            ?>
                                            <div class="col-8">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= mysqli_num_rows($out_today); ?> </span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Total outcome hari ini</p>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                        <!-- end row-->
                        
                        <!-- button add-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body d-grid">
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-modal"> <i class="fas fa-plus"></i> Tambah pengeluaran  </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- button add-->

                        <!-- Add modal -->
                        <div id="add-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-light bg-light">
                                        <h4 class="modal-title">Tambah pengeluaran</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                    <form class="needs-validation parsley-examples" action="tambah-pengeluaran.php" method="POST" novalidate>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal<span class="text-danger">*</span> </label>
                                                    <input type="text" name="tanggal" value="<?= date('Y-m-d');?>" id="basic-datepicker"  class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Penginput<span class="text-danger">*</span></label>
                                                    <input type="text" name="cashier" class="form-control" value="<?= $_SESSION['nama'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tujuan <span class="text-danger">*</span></label>
                                                    <input type="text" name="tujuan" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                                    <select class="form-control selectKategori" name="kategori">
                                                        <?php  
                                                            $data = mysqli_query($kon,"SELECT * FROM kategori_pengeluaran");
                                                            while($kat=mysqli_fetch_array($data)) {
                                                        ?>
                                                        <option value="<?= $kat['kategori']?>"><?= $kat['kategori']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Harga <span class="text-danger">*</span></label>
                                                <input type="text" name="harga" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Keterangan</label>
                                                    <input type="text" name="keterangan" class="form-control" placeholder="Optional">
                                                </div>
                                            </div>
                                        </div>
                                         
                                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Lanjut</button>
                                    </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                        <!--Add modal -->

                       

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Data</h4>
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tanggal</th>
                                                    <th>Cashier</th>
                                                    <th>Tujuan</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $nom = 1;
                                                    $list = mysqli_query($kon,"select * from pengeluaran ORDER by id ASC ");
                                                    while ($row = mysqli_fetch_array($list))
                                                    {
                                                 ?>
                                                <tr>
                                                    <td><?php echo $nom++; ?></td>
                                                    <td><?php echo $row['datefull'] ?></td>
                                                    <td><?php echo $row['cashier'] ?></td>
                                                    <td><?php echo $row['tujuan'] ?></td>
                                                    <td><?php echo $row['kategori'] ?></td>
                                                    <td><?php echo $row['harga'] ?></td>
                                                    <td><?php echo $row['keterangan'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal<?= $row['id']?>"><i class="fas fa-edit"></i>  Edit</button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#hapus-modal<?=$row['id']?>" > <i class="fas fa-trash"></i> Hapus</button>
                                                    </td>
                                                </tr>   
                                                
                                                <!-- edit modal -->
                                                <div id="edit-modal<?= $row['id'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title">Edit <?= $row['id'] ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                            <form action="edit-pengeluaran" method="POST">

                                                            <input type="text" value="<?= $row['id'] ?>" name="id" class="form-control" hidden>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tanggal<span class="text-danger">*</span> </label>
                                                                        <input type="text" name="tanggal" value="<?= date('Y-m-d');?>" class="form-control datepickedit" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tujuan <span class="text-danger">*</span></label>
                                                                        <input type="text" name="tujuan" value="<?= $row['tujuan'] ?>" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                                                        <select class="form-control selectKategori" name="kategori">
                                                                            <option data-display="Select" value="<?= $row['kategori']?>"><?= $row['kategori']?></option>
                                                                                <?php  
                                                                                    $data = mysqli_query($kon,"SELECT * FROM kategori_pengeluaran");
                                                                                    while($kat=mysqli_fetch_array($data)) {
                                                                                ?>
                                                                            <option value="<?= $kat['kategori']?>"><?= $kat['kategori']?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga <span class="text-danger">*</span></label>
                                                                    <input type="text" name="harga" value="<?= $row['harga'] ?>" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Keterangan</label>
                                                                        <input type="text" name="keterangan" value="<?= $row['keterangan'] ?>" placeholder="Optional" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                                        </div>
                                                    </form>
                                                        </div>
                                                    </div>
                                                  </div>
                                                <!--edit modal --> 

                                                
                                                <!-- hapus modal -->
                                                <div id="hapus-modal<?= $row['id'] ?>" class="modal fade"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title">Yakin hapus? <?php echo $row['id'] ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4 align-self-center">  
                                                              <img src="https://i.ibb.co/GC0MCGH/ask.png" width="140px">    
                                                            </div>
                                                                <div class="d-grid">
                                                                    <a href="hapus-pengeluaran?id=<?=$row['id']?>&kategori=<?=$row['kategori']?>" class="btn btn-danger waves-effect waves-light" role="button"><i class="fas fa-trash"></i> Ya Hapus</a>
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
                        <!-- end row -->

                        <!-- semua yang berclass datepickedit dae di beri flatpickr -->
                        <script>
                            $(function() {
                            $('.datepickedit').flatpickr({
                                format: 'yyyy-mm-dd',
                                todayBtn: 'linked',
                            });
                            });
                        </script>

                        <!-- semua  class selectUnit di beri selectize -->
                        <script>
                            $(function() {
                            $('.selectKategori').selectize({});
                            });
                        </script>
   
                    </div> <!-- container -->

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


        <?php include 'assets/html/footerjs.php'?>
     


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
    