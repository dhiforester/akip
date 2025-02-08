//Ketika Modal Tambah Apbdes Muncul
$('#ModalTambahApbdes').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormTambahApbdes').html("Loading...");
    $('#NotifikasiTambahApbdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormTambahApbdes.php',
        data        :   {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormTambahApbdes').html(data);
        }
    });
});
//Proses Tambah Apbdes
$('#ProsesTambahApbdes').submit(function(){
    $('#NotifikasiTambahApbdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahApbdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/ProsesTambahApbdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahApbdes').html(data);
            var NotifikasiTambahApbdesBerhasil=$('#NotifikasiTambahApbdesBerhasil').html();
            if(NotifikasiTambahApbdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal View Dokumen Muncul
$('#ModalViewDokumen').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormLihatDokumenApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormLihatDokumenApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormLihatDokumenApbdes').html(data);
        }
    });
});
//Ketika Modal Edit Apbdes Muncul
$('#ModalEditApbdes').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormEditApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormEditApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormEditApbdes').html(data);
            $('#NotifikasiEditApbdes').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
        }
    });
});
//Proses Edit Apbdes
$('#ProsesEditApbdes').submit(function(){
    $('#NotifikasiEditApbdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditApbdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/ProsesEditApbdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditApbdes').html(data);
            var NotifikasiEditApbdesBerhasil=$('#NotifikasiEditApbdesBerhasil').html();
            if(NotifikasiEditApbdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Upload Ulang File Apbdes
$('#ModalUploadUlangApbdes').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormUploadUlangApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormUploadUlangApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormUploadUlangApbdes').html(data);
            $('#NotifikasiUploadUlangApbdes').html('<code class="text-primary">Pastikan bahwa file yang anda upload sudah benar</code>');
        }
    });
});
//Proses Upload Ulang File Apbdes
$('#ProsesUploadUlangApbdes').submit(function(){
    $('#NotifikasiUploadUlangApbdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUploadUlangApbdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/ProsesUploadUlangApbdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadUlangApbdes').html(data);
            var NotifikasiUploadUlangApbdesBerhasil=$('#NotifikasiUploadUlangApbdesBerhasil').html();
            if(NotifikasiUploadUlangApbdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Kirim Apbdes Muncul
$('#ModalKirimApbdes').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormKirimApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormKirimApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormKirimApbdes').html(data);
            $('#NotifikasiKirimApbdes').html('<code class="text-primary">Apakah Anda Yakin Akan Mengirim Data Apbdes ini?</code>');
        }
    });
});
//Proses Kirim Apbdes
$('#ProsesKirimApbdes').submit(function(){
    $('#NotifikasiKirimApbdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesKirimApbdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/ProsesKirimApbdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiKirimApbdes').html(data);
            var NotifikasiKirimApbdesBerhasil=$('#NotifikasiKirimApbdesBerhasil').html();
            if(NotifikasiKirimApbdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Hapus Apbdes Muncul
$('#ModalHapusApbdes').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormHapusApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormHapusApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormHapusApbdes').html(data);
            $('#NotifikasiHapusApbdes').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
        }
    });
});
//Proses Hapus Apbdes
$('#ProsesHapusApbdes').submit(function(){
    $('#NotifikasiHapusApbdes').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusApbdes')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/ProsesHapusApbdes.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusApbdes').html(data);
            var NotifikasiHapusApbdesBerhasil=$('#NotifikasiHapusApbdesBerhasil').html();
            if(NotifikasiHapusApbdesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Ketika Modal Download Template Apbdes Muncul
$('#ModalDownloadTemplateApbdes').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormDownloadTemplateApbdes').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormDownloadTemplateApbdes.php',
        data        :   {id_apbdes: id_apbdes},
        success     : function(data){
            $('#FormDownloadTemplateApbdes').html(data);
            $('#NotifikasiDownloadTemplateApbdes').html('<code class="text-primary">Apakah Anda Yakin Ingin Mendownload Data Template Apbdes ini?</code>');
        }
    });
});
//Ketika Modal Import Data RPJMDES Muncul
$('#ModalUploadDataset').on('show.bs.modal', function (e) {
    var id_apbdes = $(e.relatedTarget).data('id');
    $('#FormUploadDataset').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/APBDES/FormImportApbdes.php',
        data        :   {id_apbdes: id_apbdes},
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
        url 	    : '_Page/APBDES/ProsesUploadDataset.php',
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
//Menampilkan Rincian Apbdes Untuk Pertama Kali
var GetIdApbdes =$('#GetIdApbdes').val();
$('#MenampilkanDatasetApbdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/APBDES/TabelRincianApbdes.php',
    data 	    :  {GetIdApbdes: GetIdApbdes},
    success     : function(data){
        $('#MenampilkanDatasetApbdes').html(data);
    }
});