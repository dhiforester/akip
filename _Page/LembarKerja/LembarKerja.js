//Tambah KK Miskin
$('#ModalTambahKkMiskin').on('show.bs.modal', function (e) {
    var id_evaluasi = $(e.relatedTarget).data('id');
    $('#FormTambahKkMiskin').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormTambahKkMiskin.php',
        data        :   {id_evaluasi: id_evaluasi},
        success     : function(data){
            $('#FormTambahKkMiskin').html(data);
            $('#NotifikasiTambahKkMiskin').html('<b class="text-primary">Pastkan data yang anda input sudah benar.</b>');
        }
    });
});
//Proses Hapus PerjanjianKinerja
$('#ProsesTambahKkMiskin').submit(function(){
    $('#NotifikasiTambahKkMiskin').html('<b class="text-primary">Loading...</b>');
    var form = $('#ProsesTambahKkMiskin')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/ProsesTambahKkMiskin.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahKkMiskin').html(data);
            var NotifikasiTambahKkMiskinBerhasil=$('#NotifikasiTambahKkMiskinBerhasil').html();
            if(NotifikasiTambahKkMiskinBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
$('#ModalLihatDokumen').on('show.bs.modal', function (e) {
    var id_capaian = $(e.relatedTarget).data('id');
    $('#FormLihatDokumen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormLihatDokumen.php',
        data        :   {id_capaian: id_capaian},
        success     : function(data){
            $('#FormLihatDokumen').html(data);
        }
    });
});
//Hapus 
$('#ModalHapusIndikator').on('show.bs.modal', function (e) {
    var id_capaian = $(e.relatedTarget).data('id');
    $('#FormHapusIndikator').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormHapusIndikator.php',
        data        :   {id_capaian: id_capaian},
        success     : function(data){
            $('#FormHapusIndikator').html(data);
            $('#NotifikasiHapusIndikator').html('<b class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</b>');
        }
    });
});
//Proses Hapus
$('#ProsesHapusIndikator').submit(function(){
    $('#NotifikasiHapusIndikator').html('<b class="text-primary">Loading...</b>');
    var form = $('#ProsesHapusIndikator')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/ProsesHapusIndikator.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusIndikator').html(data);
            var NotifikasiHapusIndikatorBerhasil=$('#NotifikasiHapusIndikatorBerhasil').html();
            if(NotifikasiHapusIndikatorBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
$('#ModalUploadUlangDokumen').on('show.bs.modal', function (e) {
    var id_capaian = $(e.relatedTarget).data('id');
    $('#FormUploadUlangDokumen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormUploadUlangDokumen.php',
        data        :   {id_capaian: id_capaian},
        success     : function(data){
            $('#FormUploadUlangDokumen').html(data);
            $('#NotifikasiUploadUlangDokumen').html('<b class="text-primary">Pastkan file yang anda upload sudah sesuai.</b>');
        }
    });
});
//Proses Hapus
$('#ProsesUploadUlangDokumen').submit(function(){
    $('#NotifikasiUploadUlangDokumen').html('<b class="text-primary">Loading...</b>');
    var form = $('#ProsesUploadUlangDokumen')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/ProsesUploadUlangDokumen.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUploadUlangDokumen').html(data);
            var NotifikasiUploadUlangDokumenBerhasil=$('#NotifikasiUploadUlangDokumenBerhasil').html();
            if(NotifikasiUploadUlangDokumenBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
$('#ModalEditCapaian').on('show.bs.modal', function (e) {
    var id_capaian = $(e.relatedTarget).data('id');
    $('#FormEditCapaian').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormEditCapaian.php',
        data        :   {id_capaian: id_capaian},
        success     : function(data){
            $('#FormEditCapaian').html(data);
            $('#NotifikasiEditCapaian').html('<b class="text-primary">Pastkan data yang anda input sudah sesuai.</b>');
        }
    });
});
//Proses Edit
$('#ProsesEditCapaian').submit(function(){
    $('#NotifikasiEditCapaian').html('<b class="text-primary">Loading...</b>');
    var form = $('#ProsesEditCapaian')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/ProsesEditCapaian.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditCapaian').html(data);
            var NotifikasiEditCapaianBerhasil=$('#NotifikasiEditCapaianBerhasil').html();
            if(NotifikasiEditCapaianBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
$('#ModalUpdateStatus').on('show.bs.modal', function (e) {
    var id_capaian = $(e.relatedTarget).data('id');
    $('#FormUpdateStatus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/FormUpdateStatus.php',
        data        :   {id_capaian: id_capaian},
        success     : function(data){
            $('#FormUpdateStatus').html(data);
            $('#NotifikasiUpdateStatus').html('<b class="text-primary">Pastkan data yang anda input sudah sesuai.</b>');
        }
    });
});
$('#ProsesUpdateStatus').submit(function(){
    $('#NotifikasiUpdateStatus').html('<b class="text-primary">Loading...</b>');
    var form = $('#ProsesUpdateStatus')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LembarKerja/ProsesUpdateStatus.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUpdateStatus').html(data);
            var NotifikasiUpdateStatusBerhasil=$('#NotifikasiUpdateStatusBerhasil').html();
            if(NotifikasiUpdateStatusBerhasil=="Success"){
                location.reload();
            }
        }
    });
});