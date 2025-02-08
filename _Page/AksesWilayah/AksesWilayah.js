//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelAkses').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/AksesWilayah/TabelAksesWilayah.php',
        data    : ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelAkses').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});
//Filter Data
$('#ProsesFilter').submit(function(){
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilter').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
//Kondisi saat tampilkan password
$('.form-check-input').click(function(){
    if($(this).is(':checked')){
        $('#password1').attr('type','text');
        $('#password2').attr('type','text');
    }else{
        $('#password1').attr('type','password');
        $('#password2').attr('type','password');
    }
});
//Proses Tambah Akses
$('#ProsesTambahAkses').submit(function(){
    $('#NotifikasiTambahAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahAkses')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/ProsesTambahAkses.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahAkses').html(data);
            var NotifikasiTambahAksesBerhasil=$('#NotifikasiTambahAksesBerhasil').html();
            if(NotifikasiTambahAksesBerhasil=="Success"){
                $("#ProsesTambahAkses")[0].reset();
                $('#ModalTambahAkses').modal('hide');
                $('#NotifikasiTambahAkses').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Tambahh Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Edit Akses
$('#ModalEditAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormEditAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/FormEditAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormEditAkses').html(data);
        }
    });
});
//Proses Tambah Akses
$('#ProsesEditAkses').submit(function(){
    $('#NotifikasiEditAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditAkses')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/ProsesEditAkses.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditAkses').html(data);
            var NotifikasiEditAksesBerhasil=$('#NotifikasiEditAksesBerhasil').html();
            if(NotifikasiEditAksesBerhasil=="Success"){
                $('#ModalEditAkses').modal('hide');
                $('#NotifikasiEditAkses').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Edit Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Ubah Ijin Akses 
$('#ModalUbahIjinAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormUbahIjinAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/FormUbahIjinAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormUbahIjinAkses').html(data);
            $('#NotifikasiUbahIjinAkses').html('<code class="primary">Pastikan Data Yang Anda Input Sudah Benar</code>');
        }
    });
});
//Proses Atur Ijin Akses
$('#ProsesUbahIjinAkses').submit(function(){
    $('#NotifikasiUbahIjinAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUbahIjinAkses')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/ProsesUbahIjinAkses.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUbahIjinAkses').html(data);
            var NotifikasiUbahIjinAksesBerhasil=$('#NotifikasiUbahIjinAksesBerhasil').html();
            if(NotifikasiUbahIjinAksesBerhasil=="Success"){
                $('#ModalUbahIjinAkses').modal('hide');
                swal("Success!", "Ubah Ijin Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Akses
$('#ModalDetailAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormDetailAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayah/FormDetailAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormDetailAkses').html(data);
        }
    });
});

//Modal Ubah Password
$('#ModalUbahPassword').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormUbahPassword').html("Loading...");
    $('#NotifikasiUbahPassword').html('<code class="text-primary">Pastikan Password Yang Anda Masukan Sudah Benar</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormUbahPassword.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormUbahPassword').html(data);
            //Kondisi saat tampilkan password
            $('#TampilkanPassword2').click(function(){
                if($(this).is(':checked')){
                    $('#password1_edit').attr('type','text');
                    $('#password2_edit').attr('type','text');
                }else{
                    $('#password1_edit').attr('type','password');
                    $('#password2_edit').attr('type','password');
                }
            });
        }
    });
});
//Proses Ubah Password
$('#ProsesUbahPassword').submit(function(){
    $('#NotifikasiUbahPassword').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesUbahPassword')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/ProsesUbahPassword.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUbahPassword').html(data);
            var NotifikasiUbahPasswordBerhasil=$('#NotifikasiUbahPasswordBerhasil').html();
            if(NotifikasiUbahPasswordBerhasil=="Success"){
                $('#ModalUbahPassword').modal('hide');
                swal("Success!", "Ubah Password Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Hapus Akses
$('#ModalHapusAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormHapusAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormHapusAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormHapusAkses').html(data);
            $('#NotifikasiHapusAkses').html('');
        }
    });
});
//Konfirmasi Hapus akses
$('#ProsesHapusAkses').submit(function(){
    var ProsesHapusAkses = $('#ProsesHapusAkses').serialize();
    $('#NotifikasiHapusAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/ProsesHapusAkses.php',
        data        : ProsesHapusAkses,
        success     : function(data){
            $('#NotifikasiHapusAkses').html(data);
            var NotifikasiHapusAksesBerhasil=$('#NotifikasiHapusAksesBerhasil').html();
            if(NotifikasiHapusAksesBerhasil=="Success"){
                $('#ModalHapusAkses').modal('hide');
                swal("Success!", "Hapus Akses Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});