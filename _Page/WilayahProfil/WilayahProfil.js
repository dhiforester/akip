//Fungsi Menampilkan Data
function ShowIdentitasWilayah() {
    $('#FormDetailIdentitasWilayah').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/WilayahProfil/FormDetailIdentitasWilayah.php',
        success: function(data) {
            $('#FormDetailIdentitasWilayah').html(data);
        }
    });
}
function ShowIStrukturOrganisasi() {
    $('#MenampilkanStrukturOrganisasi').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/WilayahProfil/TabelStrukturOrganisasi.php',
        success: function(data) {
            $('#MenampilkanStrukturOrganisasi').html(data);
        }
    });
}
function ShowDemografi() {
    $('#MenampilkanTabelDemografi').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/WilayahProfil/TabelDemografi.php',
        success: function(data) {
            $('#MenampilkanTabelDemografi').html(data);
        }
    });
}
function ShowCapaianTargetWilayah() {
    $('#MenampilkanTabelCapaianTarget').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/WilayahProfil/TabelCapaianTarget.php',
        success: function(data) {
            $('#MenampilkanTabelCapaianTarget').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    ShowIdentitasWilayah();
    ShowIStrukturOrganisasi();
    ShowDemografi();
    ShowCapaianTargetWilayah();
});
//Ketika Muncul Modal Update Identitas Wilayah
$('#ModalUpdateIdentitasWilayah').on('show.bs.modal', function (e) {
    $('#NotifikasiUpdateIdentitasWilayah').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormUpdateIdentitasWilayah').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormUpdateIdentitasWilayah.php',
        success     : function(data){
            $('#FormUpdateIdentitasWilayah').html(data);
        }
    });
});
//Proses Tambah Akses
$('#ProsesUpdateIdentitasWilayah').submit(function(){
    $('#NotifikasiUpdateIdentitasWilayah').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUpdateIdentitasWilayah')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesUpdateIdentitasWilayah.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUpdateIdentitasWilayah').html(data);
            var NotifikasiUpdateIdentitasWilayahBerhasil=$('#NotifikasiUpdateIdentitasWilayahBerhasil').html();
            if(NotifikasiUpdateIdentitasWilayahBerhasil=="Success"){
                $('#ModalUpdateIdentitasWilayah').modal('hide');
                swal("Success!", "Update Profil Wilayah Berhasil!", "success");
                //Menampilkan Data
                ShowIdentitasWilayah();
            }
        }
    });
});
//Ketika Muncul Modal Tambah Struktur Organisasi
$('#ModalTambahStrukturOrganisasi').on('show.bs.modal', function (e) {
    $('#NotifikasiTambahStrukturOrganisasi').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormTambahStrukturOrganisasi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormTambahStrukturOrganisasi.php',
        success     : function(data){
            $('#FormTambahStrukturOrganisasi').html(data);
        }
    });
});
//Proses Tambah Akses
$('#ProsesTambahStrukturOrganisasi').submit(function(){
    $('#NotifikasiTambahStrukturOrganisasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahStrukturOrganisasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesTambahStrukturOrganisasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahStrukturOrganisasi').html(data);
            var NotifikasiTambahStrukturOrganisasiBerhasil=$('#NotifikasiTambahStrukturOrganisasiBerhasil').html();
            if(NotifikasiTambahStrukturOrganisasiBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Ketika Muncul Modal Edit Struktur Organisasi
$('#ModalEditStrukturOrganisasi').on('show.bs.modal', function (e) {
    var id_struktur_organisasi = $(e.relatedTarget).data('id');
    $('#NotifikasiEditStrukturOrganisasi').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormEditStrukturOrganisasi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormEditStrukturOrganisasi.php',
        data        : {id_struktur_organisasi: id_struktur_organisasi},
        success     : function(data){
            $('#FormEditStrukturOrganisasi').html(data);
        }
    });
});
//Proses Edit Akses
$('#ProsesEditStrukturOrganisasi').submit(function(){
    $('#NotifikasiEditStrukturOrganisasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditStrukturOrganisasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesEditStrukturOrganisasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditStrukturOrganisasi').html(data);
            var NotifikasiEditStrukturOrganisasiBerhasil=$('#NotifikasiEditStrukturOrganisasiBerhasil').html();
            if(NotifikasiEditStrukturOrganisasiBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Ketika Muncul Modal Hapus Struktur Organisasi
$('#ModalHapusStrukturOrganisasi').on('show.bs.modal', function (e) {
    var id_struktur_organisasi = $(e.relatedTarget).data('id');
    $('#NotifikasiHapusStrukturOrganisasi').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data tersebut?</code>');
    $('#FormHapusStrukturOrganisasi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormHapusStrukturOrganisasi.php',
        data        : {id_struktur_organisasi: id_struktur_organisasi},
        success     : function(data){
            $('#FormHapusStrukturOrganisasi').html(data);
        }
    });
});
//Proses Hapus Struktur Organisasi
$('#ProsesHapusStrukturOrganisasi').submit(function(){
    $('#NotifikasiHapusStrukturOrganisasi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusStrukturOrganisasi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesHapusStrukturOrganisasi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusStrukturOrganisasi').html(data);
            var NotifikasiHapusStrukturOrganisasiBerhasil=$('#NotifikasiHapusStrukturOrganisasiBerhasil').html();
            if(NotifikasiHapusStrukturOrganisasiBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Ketika Muncul Modal Tambah Demografi
$("#add_form_sarana").click(function() {
    $("#FormContainer").append('<div class="input-group mb-3"><input type="text" name="nama_sarana[]" class="form-control" placeholder="Sarana"><input type="text" name="unit_sarana[]" class="form-control" placeholder="Unit"><input type="number" name="jumlah_sarana[]" class="form-control" placeholder="Jumlah"><button type="button" class="btn btn-sm btn-danger remove"><i class="bi bi-x"></i></button></div>');
});
$(document).on("click", ".remove", function() {
    $(this).parent().remove();
});
//Proses Tambah Demografi
$('#ProsesTambahDemografi').submit(function(){
    $('#NotifikasiTambahDemografi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahDemografi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesTambahDemografi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahDemografi').html(data);
            var NotifikasiTambahDemografiBerhasil=$('#NotifikasiTambahDemografiBerhasil').html();
            if(NotifikasiTambahDemografiBerhasil=="Success"){
                window.location.href='';
            }
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
//Ketika Muncul Modal Edit Demografi
$('#ModalEditDemografi').on('show.bs.modal', function (e) {
    var id_wilayah_demografi = $(e.relatedTarget).data('id');
    $('#NotifikasiEditDemografi').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</code>');
    $('#FormEditDemografi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormEditDemografi.php',
        data        : {id_wilayah_demografi: id_wilayah_demografi},
        success     : function(data){
            $('#FormEditDemografi').html(data);
        }
    });
});
//Proses Edit Demografi
$('#ProsesEditDemografi').submit(function(){
    $('#NotifikasiEditDemografi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditDemografi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesEditDemografi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditDemografi').html(data);
            var NotifikasiEditDemografiBerhasil=$('#NotifikasiEditDemografiBerhasil').html();
            if(NotifikasiEditDemografiBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Ketika Muncul Modal Hapus Demografi
$('#ModalHapusDemografi').on('show.bs.modal', function (e) {
    var id_wilayah_demografi = $(e.relatedTarget).data('id');
    $('#NotifikasiHapusDemografi').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data tersebut?</code>');
    $('#FormHapusDemografi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormHapusDemografi.php',
        data        : {id_wilayah_demografi: id_wilayah_demografi},
        success     : function(data){
            $('#FormHapusDemografi').html(data);
        }
    });
});
//Proses Hapus Demografi
$('#ProsesHapusDemografi').submit(function(){
    $('#NotifikasiHapusDemografi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusDemografi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesHapusDemografi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusDemografi').html(data);
            var NotifikasiHapusDemografiBerhasil=$('#NotifikasiHapusDemografiBerhasil').html();
            if(NotifikasiHapusDemografiBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Proses Tambah Capaian Target
$('#ProsesTambahCapaianTarget').submit(function(){
    $('#NotifikasiTambahCapaianTarget').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahCapaianTarget')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesTambahCapaianTarget.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahCapaianTarget').html(data);
            var NotifikasiTambahCapaianTargetBerhasil=$('#NotifikasiTambahCapaianTargetBerhasil').html();
            if(NotifikasiTambahCapaianTargetBerhasil=="Success"){
                window.location.href='';
            }
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
//Ketika Muncul Modal Edit Capaian target
$('#ModalEditCapaianTarget').on('show.bs.modal', function (e) {
    var id_target_capaian = $(e.relatedTarget).data('id');
    $('#NotifikasiEditCapaianTarget').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</code>');
    $('#FormEditCapaianTarget').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormEditCapaianTarget.php',
        data        : {id_target_capaian: id_target_capaian},
        success     : function(data){
            $('#FormEditCapaianTarget').html(data);
        }
    });
});
//Proses Edit Capaian Target
$('#ProsesEditCapaianTarget').submit(function(){
    $('#NotifikasiEditCapaianTarget').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditCapaianTarget')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesEditCapaianTarget.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditCapaianTarget').html(data);
            var NotifikasiEditCapaianTargetBerhasil=$('#NotifikasiEditCapaianTargetBerhasil').html();
            if(NotifikasiEditCapaianTargetBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});
//Ketika Muncul Modal Hapus Capaian Target
$('#ModalHapusCapaianTarget').on('show.bs.modal', function (e) {
    var id_target_capaian = $(e.relatedTarget).data('id');
    $('#NotifikasiHapusCapaianTarget').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data tersebut?</code>');
    $('#FormHapusCapaianTarget').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/FormHapusCapaianTarget.php',
        data        : {id_target_capaian: id_target_capaian},
        success     : function(data){
            $('#FormHapusCapaianTarget').html(data);
        }
    });
});
//Proses Hapus Capaian Target
$('#ProsesHapusCapaianTarget').submit(function(){
    $('#NotifikasiHapusCapaianTarget').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusCapaianTarget')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WilayahProfil/ProsesHapusCapaianTarget.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusCapaianTarget').html(data);
            var NotifikasiHapusCapaianTargetBerhasil=$('#NotifikasiHapusCapaianTargetBerhasil').html();
            if(NotifikasiHapusCapaianTargetBerhasil=="Success"){
                window.location.href='';
            }
        }
    });
});