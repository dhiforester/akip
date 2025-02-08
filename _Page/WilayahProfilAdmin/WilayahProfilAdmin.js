//Fungsi Menampilkan Data Provinsi
function MenampilkanTabelAksesKecamatan() {
    $('#MenampilkanTabelAksesKecamatan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfilAdmin/TabelAksesKecamatan.php',
        success     : function(data){
            $('#MenampilkanTabelAksesKecamatan').html(data);
        }
    });
}

$(document).ready(function() {
    //Menampilkan Cata Kecamatan Pertama Kali
    MenampilkanTabelAksesKecamatan();
    
    $('#TabelKecamatan').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/WilayahProfilAdmin/TabelKecamatan.php',
        success: function(data) {
            $('#TabelKecamatan').html(data);
        }
    });
});
//Ketika Muncul Modal Detail Demografi
$('#ModalDetailDemografi').on('show.bs.modal', function (e) {
    var id_wilayah_demografi = $(e.relatedTarget).data('id');
    $('#FormDetailDemografi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormDetailDemografi.php',
        data        : {id_wilayah_demografi: id_wilayah_demografi},
        success     : function(data){
            $('#FormDetailDemografi').html(data);
        }
    });
});
//Ketika Muncul Modal Detail Capaian Target
$('#ModalDetailCapaianTarget').on('show.bs.modal', function (e) {
    var id_target_capaian = $(e.relatedTarget).data('id');
    $('#FormDetailCapaianTarget').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormDetailCapaianTarget.php',
        data        : {id_target_capaian: id_target_capaian},
        success     : function(data){
            $('#FormDetailCapaianTarget').html(data);
        }
    });
});