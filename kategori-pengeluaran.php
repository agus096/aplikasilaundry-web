<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';
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
                                    <h4 class="page-title">Kategori pengeluaran</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                <div class="card-body">
                                    <form class="needs-validation" action="tambah-kategori-pengeluaran.php" method="POST" novalidate>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <input type="text" name="kategori" class="form-control" id="kategori" autocomplete="off" autofocus="on" required>
                                            <div class="invalid-feedback">
                                                Tolong masukan kategori!
                                            </div>
                                        </div>

                                       <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah kategori</button>
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
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $list = mysqli_query($kon,"select * from kategori_pengeluaran");
                                    while ($row = mysqli_fetch_array($list))
                                    {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['kategori'] ?></td>
                                        <td>
                                             <!-- ambil jumblah berdasarkan kategori di pengeluaran  -->
                                             <?php
                                              $kategoriOut = $row['kategori'];
                                              $j_kategori = mysqli_query($kon,"SELECT * FROM pengeluaran WHERE kategori= '$kategoriOut' ");
                                              echo mysqli_num_rows($j_kategori);
                                            ?>
                                        </td>
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
                                                    <h4 class="modal-title">Edit kategori <?= $row['kategori'] ?></h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                        <form class="needs-validation" action="edit-kategori-pengeluaran" method="POST" novalidate>

                                                            <input type="text" value="<?= $row['id'] ?>" name="id" hidden>
                                                        
                                                            <div class="mb-3">
                                                                <label for="kategori" class="form-label">Kategori</label>
                                                                <input type="text" name="kategori" value="<?= $row['kategori'] ?>" class="form-control" id="kategori" required>
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
                                                    <h4 class="modal-title">Yakin hapus? <?php echo $row['kategori'] ?></h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4 align-self-center">  
                                                    <img src="https://i.ibb.co/GC0MCGH/ask.png" width="140px">    
                                                </div>
                                                    <div class="d-grid">
                                                        <a href="hapus-kategori-pengeluaran?id=<?=$row['id']?>" class="btn btn-danger waves-effect waves-light" role="button"><i class="fas fa-trash"></i> Ya Hapus</a>
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
    
        <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
        <?php
           
           if(@$_SESSION['sukses']){ ?>
            <script>
                swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
            </script>
            <?php unset($_SESSION['sukses']); } ?>

        <?php  
            if(@$_SESSION['gagal']){?>
            <script>
                swal("Failed!", "<?php echo $_SESSION['gagal']; ?>", "error");
            </script>
            <?php unset($_SESSION['gagal']); } ?>

        </body>
        
        </html>
    
        
    </body>
</html>