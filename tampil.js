
$(document).ready(function() {
    selesai();
});
 
//refresh
function selesai() {
    setTimeout(function() {
        jumlah();
        selesai();
        pesan();
    }, 200);
}

//hitung jumblah row dari DB 
function jumlah() {
    $.getJSON("data.php", function(datas) {
        $("#notif").html(datas.jumlah);
    });
}


//ambil pesan dari json
function pesan() {
    $.getJSON("data_pesan.php", function(data) {
        $("#pesan").empty();
        var no = 1;
        $.each(data.result, function() {
            $("#pesan").append(`<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast"><div class="toast-header"><strong class="me-auto">🔔 Notification</strong><a href="deadline.php" target="_blank">View all</a><button onclick="closeFunction()" type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body"><span>Deadline service `+this['service']+` <a href="detail.php?id_inv=`+this['id_inv']+`&tipe=detail&nama=`+this['nama']+`">`+this['id_inv']+`</a></span></div>`);
        });
    });
}

//fungsi agar tombol close dapat berfungsi
function closeFunction() {
    var x = document.getElementById("pesan");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }


//auto hide 1menit = 60.000 milisecond
setTimeout(function() {
    $('#pesan').fadeOut('fast');
}, 60000); //



