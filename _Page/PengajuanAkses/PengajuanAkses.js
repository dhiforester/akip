//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelPengajuanAkses').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/PengajuanAkses/TabelPengajuanAkses.php',
        data    : ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelPengajuanAkses').html(data);
        }
    });
}
function generateRandomString(length) {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    var randomString = '';
    for (var i = 0; i < length; i++) {
        randomString += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return randomString;
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
            $('#keyword').focus();
        }
    });
});
//Proses Filter
$('#ProsesFilter').submit(function(){
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
//Modal Lihat Dokumen
$('#ModalLihatDokumen').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormLihatDokumen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormLihatDokumen.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormLihatDokumen').html(data);
        }
    });
});
//Modal Hapus Pengajuan Akses
$('#ModalHapusPengajuanAkses').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormHapusPengajuanAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormHapusPengajuanAkses.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormHapusPengajuanAkses').html(data);
            $('#NotifikasiHapusPengajuanAkses').html('');
        }
    });
});
//Konfirmasi Hapus pengajuan akses
$('#ProsesHapusPengajuanAkses').submit(function(){
    var ProsesHapusPengajuanAkses = $('#ProsesHapusPengajuanAkses').serialize();
    $('#NotifikasiHapusPengajuanAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/ProsesHapusPengajuanAkses.php',
        data        : ProsesHapusPengajuanAkses,
        success     : function(data){
            $('#NotifikasiHapusPengajuanAkses').html(data);
            var NotifikasiHapusPengajuanAksesBerhasil=$('#NotifikasiHapusPengajuanAksesBerhasil').html();
            if(NotifikasiHapusPengajuanAksesBerhasil=="Success"){
                $('#ModalHapusPengajuanAkses').modal('hide');
                swal("Success!", "Hapus Pengajuan Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Tolak Pengajuan Akses
$('#ModalTolakPengajuan').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormTolakPengajuan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormTolakPengajuan.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormTolakPengajuan').html(data);
            $('#NotifikasiTolakPengajuan').html('');
        }
    });
});
//Konfirmasi Tolak pengajuan akses
$('#ProsesTolakPengajuan').submit(function(){
    var ProsesTolakPengajuan = $('#ProsesTolakPengajuan').serialize();
    $('#NotifikasiTolakPengajuan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/ProsesTolakPengajuan.php',
        data        : ProsesTolakPengajuan,
        success     : function(data){
            $('#NotifikasiTolakPengajuan').html(data);
            var NotifikasiTolakPengajuanBerhasil=$('#NotifikasiTolakPengajuanBerhasil').html();
            if(NotifikasiTolakPengajuanBerhasil=="Success"){
                $('#ModalTolakPengajuan').modal('hide');
                swal("Success!", "Tolak Pengajuan Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Tolak Pengajuan Akses
$('#ModalTolakPengajuan').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormTolakPengajuan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormTolakPengajuan.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormTolakPengajuan').html(data);
            $('#NotifikasiTolakPengajuan').html('');
        }
    });
});
//Konfirmasi Tolak pengajuan akses
$('#ProsesTolakPengajuan').submit(function(){
    var ProsesTolakPengajuan = $('#ProsesTolakPengajuan').serialize();
    $('#NotifikasiTolakPengajuan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/ProsesTolakPengajuan.php',
        data        : ProsesTolakPengajuan,
        success     : function(data){
            $('#NotifikasiTolakPengajuan').html(data);
            var NotifikasiTolakPengajuanBerhasil=$('#NotifikasiTolakPengajuanBerhasil').html();
            if(NotifikasiTolakPengajuanBerhasil=="Success"){
                $('#ModalTolakPengajuan').modal('hide');
                swal("Success!", "Tolak Pengajuan Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Terima Pengajuan Akses
$('#ModalTerimaPengajuan').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormTerimaPengajuan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormTerimaPengajuan.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormTerimaPengajuan').html(data);
            $('#NotifikasiTerimaPengajuan').html('');
            //Kondisi Ketika Melakukan Generate
            $('#GeneratePassword').click(function(){
                var Password=generateRandomString(10);
                $('#PasswordPenerima').val(Password);
            });
        }
    });
});
//Konfirmasi Terima pengajuan akses
$('#ProsesTerimaPengajuan').submit(function(){
    var ProsesTerimaPengajuan = $('#ProsesTerimaPengajuan').serialize();
    $('#NotifikasiTerimaPengajuan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/ProsesTerimaPengajuan.php',
        data        : ProsesTerimaPengajuan,
        success     : function(data){
            $('#NotifikasiTerimaPengajuan').html(data);
            var NotifikasiTerimaPengajuanBerhasil=$('#NotifikasiTerimaPengajuanBerhasil').html();
            if(NotifikasiTerimaPengajuanBerhasil=="Success"){
                $('#ModalTerimaPengajuan').modal('hide');
                swal("Success!", "Terima Pengajuan Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Pembatalan Penolakan Pengajuan Akses
$('#ModalBatalkanPenolakan').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormBatalkanPenolakan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormBatalkanPenolakan.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormBatalkanPenolakan').html(data);
            $('#NotifikasiBatalkanPenolakan').html('');
        }
    });
});
//Konfirmasi Hapus pengajuan akses
$('#ProsesBatalkanPenolakan').submit(function(){
    var ProsesBatalkanPenolakan = $('#ProsesBatalkanPenolakan').serialize();
    $('#NotifikasiBatalkanPenolakan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/ProsesBatalkanPenolakan.php',
        data        : ProsesBatalkanPenolakan,
        success     : function(data){
            $('#NotifikasiBatalkanPenolakan').html(data);
            var NotifikasiBatalkanPenolakanBerhasil=$('#NotifikasiBatalkanPenolakanBerhasil').html();
            if(NotifikasiBatalkanPenolakanBerhasil=="Success"){
                $('#ModalBatalkanPenolakan').modal('hide');
                swal("Success!", "Pembatalan Penolakan Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Download Kwitansi
$('#ModalKwitansi').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormKwitansi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormKwitansi.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormKwitansi').html(data);
        }
    });
});
//Modal Download Sertifikat
$('#ModalSertifikat').on('show.bs.modal', function (e) {
    var id_akses_pengajuan = $(e.relatedTarget).data('id');
    $('#FormSertifikat').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PengajuanAkses/FormSertifikat.php',
        data        : {id_akses_pengajuan: id_akses_pengajuan},
        success     : function(data){
            $('#FormSertifikat').html(data);
        }
    });
});