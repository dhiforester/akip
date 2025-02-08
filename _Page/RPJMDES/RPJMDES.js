//Ketika Modal Tambah RPJMDES Muncul
$('#ModalTambahRpjmdes').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormTambahRpjmdes').html("Loading...");
    $('#NotifikasiTambahRpjmdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormTambahRpjmdes.php',
        data        :   {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormTambahRpjmdes').html(data);
        }
    });
});
//Proses Tambah RPJMDES
$('#ProsesTambahRpjmdes').submit(function(){
    $('#NotifikasiTambahRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesTambahRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahRpjmdes').html(data);
            var NotifikasiTambahRpjmdesBerhasil=$('#NotifikasiTambahRpjmdesBerhasil').html();
            if(NotifikasiTambahRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal View Dokumen Muncul
$('#ModalViewDokumen').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormLihatDokumenRPjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormLihatDokumenRPjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormLihatDokumenRPjmdes').html(data);
        }
    });
});
//Ketika Modal Edit RPJMDES Muncul
$('#ModalEditRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormEditRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormEditRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormEditRpjmdes').html(data);
            $('#NotifikasiEditRpjmdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
        }
    });
});
//Proses Edit RPJMDES
$('#ProsesEditRpjmdes').submit(function(){
    $('#NotifikasiEditRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesEditRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditRpjmdes').html(data);
            var NotifikasiEditRpjmdesBerhasil=$('#NotifikasiEditRpjmdesBerhasil').html();
            if(NotifikasiEditRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Upload Ulang File RPJMDES
$('#ModalUploadUlangRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormUploadUlangRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormUploadUlangRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormUploadUlangRpjmdes').html(data);
            $('#NotifikasiUploadUlangRpjmdes').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Upload Ulang File RPJMDES
$('#ProsesUploadUlangRpjmdes').submit(function(){
    $('#NotifikasiUploadUlangRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadUlangRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesUploadUlangRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadUlangRpjmdes').html(data);
            var NotifikasiUploadUlangRpjmdesBerhasil=$('#NotifikasiUploadUlangRpjmdesBerhasil').html();
            if(NotifikasiUploadUlangRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Kirim RPJMDES Muncul
$('#ModalKirimRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormKirimRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormKirimRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormKirimRpjmdes').html(data);
            $('#NotifikasiKirimRpjmdes').html('<code class="text-primary">Apakah Anda Yakin Akan Mengirim Data RPJMDES ini?</code>');
        }
    });
});
//Proses Kirim RPJMDES
$('#ProsesKirimRpjmdes').submit(function(){
    $('#NotifikasiKirimRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKirimRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesKirimRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKirimRpjmdes').html(data);
            var NotifikasiKirimRpjmdesBerhasil=$('#NotifikasiKirimRpjmdesBerhasil').html();
            if(NotifikasiKirimRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Hapus RPJMDES Muncul
$('#ModalHapusRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormHapusRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormHapusRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormHapusRpjmdes').html(data);
            $('#NotifikasiHapusRpjmdes').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
        }
    });
});
//Proses Hapus RPJMDES
$('#ProsesHapusRpjmdes').submit(function(){
    $('#NotifikasiHapusRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesHapusRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusRpjmdes').html(data);
            var NotifikasiHapusRpjmdesBerhasil=$('#NotifikasiHapusRpjmdesBerhasil').html();
            if(NotifikasiHapusRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Download Template RPJMDES Muncul
$('#ModalDownloadTemplateRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormDownloadTemplateRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormDownloadTemplateRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormDownloadTemplateRpjmdes').html(data);
            $('#NotifikasiDownloadTemplateRpjmdes').html('<code class="text-primary">Apakah Anda Yakin Ingin Mendownload Data Template RPJMDES ini?</code>');
        }
    });
});
//Ketika Modal Import Data RPJMDES Muncul
$('#ModalImportDataRpjmdes').on('show.bs.modal', function (e) {
    var id_rpjmdes = $(e.relatedTarget).data('id');
    $('#FormImportDataRpjmdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/FormImportDataRpjmdes.php',
        data        :   {id_rpjmdes: id_rpjmdes},
        success     : function(data){
            $('#FormImportDataRpjmdes').html(data);
            $('#NotifikasiImportDataRpjmdes').html('<code class="text-primary">Pastikan file yang ingin anda import sudah sesuai!</code>');
        }
    });
});
//Proses Upload Excel RPJMDES
$('#ProsesImportDataRpjmdes').submit(function(){
    $('#NotifikasiImportDataRpjmdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesImportDataRpjmdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RPJMDES/ProsesImportDataRpjmdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiImportDataRpjmdes').html(data);
            var NotifikasiImportDataRpjmdesBerhasil=$('#NotifikasiImportDataRpjmdesBerhasil').html();
            if(NotifikasiImportDataRpjmdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Menampilkan Rincian RPJMDES Untuk Pertama Kali
var GetIdRpjmdes =$('#GetIdRpjmdes').val();
$('#MenampilkanRincianRpjmdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/RPJMDES/TabelRincianRpjmdes.php',
    data 	    :  {GetIdRpjmdes: GetIdRpjmdes},
    success     : function(data){
        $('#MenampilkanRincianRpjmdes').html(data);
    }
});