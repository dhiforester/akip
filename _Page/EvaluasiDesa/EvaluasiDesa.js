//Fungsi Menampilkan Data
function showEvaluasiDesa() {
    $('#MenampilkanTabelEvaluasiDesa').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/EvaluasiDesa/TabelEvaluasiDesa.php',
        success: function(data) {
            $('#MenampilkanTabelEvaluasiDesa').html(data);
        }
    });
}
function showAngketEvaluasi() {
    var id_evaluasi=$('#GetIdEvaluasi').val();
    var id_wilayah=$('#GetIdWilayah').val();
    $('#TabelAngketEvaluasi').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/EvaluasiDesa/TabelAngketEvaluasi.php',
        data    : {id_evaluasi: id_evaluasi, id_wilayah: id_wilayah},
        success: function(data) {
            $('#TabelAngketEvaluasi').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    showEvaluasiDesa();
    showAngketEvaluasi();
});
//Modal Upload Draft
$('#ModalUploadDraft').on('show.bs.modal', function (e) {
    var GetUploadDraft = $(e.relatedTarget).data('id');
    $('#FormUploadDraft').html("Loading...");
    $('#NotifikasiUploadDraft').html('<code class="text-primary">Pastikan File Yang Anda Upload Sudah Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormUploadDraft.php',
        data        : {GetUploadDraft: GetUploadDraft},
        success     : function(data){
            $('#FormUploadDraft').html(data);
        }
    });
});
//Proses Upload Draft
$('#ProsesUploadDraft').submit(function(){
    $('#NotifikasiUploadDraft').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadDraft')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesUploadDraft.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadDraft').html(data);
            var NotifikasiUploadDraftBerhasil=$('#NotifikasiUploadDraftBerhasil').html();
            if(NotifikasiUploadDraftBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal View Document
$('#ModalViewLampiran').on('show.bs.modal', function (e) {
    var id_file_store = $(e.relatedTarget).data('id');
    $('#FormViewLampiran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormViewLampiran.php',
        data        : {id_file_store: id_file_store},
        success     : function(data){
            $('#FormViewLampiran').html(data);
        }
    });
});
//Modal Hapus Draft
$('#ModalHapusDraft').on('show.bs.modal', function (e) {
    var id_file_store = $(e.relatedTarget).data('id');
    $('#FormHapusDraft').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormHapusDraft.php',
        data        : {id_file_store: id_file_store},
        success     : function(data){
            $('#FormHapusDraft').html(data);
        }
    });
});
//Proses Hapus Draft
$('#ProsesHapusDraft').submit(function(){
    $('#NotifikasiHapusDraft').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusDraft')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesHapusDraft.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusDraft').html(data);
            var NotifikasiHapusDraftBerhasil=$('#NotifikasiHapusDraftBerhasil').html();
            if(NotifikasiHapusDraftBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Upload Draft
$('#ModalEditDraft').on('show.bs.modal', function (e) {
    var id_file_store = $(e.relatedTarget).data('id');
    $('#FormEditDraft').html("Loading...");
    $('#NotifikasiEditDraft').html('<code class="text-primary">Pastikan File Yang Anda Upload Sudah Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormEditDraft.php',
        data        : {id_file_store: id_file_store},
        success     : function(data){
            $('#FormEditDraft').html(data);
        }
    });
});
//Proses Hapus Draft
$('#ProsesEditDraft').submit(function(){
    $('#NotifikasiEditDraft').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditDraft')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesEditDraft.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditDraft').html(data);
            var NotifikasiEditDraftBerhasil=$('#NotifikasiEditDraftBerhasil').html();
            if(NotifikasiEditDraftBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Kirim Jawaban
$('#ModalKirimJawaban').on('show.bs.modal', function (e) {
    var ParameterJawaban = $(e.relatedTarget).data('id');
    $('#FormKirimJawaban').html("Loading...");
    $('#NotifikasiKirimJawaban').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormKirimJawaban.php',
        data        : {ParameterJawaban: ParameterJawaban},
        success     : function(data){
            $('#FormKirimJawaban').html(data);
        }
    });
});
//Proses Edit Kriteria Dan Indikator
$('#ProsesKirimJawaban').submit(function(){
    $('#NotifikasiKirimJawaban').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKirimJawaban')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesKirimJawaban.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKirimJawaban').html(data);
            var NotifikasiKirimJawabanBerhasil=$('#NotifikasiKirimJawabanBerhasil').html();
            if(NotifikasiKirimJawabanBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Konfirmasi Desa
$('#ModalKonfirmasiDesa').on('show.bs.modal', function (e) {
    var ParameterJawaban = $(e.relatedTarget).data('id');
    $('#FormKonfirmasiDesa').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormKonfirmasiDesa.php',
        data        : {ParameterJawaban: ParameterJawaban},
        success     : function(data){
            $('#FormKonfirmasiDesa').html(data);
        }
    });
});
//Proses Edit Kriteria Dan Indikator
$('#ProsesKonfirmasiDesa').submit(function(){
    $('#NotifikasiKonfirmasiDesa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKonfirmasiDesa')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesKonfirmasiDesa.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKonfirmasiDesa').html(data);
            var NotifikasiKonfirmasiDesaBerhasil=$('#NotifikasiKonfirmasiDesaBerhasil').html();
            if(NotifikasiKonfirmasiDesaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Upload Lampiran
$('#ModalUploadLampiran').on('show.bs.modal', function (e) {
    var ParameterFile = $(e.relatedTarget).data('id');
    $('#FormUploadLampiran').html("Loading...");
    $('#NotifikasiUploadLampiran').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormUploadLampiran.php',
        data        : {ParameterJawaban: ParameterFile},
        success     : function(data){
            $('#FormUploadLampiran').html(data);
        }
    });
});
//Proses Edit Kriteria Dan Indikator
$('#ProsesUploadLampiran').submit(function(){
    $('#NotifikasiUploadLampiran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadLampiran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesUploadLampiran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadLampiran').html(data);
            var NotifikasiUploadLampiranBerhasil=$('#NotifikasiUploadLampiranBerhasil').html();
            if(NotifikasiUploadLampiranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Detail Lampiran
$('#ModalDetailBukti').on('show.bs.modal', function (e) {
    var ParameterFile = $(e.relatedTarget).data('id');
    $('#FormDetailBukti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormDetailBukti.php',
        data        : {ParameterFile: ParameterFile},
        success     : function(data){
            $('#FormDetailBukti').html(data);
        }
    });
});
//Modal Hapus Lampiran
$('#ModalHapusBukti').on('show.bs.modal', function (e) {
    var ParameterFile = $(e.relatedTarget).data('id');
    $('#FormHapusBukti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormHapusBukti.php',
        data        : {ParameterFile: ParameterFile},
        success     : function(data){
            $('#FormHapusBukti').html(data);
        }
    });
});
//Proses Hapus File Bukti
$('#ProsesHapusBukti').submit(function(){
    $('#NotifikasiHapusBukti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusBukti')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesHapusBukti.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusBukti').html(data);
            var NotifikasiHapusBuktiBerhasil=$('#NotifikasiHapusBuktiBerhasil').html();
            if(NotifikasiHapusBuktiBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Buka Kunci
$('#ModalBukaKunci').on('show.bs.modal', function (e) {
    var id_file_store = $(e.relatedTarget).data('id');
    $('#FormBukaKunci').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormBukaKunci.php',
        data        : {id_file_store: id_file_store},
        success     : function(data){
            $('#FormBukaKunci').html(data);
            $('#NotifikasiBukaKunci').html('<code class="primary">Apakah anda yakin akan membuka file lampiran/dokumen ini?</code>');
        }
    });
});
//Proses buka Kunci
$('#ProsesBukaKunci').submit(function(){
    $('#NotifikasiBukaKunci').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesBukaKunci')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesBukaKunci.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiBukaKunci').html(data);
            var NotifikasiBukaKunciBerhasil=$('#NotifikasiBukaKunciBerhasil').html();
            if(NotifikasiBukaKunciBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Tutup Kunci
$('#ModalTutupKunci').on('show.bs.modal', function (e) {
    var id_file_store = $(e.relatedTarget).data('id');
    $('#FormTutupKunci').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormTutupKunci.php',
        data        : {id_file_store: id_file_store},
        success     : function(data){
            $('#FormTutupKunci').html(data);
            $('#NotifikasiTutupKunci').html('<code class="primary">Apakah anda yakin akan menutup (Mengunci) file lampiran/dokumen ini?</code>');
        }
    });
});
//Proses Tutup Kunci
$('#ProsesTutupKunci').submit(function(){
    $('#NotifikasiTutupKunci').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTutupKunci')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesTutupKunci.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTutupKunci').html(data);
            var NotifikasiTutupKunciBerhasil=$('#NotifikasiTutupKunciBerhasil').html();
            if(NotifikasiTutupKunciBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Rekapitulasi Data
$('#ModalRekapEvaluasi').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    $('#FormRekapEvaluasi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/FormRekapEvaluasi.php',
        data        : {GetData: GetData},
        success     : function(data){
            $('#FormRekapEvaluasi').html(data);
            $('#NotifikasiRekapEvaluasi').html('<b class="text-primary">Apakah anda yakin akan melakukan rekapitulasi untuk dataset ini?</b>');
        }
    });
});
//Proses Rekam Semua
$('#ProsesRekapEvaluasi').submit(function(){
    $('#NotifikasiRekapEvaluasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesRekapEvaluasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EvaluasiDesa/ProsesRekapEvaluasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiRekapEvaluasi').html(data);
            var NotifikasiRekapEvaluasiBerhasil=$('#NotifikasiRekapEvaluasiBerhasil').html();
            if(NotifikasiRekapEvaluasiBerhasil=="Success"){
                location.reload();
            }
        }
    });
});