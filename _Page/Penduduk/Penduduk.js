//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelPenduduk').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Penduduk/TabelPenduduk.php',
        data    : ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelPenduduk').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});
$('#ProsesFilter').submit(function(){
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
//Proses Tambah Penduduk
$('#ProsesTambahPenduduk').submit(function(){
    $('#NotifikasiTambahPenduduk').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahPenduduk')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/ProsesTambahPenduduk.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahPenduduk').html(data);
            var NotifikasiTambahPendudukBerhasil=$('#NotifikasiTambahPendudukBerhasil').html();
            if(NotifikasiTambahPendudukBerhasil=="Success"){
                $("#ProsesTambahPenduduk")[0].reset();
                $('#ModalTambahPenduduk').modal('hide');
                $('#NotifikasiTambahPenduduk').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Tambahh Penduduk Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Penduduk
$('#ModalDetailPenduduk').on('show.bs.modal', function (e) {
    var id_penduduk = $(e.relatedTarget).data('id');
    $('#FormDetailPenduduk').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/FormDetailPenduduk.php',
        data        : {id_penduduk: id_penduduk},
        success     : function(data){
            $('#FormDetailPenduduk').html(data);
        }
    });
});
//Edit Penduduk
$('#ModalEditPenduduk').on('show.bs.modal', function (e) {
    var id_penduduk = $(e.relatedTarget).data('id');
    $('#FormEditPenduduk').html("Loading...");
    $('#NotifikasiEditPenduduk').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/FormEditPenduduk.php',
        data        : {id_penduduk: id_penduduk},
        success     : function(data){
            $('#FormEditPenduduk').html(data);
        }
    });
});
//Proses Edit Penduduk
$('#ProsesEditPenduduk').submit(function(){
    $('#NotifikasiEditPenduduk').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPenduduk')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/ProsesEditPenduduk.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPenduduk').html(data);
            var NotifikasiEditPendudukBerhasil=$('#NotifikasiEditPendudukBerhasil').html();
            if(NotifikasiEditPendudukBerhasil=="Success"){
                $('#ModalEditPenduduk').modal('hide');
                swal("Success!", "Edit Penduduk Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Hapus Penduduk
$('#ModalHapusPenduduk').on('show.bs.modal', function (e) {
    var id_penduduk = $(e.relatedTarget).data('id');
    $('#FormHapusPenduduk').html("Loading...");
    $('#NotifikasiHapusPenduduk').html('');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/FormHapusPenduduk.php',
        data        : {id_penduduk: id_penduduk},
        success     : function(data){
            $('#FormHapusPenduduk').html(data);
        }
    });
});
//Proses Hapus Penduduk
$('#ProsesHapusPenduduk').submit(function(){
    $('#NotifikasiHapusPenduduk').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusPenduduk')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/ProsesHapusPenduduk.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusPenduduk').html(data);
            var NotifikasiHapusPendudukBerhasil=$('#NotifikasiHapusPendudukBerhasil').html();
            if(NotifikasiHapusPendudukBerhasil=="Success"){
                $('#ModalHapusPenduduk').modal('hide');
                swal("Success!", "Hapus Penduduk Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});

//Proses Hapus Penduduk
$('#ProsesImport').submit(function(){
    $('#NotifikasiImport').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesImport')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Penduduk/ProsesImport.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiImport').html(data);
        }
    });
});