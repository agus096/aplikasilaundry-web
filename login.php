<?php
session_start();
//jika ada sesion nama (alias masih login) kembalikan ke hal.index
if (isset($_SESSION['nama'])) {
    header("Location: index");
  }
require 'function.php';
require 'koneksi.php';
require 'query-config-umum.php';
?>

    <head>
        <meta charset="utf-8" />
        <title>Log In | UBold - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
		<!-- Bootstrap css -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom css -->
		<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
		<!-- icons -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<!-- Head js -->
		<script src="assets/js/head.js"></script>

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-sm">
                                                <img src="https://i.ibb.co/tp1Tmmn/washmachine.png" alt="" height="22">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="">
                                            <span class="logo-lg text-dark <?= $d_font['val'] ?>" style="font-size:<?= $d_fontsize['val'] ?>px;">
                                                <?= $d_merek['val'] ?> 
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Login sebagai cashier atau admin.</p>
                                </div>

                               
                                <?php
                                    if (isset($_SESSION['login_gagal'] )) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $_SESSION['login_gagal'];
                                        echo '</div> ';
                                        session_unset();
                                    }
                                ?>

                                <form action="proses-login" method="POST">

                                    <div class="mb-3">
                                        <label for="nama" class="form-label"><i class="fas fa-user"></i> Nama</label>
                                        <input type="text" name="nama" class="form-control"  id="nama" placeholder="Masukan nama"  required >
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label"><i class="fas fa-solid fa-key"></i> Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" required >
                                        </div>
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>

                                <br>

                               

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2022 - <script>document.write(new Date().getFullYear())</script> &copy; <?= $d_merek['val'] ?>  
        </footer>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>