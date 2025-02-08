//DISTINCT KABUPATEN
//Fungsi Menampilkan Data
function LoadTabelDistinctKabupaten() {
    var ProsesFilterDistinctKabupaten = $('#ProsesFilterDistinctKabupaten').serialize();
    $('#MenampilkanTabelBidangDistinctKabupaten').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/BidangKegiatan/TabelBidangDistinctKabupaten.php',
        data    : ProsesFilterDistinctKabupaten,
        success: function(data) {
            $('#MenampilkanTabelBidangDistinctKabupaten').html(data);
        }
    });
}
function LoadBidangByKabupaten() {
    var id_wilayah = $('#GetIdWilayah').html();
    $('#TabelBidangByKabupaten').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/BidangKegiatan/TabelBidangByKabupaten.php',
        data    : {id_wilayah: id_wilayah},
        success: function(data) {
            $('#TabelBidangByKabupaten').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    LoadTabelDistinctKabupaten();
});
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    LoadBidangByKabupaten();
});
//Filter Data
$('#ProsesFilterDistinctKabupaten').submit(function(){
    LoadTabelDistinctKabupaten();
    $('#ModalFilterDistinctKabupaten').modal('hide');
});

//Ketika Modal List Kabupaten Muncul 
$('#ModalPilihKabupaten').on('show.bs.modal', function (e) {
    var ProsesPencarianListKabupaten = $('#ProsesPencarianListKabupaten').serialize();
    $('#ListKabupaten').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/ListKabupaten.php',
        data        :   ProsesPencarianListKabupaten,
        success     : function(data){
            $('#ListKabupaten').html(data);
        }
    });
});
//Ketika Pencarian List Kabupaten
$('#ProsesPencarianListKabupaten').submit(function(){
    var ProsesPencarianListKabupaten = $('#ProsesPencarianListKabupaten').serialize();
    $('#ListKabupaten').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/ListKabupaten.php',
        data        :   ProsesPencarianListKabupaten,
        success     : function(data){
            $('#ListKabupaten').html(data);
        }
    });
});
//Ketika Modal Filter Draft
$('#ModalFilterDraft').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#PutIdWilayah').val(id_wilayah);
});
//Ketika Proses Filter Draft
$('#ProsesFilterDraft').submit(function(){
    var ProsesFilterDraft = $('#ProsesFilterDraft').serialize();
    $('#TabelBidangByKabupaten').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/BidangKegiatan/TabelBidangByKabupaten.php',
        data    : ProsesFilterDraft,
        success: function(data) {
            $('#TabelBidangByKabupaten').html(data);
            $('#ModalFilterDraft').modal('hide');
        }
    });
});
//Ketika Modal Tambah Bidang
$('#ModalTambahBidang').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormTambahBidang').html("Loading...");
    $('#NotifikasiTambahBidang').html("");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/FormTambahBidang.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormTambahBidang').html(data);
        }
    });
});
//Ketika Proses Tambah Bidang
$('#ProsesTambahBidang').submit(function(){
    var ProsesTambahBidang = $('#ProsesTambahBidang').serialize();
    $('#NotifikasiTambahBidang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/ProsesTambahBidang.php',
        data        :   ProsesTambahBidang,
        success     : function(data){
            $('#NotifikasiTambahBidang').html(data);
            var NotifikasiTambahBidangBerhasil=$('#NotifikasiTambahBidangBerhasil').html();
            if(NotifikasiTambahBidangBerhasil=="Success"){
                $('#ModalTambahBidang').modal('hide');
                swal("Success!", "Tambahh Tambah Bidang/Kegiatan Berhasil!", "success");
                LoadBidangByKabupaten();
            }
        }
    });
});
//Ketika Modal Detail Bidang
$('#ModalDetailBidang').on('show.bs.modal', function (e) {
    var id_bidang_kegiatan = $(e.relatedTarget).data('id');
    $('#FormDetailBidang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/FormDetailBidang.php',
        data        :   {id_bidang_kegiatan: id_bidang_kegiatan},
        success     : function(data){
            $('#FormDetailBidang').html(data);
        }
    });
});
//Ketika Modal Edit Bidang
$('#ModalEditBidang').on('show.bs.modal', function (e) {
    var id_bidang_kegiatan = $(e.relatedTarget).data('id');
    $('#FormEditBidang').html("Loading...");
    $('#NotifikasiEditBidang').html('<code class="text-primary">Pastikan Perubahan Data Yang Anda Lakukan Sudahh Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/FormEditBidang.php',
        data        :   {id_bidang_kegiatan: id_bidang_kegiatan},
        success     : function(data){
            $('#FormEditBidang').html(data);
        }
    });
});
//Proses Simpan Edit Bidang
$('#ProsesEditBidang').submit(function(){
    var ProsesEditBidang = $('#ProsesEditBidang').serialize();
    $('#NotifikasiEditBidang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/ProsesEditBidang.php',
        data        :   ProsesEditBidang,
        success     : function(data){
            $('#NotifikasiEditBidang').html(data);
            var NotifikasiEditBidangBerhasil=$('#NotifikasiEditBidangBerhasil').html();
            if(NotifikasiEditBidangBerhasil=="Success"){
                $('#ModalEditBidang').modal('hide');
                swal("Success!", "Edit Bidang/Kegiatan Berhasil!", "success");
                LoadBidangByKabupaten();
            }
        }
    });
});
//Ketika Modal Hapus Bidang
$('#ModalHapusBidang').on('show.bs.modal', function (e) {
    var id_bidang_kegiatan = $(e.relatedTarget).data('id');
    $('#FormHapusBidang').html("Loading...");
    $('#NotifikasiHapusBidang').html('<code class="text-primary">Apakah Anda Yakin Akan Menghapus Data Ini?</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/FormHapusBidang.php',
        data        :   {id_bidang_kegiatan: id_bidang_kegiatan},
        success     : function(data){
            $('#FormHapusBidang').html(data);
        }
    });
});
//Proses Hapus Bidang
$('#ProsesHapusBidang').submit(function(){
    var ProsesHapusBidang = $('#ProsesHapusBidang').serialize();
    $('#NotifikasiHapusBidang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/ProsesHapusBidang.php',
        data        :   ProsesHapusBidang,
        success     : function(data){
            $('#NotifikasiHapusBidang').html(data);
            var NotifikasiHapusBidangBerhasil=$('#NotifikasiHapusBidangBerhasil').html();
            if(NotifikasiHapusBidangBerhasil=="Success"){
                $('#ModalHapusBidang').modal('hide');
                swal("Success!", "Hapus Bidang/Kegiatan Berhasil!", "success");
                LoadBidangByKabupaten();
            }
        }
    });
});
//Ketika Modal Konfirm Lihat Detail
$('#ModalKonfirmLihatDetail').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormKonfirmasiLihatBidang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/BidangKegiatan/FormKonfirmasiLihatBidang.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormKonfirmasiLihatBidang').html(data);
        }
    });
});