var keyword = document.getElementById('keyword');
var container = document.getElementById('container');

//tambahkan event ketika keyword di ketik
keyword.addEventListener('keyup', function() {

    //buat oject ajax var (xhr) bebas mau apa aja nama variable nya

    var xhr =new XMLHttpRequest();
    
    //cek kesiapan ajax 4 (ajax ready) 200 (status server ok)
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200)  {
            //tampilkan data dari file.php
            container.innerHTML = xhr.responseText;
        }
    }

     //ekseskusi ajax metode GET & ambil isi dari file.php sambil mengirim value dari inputan field keyword
     xhr.open('GET', 'tampil-status.php?keyword=' + keyword.value, true);
     xhr.send();


});