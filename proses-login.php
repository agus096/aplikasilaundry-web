<?php 
session_start();
include 'koneksi.php';
include 'function.php';
$nama =  pilter($_POST['nama']) ;
$password =  pilter($_POST['password']) ;

$query = mysqli_query($kon, "SELECT * FROM users WHERE nama='$nama' AND password=md5('$password')");
    if (mysqli_num_rows($query) > 0) {
        mysqli_query($kon, "INSERT INTO login VALUES ('','".getIpAddress()."','$nama','hidden','benar') " );
        $data = mysqli_fetch_array($query);
        $_SESSION['nama'] = $data['nama'];
        #menyembunyikan file index/file lain yang jadi index dengan memanggil foldernya
        header("Location: /zlaundry ");
    } else {
    $_SESSION['login_gagal'] = "Pass / user salah!" ;
    #jika login gagal masukan ip yang gagal ke LOG
    mysqli_query($kon, "INSERT INTO login VALUES ('','".getIpAddress()."','$nama','$password','salah') ");
    header("Location: login");
    }
 
?>