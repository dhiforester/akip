//Ketika Modal Tambah Rkpdes Muncul
$('#ModalTambahRkpdes').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    $('#FormTambahRkpdes').html("Loading...");
    $('#NotifikasiTambahRkpdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormTambahRkpdes.php',
        data        :   {GetData: GetData},
        success     : function(data){
            $('#FormTambahRkpdes').html(data);
        }
    });
});
//Proses Tambah RKPDES
$('#ProsesTambahRkpdes').submit(function(){
    $('#NotifikasiTambahRkpdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahRkpdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesTambahRkpdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahRkpdes').html(data);
            var NotifikasiTambahRkpdesBerhasil=$('#NotifikasiTambahRkpdesBerhasil').html();
            if(NotifikasiTambahRkpdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal View Dokumen Muncul
$('#ModalViewDokumen').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormLihatDokumenRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormLihatDokumenRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormLihatDokumenRkpdes').html(data);
        }
    });
});
//Ketika Modal Edit Rkpdes Muncul
$('#ModalEditRkpdes').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormEditRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormEditRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormEditRkpdes').html(data);
            $('#NotifikasiEditRkpdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
        }
    });
});
//Proses Edit Rkpdes
$('#ProsesEditRkpdes').submit(function(){
    $('#NotifikasiEditRkpdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditRkpdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesEditRkpdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditRkpdes').html(data);
            var NotifikasiEditRkpdesBerhasil=$('#NotifikasiEditRkpdesBerhasil').html();
            if(NotifikasiEditRkpdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Upload Ulang File Rkpdes
$('#ModalUploadUlangRkpdes').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormUploadUlangRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormUploadUlangRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormUploadUlangRkpdes').html(data);
            $('#NotifikasiUploadUlangRkpdes').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Upload Ulang File Rkpdes
$('#ProsesUploadUlangRkpdes').submit(function(){
    $('#NotifikasiUploadUlangRkpdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadUlangRkpdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesUploadUlangRkpdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadUlangRkpdes').html(data);
            var NotifikasiUploadUlangRkpdesBerhasil=$('#NotifikasiUploadUlangRkpdesBerhasil').html();
            if(NotifikasiUploadUlangRkpdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Kirim Rkpdes Muncul
$('#ModalKirimRkpdes').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormKirimRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormKirimRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormKirimRkpdes').html(data);
            $('#NotifikasiKirimRkpdes').html('<code class="text-primary">Apakah Anda Yakin Akan Mengirim Data RKPDES ini?</code>');
        }
    });
});
//Proses Kirim Rkpdes
$('#ProsesKirimRkpdes').submit(function(){
    $('#NotifikasiKirimRkpdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKirimRkpdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesKirimRkpdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKirimRkpdes').html(data);
            var NotifikasiKirimRkpdesBerhasil=$('#NotifikasiKirimRkpdesBerhasil').html();
            if(NotifikasiKirimRkpdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Hapus Rkpdes Muncul
$('#ModalHapusRkpdes').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormHapusRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormHapusRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormHapusRkpdes').html(data);
            $('#NotifikasiHapusRkpdes').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
        }
    });
});
//Proses Hapus Rkpdes
$('#ProsesHapusRkpdes').submit(function(){
    $('#NotifikasiHapusRkpdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusRkpdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesHapusRkpdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusRkpdes').html(data);
            var NotifikasiHapusRkpdesBerhasil=$('#NotifikasiHapusRkpdesBerhasil').html();
            if(NotifikasiHapusRkpdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Download Template RKPDES Muncul
$('#ModalDownloadTemplate').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormDownloadTemplateRkpdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormDownloadTemplateRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormDownloadTemplateRkpdes').html(data);
            $('#NotifikasiDownloadTemplateRkpdes').html('<code class="text-primary">Apakah Anda Yakin Ingin Mendownload Data Template RKPDES ini?</code>');
        }
    });
});
//Ketika Modal Import Data RPJMDES Muncul
$('#ModalUploadDataset').on('show.bs.modal', function (e) {
    var id_rkpdes = $(e.relatedTarget).data('id');
    $('#FormUploadDataset').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/FormImportRkpdes.php',
        data        :   {id_rkpdes: id_rkpdes},
        success     : function(data){
            $('#FormUploadDataset').html(data);
            $('#NotifikasiUploadDataset').html('<code class="text-primary">Pastikan file yang ingin anda import sudah sesuai!</code>');
        }
    });
});
//Proses Upload Excel RPJMDES
$('#ProsesUploadDataset').submit(function(){
    $('#NotifikasiUploadDataset').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadDataset')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RKPDES/ProsesUploadDataset.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadDataset').html(data);
            var NotifikasiUploadDatasetBerhasil=$('#NotifikasiUploadDatasetBerhasil').html();
            if(NotifikasiUploadDatasetBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Menampilkan Rincian RKPDES Untuk Pertama Kali
var GetIdRkpdes =$('#GetIdRkpdes').val();
$('#MenampilkanDatasetRkpdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/RKPDES/TabelRincianRkpdes.php',
    data 	    :  {GetIdRkpdes: GetIdRkpdes},
    success     : function(data){
        $('#MenampilkanDatasetRkpdes').html(data);
    }
});