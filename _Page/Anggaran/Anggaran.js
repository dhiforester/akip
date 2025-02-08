function ShowAnggaran() {
    $('#MenampilkanTabelAnggaran').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Anggaran/TabelAnggaran.php',
        success: function(data) {
            $('#MenampilkanTabelAnggaran').html(data);
        }
    });
}
function ShowRincianAnggaran() {
    var ProsesFilterRincianAnggaran = $('#ProsesFilterRincianAnggaran').serialize();
    $('#MenampilkanTabelRincianAnggaran').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Anggaran/TabelRincianAnggaran.php',
        data    : ProsesFilterRincianAnggaran,
        success: function(data) {
            $('#MenampilkanTabelRincianAnggaran').html(data);
        }
    });
}
function ShowRincianAnggaranRab() {
    var id_anggaran_rincian = $('#id_anggaran_rincian').val();
    $('#MenampilkanTabelRincianAnggaranRab').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Anggaran/TabelRincianAnggaranRab.php',
        data    : {id_anggaran_rincian: id_anggaran_rincian},
        success: function(data) {
            $('#MenampilkanTabelRincianAnggaranRab').html(data);
        }
    });
}
$(document).ready(function() {
    ShowAnggaran();
    ShowRincianAnggaran();
    ShowRincianAnggaranRab();
});
//Proses Tambah Anggaran
$('#tahun_anggaran').change(function(){
    ShowRincianAnggaran();
});
//Proses Tambah Anggaran
$('#ProsesTambahAnggaran').submit(function(){
    $('#NotifikasiTambahAnggaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahAnggaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesTambahAnggaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahAnggaran').html(data);
            var NotifikasiTambahAnggaranBerhasil=$('#NotifikasiTambahAnggaranBerhasil').html();
            if(NotifikasiTambahAnggaranBerhasil=="Success"){
                $('#ModalTambahAnggaran').modal('hide');
                $("#ProsesTambahAnggaran")[0].reset();
                swal("Success!", "Tambah Periode Anggaran Berhasil!", "success");
                //Menampilkan Data
                ShowAnggaran();
            }
        }
    });
});
//Ketika Modal Edit Anggaran
$('#ModalEditAnggaran').on('show.bs.modal', function (e) {
    var id_anggaran = $(e.relatedTarget).data('id');
    $('#FormEditAnggaran').html("Loading...");
    $('#NotifikasiEditAnggaran').html('<code class="text-primary">Apakah anda yakin akan menghapus data tersebut?</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormEditAnggaran.php',
        data        :   {id_anggaran: id_anggaran},
        success     : function(data){
            $('#FormEditAnggaran').html(data);
        }
    });
});
//Proses Edit Anggaran
$('#ProsesEditAnggaran').submit(function(){
    $('#NotifikasiEditAnggaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditAnggaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesEditAnggaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditAnggaran').html(data);
            var NotifikasiEditAnggaranBerhasil=$('#NotifikasiEditAnggaranBerhasil').html();
            if(NotifikasiEditAnggaranBerhasil=="Success"){
                $('#ModalEditAnggaran').modal('hide');
                swal("Success!", "Edit Anggaran Berhasil!", "success");
                //Menampilkan Data
                ShowAnggaran();
            }
        }
    });
});
//Ketika Modal Hapus Anggaran
$('#ModalHapusAnggaran').on('show.bs.modal', function (e) {
    var id_anggaran = $(e.relatedTarget).data('id');
    $('#FormHapusAnggaran').html("Loading...");
    $('#NotifikasiHapusAnggaran').html('<code class="text-primary">Apakah anda yakin akan menghapus data tersebut?</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormHapusAnggaran.php',
        data        :   {id_anggaran: id_anggaran},
        success     : function(data){
            $('#FormHapusAnggaran').html(data);
        }
    });
});
//Proses Hapus Anggaran
$('#ProsesHapusAnggaran').submit(function(){
    $('#NotifikasiHapusAnggaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusAnggaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesHapusAnggaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusAnggaran').html(data);
            var NotifikasiHapusAnggaranBerhasil=$('#NotifikasiHapusAnggaranBerhasil').html();
            if(NotifikasiHapusAnggaranBerhasil=="Success"){
                $('#ModalHapusAnggaran').modal('hide');
                swal("Success!", "Hapus Anggaran Berhasil!", "success");
                //Menampilkan Data
                ShowAnggaran();
            }
        }
    });
});
//Ketika Modal Rincian Anggaran Muncul
$('#ModalTambahRincianAnggaran').on('show.bs.modal', function (e) {
    var tahun_anggaran = $('#tahun_anggaran').val();
    var id_anggaran = $('#id_anggaran').val();
    var id_wilayah = $('#id_wilayah').val();
    //Masukan ke Form
    $('#PutIdAnggaran').val(id_anggaran);
    $('#PutPeriodeTahun').val(tahun_anggaran);
    $('#PutIdWilayah').val(id_wilayah);
    //Menampilkan List Kode Bidang
    $('#kode_bidang').html('<option value="">Loading...</option>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ListKodeBidang.php',
        data        : {id_wilayah: id_wilayah},
        success     : function(data){
            $('#kode_bidang').html(data);
        }
    });
});
//Ketika Kode Bidang Diubah
$('#kode_bidang').change(function(){
    var kode_bidang = $('#kode_bidang').val();
    var id_wilayah = $('#id_wilayah').val();
    $('#kode_sub_bidang').html('<option value="">Loading...</option>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ListKodeSubBidang.php',
        data        : {id_wilayah: id_wilayah, kode_bidang: kode_bidang},
        success     : function(data){
            $('#kode_sub_bidang').html(data);
        }
    });
});
//Ketika Sub Kode Bidang Diubah
$('#kode_sub_bidang').change(function(){
    var kode_sub_bidang = $('#kode_sub_bidang').val();
    var id_wilayah = $('#id_wilayah').val();
    $('#kode_kegiatan').html('<option value="">Loading...</option>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ListKodeKegiatan.php',
        data        : {id_wilayah: id_wilayah, kode_sub_bidang: kode_sub_bidang},
        success     : function(data){
            $('#kode_kegiatan').html(data);
        }
    });
});
//Ketika Modal Detail Rincian Muncul
$('#ModalDetailRincianAnggaran').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#FormDetailRincianAnggaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormDetailRincianAnggaran.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormDetailRincianAnggaran').html(data);
        }
    });
});
//Ketika Modal Edt Rincian Muncul
$('#ModalEditRincianAnggaran').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#FormEditRincianAnggaran').html("Loading...");
    $('#NotifikasiEditRincianAnggaran').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormEditRincianAnggaran.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormEditRincianAnggaran').html(data);
        }
    });
});
//Proses Tambah Rincian Anggaran
$('#ProsesEditRincianAnggaran').submit(function(){
    $('#NotifikasiEditRincianAnggaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditRincianAnggaran')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesEditRincianAnggaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditRincianAnggaran').html(data);
            var NotifikasiEditRincianAnggaranBerhasil=$('#NotifikasiEditRincianAnggaranBerhasil').html();
            if(NotifikasiEditRincianAnggaranBerhasil=="Success"){
                $('#ModalEditRincianAnggaran').modal('hide');
                $("#ProsesEditRincianAnggaran")[0].reset();
                swal("Success!", "Edit Rincian Anggaran Berhasil!", "success");
                //Menampilkan Data
                ShowRincianAnggaran();
            }
        }
    });
});
//Ketika Modal Export Anggaran
$('#ModalExportRincianAnggaran').on('show.bs.modal', function (e) {
    var id_anggaran = $(e.relatedTarget).data('id');
    var tahun_anggaran = $('#tahun_anggaran').val();
    $('#FormExportRincianAnggaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormExportRincianAnggaran.php',
        data        :   {id_anggaran: id_anggaran, tahun_anggaran: tahun_anggaran},
        success     : function(data){
            $('#FormExportRincianAnggaran').html(data);
        }
    });
});

//Modal Tambah Rincian Rab
$('#ModalTambahRincianRab').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#NotifikasiTambahRincianRab').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormTambahRincianRab').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormTambahRincianRab.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormTambahRincianRab').html(data);
        }
    });
});
//Proses Tambah Rincian Anggaran RAB
$('#ProsesTambahRincianRab').submit(function(){
    $('#NotifikasiTambahRincianRab').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahRincianRab')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesTambahRincianRab.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahRincianRab').html(data);
            var NotifikasiTambahRincianRabBerhasil=$('#NotifikasiTambahRincianRabBerhasil').html();
            if(NotifikasiTambahRincianRabBerhasil=="Success"){
                $('#ModalTambahRincianRab').modal('hide');
                $("#ProsesTambahRincianRab")[0].reset();
                swal("Success!", "Edit Rincian Anggaran Berhasil!", "success");
                //Menampilkan Data
                ShowRincianAnggaranRab();
            }
        }
    });
});
//Modal Hapus Rincian Rab
$('#ModalHapusRab').on('show.bs.modal', function (e) {
    var id_anggaran_rab = $(e.relatedTarget).data('id');
    $('#NotifikasiHapusRab').html('<code class="text-primary">Apakah anda yakin akan menghapus data tersebut?</code>');
    $('#FormHapusRab').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormHapusRab.php',
        data        :   {id_anggaran_rab: id_anggaran_rab},
        success     : function(data){
            $('#FormHapusRab').html(data);
        }
    });
});
//Proses Hapus Rincian Anggaran RAB
$('#ProsesHapusRab').submit(function(){
    $('#NotifikasiHapusRab').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusRab')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesHapusRab.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusRab').html(data);
            var NotifikasiHapusRabBerhasil=$('#NotifikasiHapusRabBerhasil').html();
            if(NotifikasiHapusRabBerhasil=="Success"){
                $('#ModalHapusRab').modal('hide');
                swal("Success!", "Hapus Rincian RAB Berhasil!", "success");
                //Menampilkan Data
                ShowRincianAnggaranRab();
            }
        }
    });
});
//Modal Edit Rincian Rab
$('#ModalEditRab').on('show.bs.modal', function (e) {
    var id_anggaran_rab = $(e.relatedTarget).data('id');
    $('#NotifikasiEditRab').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormEditRab').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormEditRab.php',
        data        :   {id_anggaran_rab: id_anggaran_rab},
        success     : function(data){
            $('#FormEditRab').html(data);
        }
    });
});
//Proses Hapus Rincian Anggaran RAB
$('#ProsesEditRab').submit(function(){
    $('#NotifikasiEditRab').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditRab')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesEditRab.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditRab').html(data);
            var NotifikasiEditRabBerhasil=$('#NotifikasiEditRabBerhasil').html();
            if(NotifikasiEditRabBerhasil=="Success"){
                $('#ModalEditRab').modal('hide');
                swal("Success!", "Edit Rincian RAB Berhasil!", "success");
                //Menampilkan Data
                ShowRincianAnggaranRab();
            }
        }
    });
});
//Modal Import Rincian Rab
$('#ModalImportDariExcelRab').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#NotifikasiImportDariExcelRab').html('<code class="text-primary">Pastkan data yang anda input sudah benar.</code>');
    $('#FormImportDariExcelRab').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormImportDariExcelRab.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormImportDariExcelRab').html(data);
        }
    });
});
//Proses Import Anggaran RAB
$('#ProsesImportDariExcelRab').submit(function(){
    $('#NotifikasiImportDariExcelRab').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesImportDariExcelRab')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesImportDariExcelRab.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiImportDariExcelRab').html(data);
            var NotifikasiImportDariExcelRabBerhasil=$('#NotifikasiImportDariExcelRabBerhasil').html();
            if(NotifikasiImportDariExcelRabBerhasil=="Success"){
                $('#ModalImportDariExcelRab').modal('hide');
                swal("Success!", "Import RAB Berhasil!", "success");
                //Menampilkan Data
                ShowRincianAnggaranRab();
            }
        }
    });
});
//Modal Export Rincian Rab
$('#ModalExportRab').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#FormExportRab').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormExportRab.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormExportRab').html(data);
        }
    });
});
//Modal Update Anggaran
$('#ModalUpdateProgress').on('show.bs.modal', function (e) {
    var id_anggaran_rincian = $(e.relatedTarget).data('id');
    $('#FormUpdateProgress').html("Loading...");
    $('#NotifikasiUpdateProgress').html('<small class="credit"><code class="text-primary">Pastikan Informasi Progress Yang Anda Input Sudah Sesuai</code></small>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/FormUpdateProgress.php',
        data        :   {id_anggaran_rincian: id_anggaran_rincian},
        success     : function(data){
            $('#FormUpdateProgress').html(data);
            $( '#alokasi_anggaran' ).mask('000.000.000', {reverse: true});
        }
    });
});
//Proses Update Progress
$('#ProsesUpdateProgress').submit(function(){
    $('#NotifikasiUpdateProgress').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUpdateProgress')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggaran/ProsesUpdateProgress.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUpdateProgress').html(data);
            var NotifikasiUpdateProgressBerhasil=$('#NotifikasiUpdateProgressBerhasil').html();
            if(NotifikasiUpdateProgressBerhasil=="Success"){
                location.reload();
            }
        }
    });
});