
<style>
    .statusfield , .card-radius {
        border-radius: 30px;
    }
</style>

<?php 
    session_start();
    require 'koneksi.php';

    //tangkap inputan dari id="keyword" bukan dari name="id_inv"
    //degan sanitasi str_replace untuk menghilangkan spasi dan real_escape untuk menambahkan /
    $id_inv = str_replace(' ','',mysqli_real_escape_string($kon, $_GET['keyword']));

    //cari datanya dengan fetch
    $list = mysqli_query($kon, "SELECT * FROM invoice WHERE id_inv='$id_inv' ");
    $data = mysqli_fetch_array($list);

    //jika datanya ada
    if ($data > 0) {
 ?> 
    
    <div class="row">
        <div class="col">
            <div class="card card-radius">
                <div class="card-body">
                 <table class="table responsive">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </thead>
                    <tbody>
                        <td><?= $data['nama']?></td>
                        <td>0<?= $data['whatsapp']?></td>
                        <td><?= $data['status']?></td>
                        <td><?= $data['payment']?></td>
                    </tbody>
                 </table>
                </div>
            </div>
        </div>
    </div>
        
    <?php
     } 
        //jika datanya tidak ada
        else if  ($data == 0) {
        echo 'tidak ada data ' .$id_inv ;
      }
    ?>

