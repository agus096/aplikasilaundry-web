<?php
 session_start();
 include 'assets/html/head.php'
?>

<style>
    .statusfield , .card-radius {
        border-radius: 30px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-radius">
                <div class="card-body">
                  <center class="mb-3"><h2>Cek Status Laundry</h2></center>
                   <form action="" method="POST">
                        <div class="input-group">
                            <!-- Tidak pakai name="id_inv" karena data di GET via id="keyword"-->
                            <input class="form-control statusfield" autofocus="on" type="text" id="keyword" class="form-control">
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

     <!-- hasil ajax masuk ke id="container"-->
    <div id="container"> </div>
    
    <?php include 'assets/html/footerjs.php' ?>
    <script src="ajax-status.js"></script>

</div>
