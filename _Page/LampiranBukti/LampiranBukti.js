//Fungsi
function LoadLampiranBukti() {
    $.ajax({
        type    : 'POST',
        url     : '_Page/LampiranBukti/TabelLampiranBukti.php',
        success: function(data) {
            $('#MenampilkanTabelLampiranBukti').html(data);
        }
    });
}
//Menampilkan Pertama Kali
$(document).ready(function() {
    LoadLampiranBukti();
});
// Menghapus semua karakter selain angka
$('#max_file').on('input', function() {
    var angka = $(this).val().replace(/\D/g, '');
    $(this).val(angka);
});
//Proses Tambah Lampiran Bukti
$('#ProsesTambahLampiranBukti').submit(function(){
    $('#NotifikasiTambahLampiranBukti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahLampiranBukti')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LampiranBukti/ProsesTambahLampiranBukti.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahLampiranBukti').html(data);
            var NotifikasiTambahLampiranBuktiBerhasil=$('#NotifikasiTambahLampiranBuktiBerhasil').html();
            if(NotifikasiTambahLampiranBuktiBerhasil=="Success"){
                LoadLampiranBukti();
                swal("Success!", "Tambah Parameter Lampiran Bukti Berhasil!", "success");
                $('#ProsesTambahLampiranBukti')[0].reset();
                $('#ModalTambahLampiranBukti').modal('hide');
                $('#NotifikasiTambahLampiranBukti').html('<span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>');
            }
        }
    });
});
//Modal Edit Parameter
$('#ModalEditLampiranBukti').on('show.bs.modal', function (e) {
    var id_referensi_bukti = $(e.relatedTarget).data('id');
    $('#FormEditLampiranBukti').html("Loading...");
    $('#NotifikasiEditLampiranBukti').html('<span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LampiranBukti/FormEditLampiranBukti.php',
        data        : {id_referensi_bukti: id_referensi_bukti},
        success     : function(data){
            $('#FormEditLampiranBukti').html(data);
        }
    });
});
//Proses Edit Lampiran Bukti
$('#ProsesEditLampiranBukti').submit(function(){
    $('#NotifikasiEditLampiranBukti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditLampiranBukti')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LampiranBukti/ProsesEditLampiranBukti.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditLampiranBukti').html(data);
            var NotifikasiEditLampiranBuktiBerhasil=$('#NotifikasiEditLampiranBuktiBerhasil').html();
            if(NotifikasiEditLampiranBuktiBerhasil=="Success"){
                LoadLampiranBukti();
                swal("Success!", "Edit Parameter Lampiran Bukti Berhasil!", "success");
                $('#ModalEditLampiranBukti').modal('hide');
            }
        }
    });
});
//Modal Hapus Parameter
$('#ModalHapusLampiranBukti').on('show.bs.modal', function (e) {
    var id_referensi_bukti = $(e.relatedTarget).data('id');
    $('#FormHapusLampiranBukti').html("Loading...");
    $('#NotifikasiHapusLampiranBukti').html('<b>Apakah Anda Yakin Akan Menghapus Data tersebut?</b>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LampiranBukti/FormHapusLampiranBukti.php',
        data        : {id_referensi_bukti: id_referensi_bukti},
        success     : function(data){
            $('#FormHapusLampiranBukti').html(data);
        }
    });
});
//Proses Hapus Lampiran Bukti
$('#ProsesHapusLampiranBukti').submit(function(){
    $('#NotifikasiHapusLampiranBukti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusLampiranBukti')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/LampiranBukti/ProsesHapusLampiranBukti.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusLampiranBukti').html(data);
            var NotifikasiHapusLampiranBuktiBerhasil=$('#NotifikasiHapusLampiranBuktiBerhasil').html();
            if(NotifikasiHapusLampiranBuktiBerhasil=="Success"){
                LoadLampiranBukti();
                swal("Success!", "Hapus Parameter Lampiran Bukti Berhasil!", "success");
                $('#ProsesHapusLampiranBukti')[0].reset();
                $('#ModalHapusLampiranBukti').modal('hide');
            }
        }
    });
});