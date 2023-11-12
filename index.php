<!DOCTYPE html>
<html lang="en">

<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require 'koneksi.php';
require 'function.php';
require 'query-config-umum.php';

// $nowyear untuk filter data selesai hanya tahun ini saja yg tampil
$nowyear = date("Y");
$jam = $jam = date('H:i');
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
                                    <h4 class="page-title">Dashboard</h4>
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
                                                <img src="assets/images/income.png" class="avatar-title">
                                            </div>
                                            <!-- SUM total income hari ini saja -->
                                            <?php
                                                $now = date('Y-m-d');
                                                $income = mysqli_query($kon, " SELECT SUM(harga) FROM transaksi WHERE datefull = '$now' AND status ='Selesai' ");
                                                $d_income = mysqli_fetch_array($income);
                                            ?>
                                            <div class="col-8">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span><?= rupiah($d_income['SUM(harga)']) ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Income hari ini (Dibayar)</p>
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
                                                <img src="assets/images/invoice.png" class="avatar-title">
                                            </div>
                                            <!-- Total invoice hari ini saja -->
                                            <?php
                                                $now = date('Y-m-d');
                                                $inv_today = mysqli_query($kon, " SELECT * FROM invoice WHERE datefull = '$now' ");
                                            ?>
                                            <div class="col-8">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= mysqli_num_rows($inv_today); ?> </span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Invoice hari ini</p>
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
                                                    <img src="assets/images/perbandingan.png" class="avatar-title">
                                            </div>
                                            <?php
                                             $selesai = mysqli_query($kon, "SELECT * FROM invoice WHERE status ='Selesai' AND tahun = '$nowyear' ");
                                            ?>
                                            <div class="col-4">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><i class="far fa-check-circle"></i> <span data-plugin="counterup"> <?= mysqli_num_rows($selesai) ?> </span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Selesai</p>
                                                </div>
                                            </div>
                                            <?php
                                             $proses = mysqli_query($kon, "SELECT * FROM invoice WHERE status ='Proses' ");
                                            ?>
                                            <div class="col-4">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><i class="fas fa-hourglass-start"></i> <span data-plugin="counterup"> <?= mysqli_num_rows($proses); ?> </span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Proses</p>
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
                                                <img src="assets/images/customer.png" class="avatar-title">
                                            </div>
                                            <!-- Total customer -->
                                            <?php
                                                $customer = mysqli_query($kon, " SELECT * FROM customer");
                                            ?>
                                            <div class="col-8">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> <?= mysqli_num_rows($customer); ?> </span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Total customer</p>
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
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-modal"> <i class="fas fa-plus"></i> Tambah invoice  </button>
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
                                        <h4 class="modal-title">Tambah invoice</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                    <form action="tambah-invoice" method="POST" name="formPesanan">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal<span class="text-danger">*</span> </label>
                                                    <input type="text" name="tanggal" value="<?= date('Y-m-d');?>" id="basic-datepicker"  class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="text" name="jam" value="<?= date("H:i"); ?>"  class="form-control" hidden>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Cashier <span class="text-danger">*</span></label>
                                                    <input type="text" name="cashier" class="form-control" value="<?= $_SESSION['nama'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                   <label class="form-label">Whatsapp <span class="text-danger">*</span></label>
                                                     <div class="input-group">
                                                        <span class="input-group-text">0</span>
                                                        <input type="number" id="whatsapp" name="whatsapp" class="form-control" onkeyup="isi_otomatis()" autocomplete="off" required>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        for ($i=1; $i<=$d_maxinput['val']; $i++) {
                                        ?>

                                        <!-- service -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                <label class="form-label">Service 
                                                    <?php 
                                                        if ($i == '1') {
                                                        echo "<span class='text-danger'>*</span>";
                                                        }
                                                    ?>
                                                </label>
                                                <select class="form-select select2modal" name="service[]" data-toggle="select2"  data-width="100%"
                                                 
                                                <?php 
                                                    if ($i == '1') {
                                                     echo 'required';
                                                    }
                                                ?>
                                                
                                                >
                                                <option selected></option>
                                                    <?php
                                                        $list = mysqli_query($kon,"select * from service ORDER by id ASC ");
                                                        while ($row = mysqli_fetch_array($list))
                                                        {
                                                    ?>
                                                <option value="<?= $row['service'] ?>"> <?= $row['service'] ?> </option>
                                                <?php } ?>
                                                </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Qty
                                                    <?php 
                                                        if ($i == '1') {
                                                        echo "<span class='text-danger'>*</span>";
                                                        }
                                                    ?>
                                                    </label>
                                                    <input type="number" name="berat[]" class="form-control" placeholder="Kg/Pcs/M"
                                                    <?php 
                                                        if ($i == '1') {
                                                        echo 'required';
                                                        }
                                                    ?>
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- service -->   
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Lanjut</button>
                                    </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                        <!--Add modal -->

                        <!--Semua yang berclass select2modal gunakan select2 -->
                        <script>
                            $(function() {
                            $('.select2modal').select2({
                                dropdownParent: $('#add-modal')

                            });
                            });
                        </script>

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
                                                    <th>Id_inv</th>
                                                    <th>Nama</th>
                                                    <th>Whatsapp</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $nom = 1;
                                                    $list = mysqli_query($kon,"select * from invoice ORDER by id ASC ");
                                                    while ($row = mysqli_fetch_array($list))
                                                    {
                                                 ?>
                                                <tr>
                                                    <td><?php echo $nom++; ?></td>
                                                    <td><?php echo $row['datefull']?></td>
                                                    <td><?php echo $row['id_inv'] ?></td>
                                                    <td><?php echo $row['nama'] ?></td>
                                                    <td>
                                                    <?php
                                                        if ($row['status'] == 'Selesai') {
                                                            echo "<a href='https://web.whatsapp.com/send/?phone=62$row[whatsapp]&text=$d_pesan[val]' target='#blank'> 0$row[whatsapp] <i class='fas fa-external-link-alt'></i> </a>";
                                                        } else {
                                                            echo '0'.$row['whatsapp'];
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal<?= $row['id'] ?>"><i class="fas fa-edit"></i>  Edit</button>
                                                        <?php 
                                                            if ($row['status'] == 'Selesai') {
                                                              echo "<button type='button' class='btn btn-danger waves-effect waves-light disabled'> <i class='fas fa-trash'></i> Hapus</button>";
                                                            } else {
                                                              echo "<button type='button' class='btn btn-danger waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#hapus-modal$row[id]' > <i class='fas fa-trash'></i> Hapus</button>"; 
                                                            }
                                                        ?>
                                                        <a href="detail?id_inv=<?php echo $row['id_inv'] ?>&tipe=detail" class="btn btn-warning" role="button"><i class="fas fa-eye"></i> Detail</a>
                                                    </td>
                                                </tr>   
                                                
                                                <!-- edit modal -->
                                                <div id="edit-modal<?= $row['id'] ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title">Edit <?= $row['id_inv'] ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                            <form action="edit-invoice" method="POST">

                                                            <input type="text" value="<?= $row['id_inv'] ?>" name="id_inv" class="form-control" hidden>

                                                            <?php 
                                                                if($row['status'] == 'Selesai') {
                                                                    echo "
                                                                        <div class='row'>
                                                                            <div class='col-md-6'>
                                                                                <div class='mb-3'>
                                                                                    <label hidden class='form-label'>Nama</label>
                                                                                    <input type='text' value='$row[nama]' name='nama' class='form-control' hidden>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-md-6'>
                                                                                <div class='mb-3'>
                                                                                    <label hidden class='form-label'>Whatsapp</label>
                                                                                    <input type='text' value='$row[whatsapp]' name='whatsapp' class='form-control' hidden>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        ";

                                                                } else {
                                                                    echo "
                                                                        <div class='row'>
                                                                            <div class='col-md-6'>
                                                                                <div class='mb-3'>
                                                                                    <label class='form-label'>Nama</label>
                                                                                    <input type='text' value='$row[nama]' name='nama' class='form-control'>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-md-6'>
                                                                                <div class='mb-3'>
                                                                                 <label class='form-label'>Whatsapp</label>
                                                                                  <div class='input-group'>
                                                                                    <span class='input-group-text'>0</span>
                                                                                    <input type='text' value='$row[whatsapp]' name='whatsapp' class='form-control'>
                                                                                  </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        ";
                                                                }
                                                            ?>

                                                            <div class="row">
                                                             <div class="col-lg-12">
                                                             <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-control selectStatus" name="status" required>
                                                                    <option data-display="Select" value="<?= $row['status'] ?>"><?= $row['status'] ?></option>
                                                                    <option value="Proses">Proses</option>
                                                                    <option value="Selesai">Selesai</option>
                                                                </select>
                                                             </div>
                                                             </div>
                                                            </div> 


                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
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
                                                                <h4 class="modal-title">Yakin hapus? <?php echo $row['id_inv'] ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4 align-self-center">  
                                                              <img src="https://i.ibb.co/GC0MCGH/ask.png" width="140px">    
                                                            </div>
                                                                <div class="d-grid">
                                                                    <a href="hapus-inv-trx?id_inv=<?=$row['id_inv']?>&nama=<?= $row['nama'] ?>" class="btn btn-danger waves-effect waves-light" role="button"><i class="fas fa-trash"></i> Ya Hapus</a>
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

                        <!-- semua yang berclass selectStatus  di beri selectize -->
                        <script>
                            $(function() {
                            $('.selectStatus').selectize({});
                            });
                        </script>
                        
                    </div> <!-- container -->

                    <div style="position: fixed; bottom: 100px; right: 20px; z-index: 99;">
                    <div id="pesan"></div>
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

        

        <?php 
            include 'assets/html/footerjs.php';
           
        ?>

        <script type="text/javascript" src="tampil.js"></script>

  
    
        <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
        <?php if(@$_SESSION['sukses']){ ?>
            <script>
                swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
            </script>
        <!-- menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']); } ?>


        <!-- jika ada sesion buka wa karena habis update status ke selesai makan popup wa akan terbuka-->
        <?php if(@$_SESSION['bukawa']){ ?>
            <script language="javascript">window.open(" <?=$_SESSION["bukawa"]  ?> ","_blank");</script>
        <!-- menambahkan unset agar popup wa tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['bukawa']); } ?>


        
        </body>
        
    </html>
    