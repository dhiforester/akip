//Ketika Modal Tambah Perjanjian Kinerja Muncul
$('#ModalTambahPerjanjianKinerja').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormTambahPerjanjianKinerja').html("Loading...");
    $('#NotifikasiTambahPerjanjianKinerja').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormTambahPerjanjianKinerja.php',
        data        :   {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormTambahPerjanjianKinerja').html(data);
        }
    });
});
//Proses Tambah Perjanjian Kinerja
$('#ProsesTambahPerjanjianKinerja').submit(function(){
    $('#NotifikasiTambahPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesTambahPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahPerjanjianKinerja').html(data);
            var NotifikasiTambahPerjanjianKinerjaBerhasil=$('#NotifikasiTambahPerjanjianKinerjaBerhasil').html();
            if(NotifikasiTambahPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal View Dokumen Muncul
$('#ModalViewDokumen').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormViewDokumen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormViewDokumen.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormViewDokumen').html(data);
        }
    });
});
//Ketika Modal Edit Perjanjian Kinerja Muncul
$('#ModalEditPerjanjianKinerja').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormEditPerjanjianKinerja').html("Loading...");
    $('#NotifikasiEditPerjanjianKinerja').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormEditPerjanjianKinerja.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormEditPerjanjianKinerja').html(data);
        }
    });
});
//Proses Edit Perjanjian Kinerja
$('#ProsesEditPerjanjianKinerja').submit(function(){
    $('#NotifikasiEditPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesEditPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPerjanjianKinerja').html(data);
            var NotifikasiEditPerjanjianKinerjaBerhasil=$('#NotifikasiEditPerjanjianKinerjaBerhasil').html();
            if(NotifikasiEditPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Edit PerjanjianKinerja Muncul
$('#ModalEditPerjanjianKinerja').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormEditPerjanjianKinerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormEditPerjanjianKinerja.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormEditPerjanjianKinerja').html(data);
            $('#NotifikasiEditPerjanjianKinerja').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
        }
    });
});
//Proses Edit PerjanjianKinerja
$('#ProsesEditPerjanjianKinerja').submit(function(){
    $('#NotifikasiEditPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesEditPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPerjanjianKinerja').html(data);
            var NotifikasiEditPerjanjianKinerjaBerhasil=$('#NotifikasiEditPerjanjianKinerjaBerhasil').html();
            if(NotifikasiEditPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Upload Ulang File PerjanjianKinerja
$('#ModalUploadUlangDokumen').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormUploadUlangPerjanjianKinerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormUploadUlangPerjanjianKinerja.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormUploadUlangPerjanjianKinerja').html(data);
            $('#NotifikasiUploadUlangPerjanjianKinerja').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Upload Ulang File PerjanjianKinerja
$('#ProsesUploadUlangPerjanjianKinerja').submit(function(){
    $('#NotifikasiUploadUlangPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadUlangPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesUploadUlangPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadUlangPerjanjianKinerja').html(data);
            var NotifikasiUploadUlangPerjanjianKinerjaBerhasil=$('#NotifikasiUploadUlangPerjanjianKinerjaBerhasil').html();
            if(NotifikasiUploadUlangPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Tambah Sasaran Dan Target
$('#ModalTambahSasaranTarget').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormTambahSasaranTarget').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormTambahSasaranTarget.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormTambahSasaranTarget').html(data);
            $('#NotifikasiUploadUlangPerjanjianKinerja').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Tambah Sasaran Dan Target
$('#ProsesTambahSasaranTarget').submit(function(){
    $('#NotifikasiTambahSasaranTarget').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahSasaranTarget')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesTambahSasaranTarget.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahSasaranTarget').html(data);
            var NotifikasiTambahSasaranTargetBerhasil=$('#NotifikasiTambahSasaranTargetBerhasil').html();
            if(NotifikasiTambahSasaranTargetBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Edit Sasaran Dan Target
$('#ModalEditSasaran').on('show.bs.modal', function (e) {
    var id_perjanjian_sasaran = $(e.relatedTarget).data('id');
    $('#FormEditSasaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormEditSasaran.php',
        data        :   {id_perjanjian_sasaran: id_perjanjian_sasaran},
        success     : function(data){
            $('#FormEditSasaran').html(data);
            $('#NotifikasiEditSasaran').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Edit Sasaran Dan Target
$('#ProsesEditSasaran').submit(function(){
    $('#NotifikasiEditSasaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditSasaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesEditSasaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditSasaran').html(data);
            var NotifikasiEditSasaranBerhasil=$('#NotifikasiEditSasaranBerhasil').html();
            if(NotifikasiEditSasaranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Hapus Sasaran Dan Target
$('#ModalHapusSasaran').on('show.bs.modal', function (e) {
    var id_perjanjian_sasaran = $(e.relatedTarget).data('id');
    $('#FormHapusSasaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormHapusSasaran.php',
        data        :   {id_perjanjian_sasaran: id_perjanjian_sasaran},
        success     : function(data){
            $('#FormHapusSasaran').html(data);
            $('#NotifikasiHapusSasaran').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
        }
    });
});
//Proses Hapus Sasaran Dan Target
$('#ProsesHapusSasaran').submit(function(){
    $('#NotifikasiHapusSasaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusSasaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesHapusSasaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusSasaran').html(data);
            var NotifikasiHapusSasaranBerhasil=$('#NotifikasiHapusSasaranBerhasil').html();
            if(NotifikasiHapusSasaranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Kirim PerjanjianKinerja Muncul
$('#ModalKirimBerkas').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormKirimPerjanjianKinerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormKirimPerjanjianKinerja.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormKirimPerjanjianKinerja').html(data);
            $('#NotifikasiKirimPerjanjianKinerja').html('<code class="text-primary">Apakah Anda Yakin Akan Mengirim Data PerjanjianKinerja ini?</code>');
        }
    });
});
//Proses Kirim PerjanjianKinerja
$('#ProsesKirimPerjanjianKinerja').submit(function(){
    $('#NotifikasiKirimPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKirimPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesKirimPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKirimPerjanjianKinerja').html(data);
            var NotifikasiKirimPerjanjianKinerjaBerhasil=$('#NotifikasiKirimPerjanjianKinerjaBerhasil').html();
            if(NotifikasiKirimPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Hapus PerjanjianKinerja Muncul
$('#ModalHapusPerjanjianKinerja').on('show.bs.modal', function (e) {
    var id_perjanjian_kinerja = $(e.relatedTarget).data('id');
    $('#FormHapusPerjanjianKinerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormHapusPerjanjianKinerja.php',
        data        :   {id_perjanjian_kinerja: id_perjanjian_kinerja},
        success     : function(data){
            $('#FormHapusPerjanjianKinerja').html(data);
            $('#NotifikasiHapusPerjanjianKinerja').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
        }
    });
});
//Proses Hapus PerjanjianKinerja
$('#ProsesHapusPerjanjianKinerja').submit(function(){
    $('#NotifikasiHapusPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesHapusPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusPerjanjianKinerja').html(data);
            var NotifikasiHapusPerjanjianKinerjaBerhasil=$('#NotifikasiHapusPerjanjianKinerjaBerhasil').html();
            if(NotifikasiHapusPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Kirim PerjanjianKinerja Muncul
$('#ModalTambahKkMiskin').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormTambahKkMiskin').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/FormTambahKkMiskin.php',
        data        :   {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormTambahKkMiskin').html(data);
            $('#NotifikasiTambahKkMiskin').html('<b class="text-primary">Pastkan data yang anda input sudah benar.</b>');
        }
    });
});
//Proses Hapus PerjanjianKinerja
$('#ProsesHapusPerjanjianKinerja').submit(function(){
    $('#NotifikasiHapusPerjanjianKinerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusPerjanjianKinerja')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PerjanjianKinerja/ProsesHapusPerjanjianKinerja.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusPerjanjianKinerja').html(data);
            var NotifikasiHapusPerjanjianKinerjaBerhasil=$('#NotifikasiHapusPerjanjianKinerjaBerhasil').html();
            if(NotifikasiHapusPerjanjianKinerjaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});