//Fungsi Menampilkan Data
function showEvaluasi() {
    $('#MenampilkanTabelEvaluasi').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Evaluasi/TabelEvaluasi.php',
        success: function(data) {
            $('#MenampilkanTabelEvaluasi').html(data);
        }
    });
}
function showPesertaEvaluasi() {
    var id_evaluasi=$('#GetIdEvaluasi').val();
    $('#TabelPesertaEvaluasi').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Evaluasi/TabelPesertaEvaluasi.php',
        data    : {id_evaluasi: id_evaluasi},
        success: function(data) {
            $('#TabelPesertaEvaluasi').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    showEvaluasi();
    showPesertaEvaluasi();
});
//Proses Tambah Evaluasi
$('#ProsesTambahEvaluasi').submit(function(){
    $('#NotifikasiTambahEvaluasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahEvaluasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/ProsesTambahEvaluasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahEvaluasi').html(data);
            var NotifikasiTambahEvaluasiBerhasil=$('#NotifikasiTambahEvaluasiBerhasil').html();
            if(NotifikasiTambahEvaluasiBerhasil=="Success"){
                $("#ProsesTambahEvaluasi")[0].reset();
                $('#ModalTambahEvaluasi').modal('hide');
                $('#NotifikasiTambahEvaluasi').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Tambahh Evaluasi Berhasil!", "success");
                //Menampilkan Data
                showEvaluasi();
            }
        }
    });
});
//Modal Detail Evaluasi
$('#ModalDetailEvaluasi').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormDetailEvaluasi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/FormDetailEvaluasi.php',
        data        : {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormDetailEvaluasi').html(data);
        }
    });
});
//Modal Edit Evaluasi
$('#ModalEditEvaluasi').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormEditEvaluasi').html("Loading...");
    $('#NotifikasiEditEvaluasi').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/FormEditEvaluasi.php',
        data        : {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormEditEvaluasi').html(data);
        }
    });
});
//Proses Edit Evaluasi
$('#ProsesEditEvaluasi').submit(function(){
    $('#NotifikasiEditEvaluasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditEvaluasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/ProsesEditEvaluasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditEvaluasi').html(data);
            var NotifikasiEditEvaluasiBerhasil=$('#NotifikasiEditEvaluasiBerhasil').html();
            if(NotifikasiEditEvaluasiBerhasil=="Success"){
                $('#ModalEditEvaluasi').modal('hide');
                swal("Success!", "Edit Evaluasi Berhasil!", "success");
                //Menampilkan Data
                showEvaluasi();
            }
        }
    });
});
//Modal Hapus Evaluasi
$('#ModalHapusEvaluasi').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormHapusEvaluasi').html("Loading...");
    $('#NotifikasiHapusEvaluasi').html('');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/FormHapusEvaluasi.php',
        data        : {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormHapusEvaluasi').html(data);
        }
    });
});
//Proses Hapus Evaluasi
$('#ProsesHapusEvaluasi').submit(function(){
    $('#NotifikasiHapusEvaluasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusEvaluasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/ProsesHapusEvaluasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusEvaluasi').html(data);
            var NotifikasiHapusEvaluasiBerhasil=$('#NotifikasiHapusEvaluasiBerhasil').html();
            if(NotifikasiHapusEvaluasiBerhasil=="Success"){
                $('#ModalHapusEvaluasi').modal('hide');
                swal("Success!", "Hapus Evaluasi Berhasil!", "success");
                //Menampilkan Data
                showEvaluasi();
            }
        }
    });
});


//ModalUbah Response
$('#ModalUbahResponse').on('show.bs.modal', function (e) {
    var id_evaluasi_jawaban = $(e.relatedTarget).data('id');
    $('#FormUbahResponse').html("Loading...");
    $('#NotifikasiUbahResponseBerhasil').html('');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/FormUbahResponse.php',
        data        : {id_evaluasi_jawaban: id_evaluasi_jawaban},
        success     : function(data){
            $('#FormUbahResponse').html(data);
        }
    });
});
//Proses Ubah Response
$('#ProsesUbahResponse').submit(function(){
    $('#NotifikasiUbahResponse').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUbahResponse')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/ProsesUbahResponse.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUbahResponse').html(data);
            var NotifikasiUbahResponseBerhasil=$('#NotifikasiUbahResponseBerhasil').html();
            if(NotifikasiUbahResponseBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//ModalRekapJawaban
$('#ModalRekapJawaban').on('show.bs.modal', function (e) {
    var GetParameter = $(e.relatedTarget).data('id');
    $('#FormRekapJawaban').html("Loading...");
    $('#NotifikasiRekapJawaban').html('');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/FormRekapJawaban.php',
        data        : {GetParameter: GetParameter},
        success     : function(data){
            $('#FormRekapJawaban').html(data);
        }
    });
});
//Proses Simpan Rekapitulasi
$('#ProsesRekapJawaban').submit(function(){
    $('#NotifikasiRekapJawaban').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesRekapJawaban')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Evaluasi/ProsesRekapJawaban.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiRekapJawaban').html(data);
            var NotifikasiRekapJawabanBerhasil=$('#NotifikasiRekapJawabanBerhasil').html();
            if(NotifikasiRekapJawabanBerhasil=="Success"){
                location.reload();
            }
        }
    });
});