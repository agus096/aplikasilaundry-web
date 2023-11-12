<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require 'koneksi.php';

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
                                    <h4 class="page-title">Chart</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-body pb-2">
                                            <div class="float-end d-none d-md-inline-block">
                                             <form action="" method="POST">
                                                <select id="selectize-select" name="seltahun" onchange="this.form.submit();" style="width:100px;"  >
                                                    <option data-display="Select" value="<?= $seltahun ?>"><?= $seltahun ?></option>
                                                    <?php 
                                                      $tahunchart =  mysqli_query($kon,"SELECT * FROM tahunchart");
                                                      while ($row = mysqli_fetch_array($tahunchart)) {
                                                    ?>
                                                    <option value="<?=$row['tahun']?>"><?= $row['tahun']?></option> 
                                                    <?php } ?>
                                                </select>
                                              </form>
                                            </div>
                                            <h4 class="header-title mb-3">Chart Income & Outcome <?= $seltahun ?> (ApexChart) </h4>
                                            <div dir="ltr">
                                                <div id="Chart-cashflow" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
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
        <script>
                var colors = ["#f1556c"],
                dataColors = $("#total-Outcome").data("colors");
                dataColors && (colors = dataColors.split(","));
                var options = {
                        series: [68],
                        chart: {
                        height: 242,
                        type: "radialBar"
                        },
                        plotOptions: {
                        radialBar: {
                                hollow: {
                                size: "65%"
                                }
                        }
                        },
                        colors: colors,
                        labels: ["Outcome"]
                },
                chart = new ApexCharts(document.querySelector("#total-Outcome"), options);
                chart.render();
                colors = ["#f4534545", "#4534535"];
                (dataColors = $("#Chart-cashflow").data("colors")) && (colors = dataColors.split(","));
                options = {
                series: [{
                        name: "Outcome",
                        type: "line",
                        data: [  

                                <?php 
                                //SUM income dari transksi & looping sampai 12 alias desember
                                for($b=1; $b<13; $b++) {
                                    $bulan =  mysqli_query($kon,"SELECT SUM(harga) FROM pengeluaran WHERE bulan='$b' AND tahun = '$seltahun' " );
                                    $d_bulan = mysqli_fetch_array($bulan);

                                        if ($d_bulan['SUM(harga)'] == "") {
                                                echo "0,";
                                        } else {
                                                echo $d_bulan['SUM(harga)'].',' ;
                                        }
                                    }    
                                ?>
                                
                            
                            ]
                }, {
                        name: "Income",
                        type: "line",
                        data: [

                                <?php 
                                //SUM income dari transksi & looping sampai 12 alias desember
                                for($b=1; $b<13; $b++) {
                                    $bulan =  mysqli_query($kon,"SELECT SUM(harga) FROM transaksi WHERE bulan='$b' AND tahun = '$seltahun' AND status= 'Selesai' " );
                                    $d_bulan = mysqli_fetch_array($bulan);
                                    if ($d_bulan['SUM(harga)'] == "") {
                                        echo "0,";
                                        } else {
                                                echo $d_bulan['SUM(harga)'].',' ;
                                        }
                                }        
                                ?>
                                
                            ]
                                

                }],
                chart: {
                        height: 378,
                        type: "line",
                        offsetY: 10
                },
                stroke: {
                        width: [2, 3]
                },
                plotOptions: {
                        bar: {
                        columnWidth: "50%"
                        }
                },
                colors: colors,
                dataLabels: {
                        enabled: !0,
                        enabledOnSeries: [1]
                },
                labels: ["Jan<?= $seltahun ?>", "Feb<?= $seltahun ?>", "Mar<?= $seltahun ?>", "Apr<?= $seltahun ?>", "Mei<?= $seltahun ?>", "Jun<?= $seltahun ?>", "Jul<?= $seltahun ?>", "Agus<?= $seltahun ?>", "Sep<?= $seltahun ?>", "Okt<?= $seltahun ?>", "Nov<?= $seltahun ?>", "Des<?= $seltahun ?>",],
                xaxis: {

                },
                legend: {
                        offsetY: 7
                },
                grid: {
                        padding: {
                        bottom: 20
                        }
                },
                fill: {
                        type: "gradient",
                        gradient: {
                        shade: "light",
                        type: "horizontal",
                        shadeIntensity: .25,
                        gradientToColors: void 0,
                        inverseColors: !0,
                        opacityFrom: .75,
                        opacityTo: .75,
                        stops: [0, 0, 0]
                        }
                },
                yaxis: [{
                        title: {
                        text: "Skala"
                        }
                }]
                };
                (chart = new ApexCharts(document.querySelector("#Chart-cashflow"), options)).render(), $("#dash-daterange").flatpickr({
                
                });
        </script>

       
        

    
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
</html>