//Fungsi Menampilkan Data Kecamatan
function MenampilkanKecamatan() {
    $('#MenampilkanTabelKecamatan').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/TabelKecamatan.php',
        success     : function(data){
            $('#MenampilkanTabelKecamatan').html(data);
        }
    });
}
function ListAksesKecamatanById() {
    var id_wilayah =$('#id_wilayah').val();
    $('#ListAksesKecamatanById').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ListAksesKecamatanById.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#ListAksesKecamatanById').html(data);
        }
    });
}
function ListDesaByKecamatan() {
    var id_wilayah =$('#id_wilayah').val();
    $('#ListDesaByKecamatan').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ListDesa2.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#ListDesaByKecamatan').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    MenampilkanKecamatan();
    ListAksesKecamatanById();
    ListDesaByKecamatan();
});
//Proses Import Kecamatan
$('#ProsesImportAksesKecamatan').submit(function(){
    $('#NotifikasiImportAksesKecamatan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesImportAksesKecamatan')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ProsesImportAksesKecamatan.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiImportAksesKecamatan').html(data);
            var NotifikasiImportAksesKecamatanBerhasil=$('#NotifikasiImportAksesKecamatanBerhasil').html();
            if(NotifikasiImportAksesKecamatanBerhasil=="Success"){
                MenampilkanKecamatan();
                $('#ModalImportAksesKecamatan').modal('hide');
                $('#ProsesImportAksesKecamatan')[0].reset();
                $('#NotifikasiImportAksesKecamatan').html('<code class="text-primary">Pastikan File Yang Anda Import Sudah Sesuai</code>');
                swal("Success!", "Import Akses Wilayah Berhasil!", "success");
            }
        }
    });
});
//Proses Import Desa
$('#ProsesImportAksesDesa').submit(function(){
    $('#NotifikasiImportAksesDesa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesImportAksesDesa')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ProsesImportAksesDesa.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiImportAksesDesa').html(data);
            var NotifikasiImportAksesDesaBerhasil=$('#NotifikasiImportAksesDesaBerhasil').html();
            if(NotifikasiImportAksesDesaBerhasil=="Success"){
                MenampilkanKecamatan();
                ListDesaByKecamatan();
                $('#ModalImportAksesDesa').modal('hide');
                $('#ProsesImportAksesDesa')[0].reset();
                $('#NotifikasiImportAksesDesa').html('<code class="text-primary">Pastikan File Yang Anda Import Sudah Sesuai</code>');
                swal("Success!", "Import Akses Wilayah Berhasil!", "success");
            }
        }
    });
});
$('#ModalListDesa').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#ListDesa').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ListDesa.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#ListDesa').html(data);
        }
    });
});
$('#ModalListAkun').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#ListAkunKecamatan').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ListAkunKecamatan.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#ListAkunKecamatan').html(data);
        }
    });
});
$('#ModalAksesDesa').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#ListAkunDesa').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ListAkunDesa.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#ListAkunDesa').html(data);
        }
    });
});
$('#ModalDownloadTemplateDesa').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormDownloadTemplateDesa').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/FormDownloadTemplateDesa.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormDownloadTemplateDesa').html(data);
        }
    });
});

$('#ModalTambahAksesKecamatan').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormTambahAksesKecamatan').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/FormTambahAksesKecamatan.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormTambahAksesKecamatan').html(data);
        }
    });
});
//Proses Tambah Akses Kecamatan
$('#ProsesTambahAksesKecamatan').submit(function(){
    $('#NotifikasiTambahAksesKecamatan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahAksesKecamatan')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ProsesTambahAksesKecamatan.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahAksesKecamatan').html(data);
            var NotifikasiTambahAksesBerhasil=$('#NotifikasiTambahAksesBerhasil').html();
            if(NotifikasiTambahAksesBerhasil=="Success"){
                $("#ProsesTambahAksesKecamatan")[0].reset();
                $('#ModalTambahAksesKecamatan').modal('hide');
                $('#NotifikasiTambahAksesKecamatan').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Tambahh Akses Berhasil!", "success");
                //Menampilkan Data
                ListAksesKecamatanById();
            }
        }
    });
});
$('#ModalTambahAksesDesa').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormTambahAksesDesa').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/FormTambahAksesDesa.php',
        data        :   {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormTambahAksesDesa').html(data);
        }
    });
});
//Proses Tambah Akses Desa
$('#ProsesTambahAksesDesa').submit(function(){
    $('#NotifikasiTambahAksesDesa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahAksesDesa')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/AksesWilayahAdmin/ProsesTambahAksesDesa.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahAksesDesa').html(data);
            var NotifikasiTambahAksesDesaBerhasil=$('#NotifikasiTambahAksesDesaBerhasil').html();
            if(NotifikasiTambahAksesDesaBerhasil=="Success"){
                $("#ProsesTambahAksesDesa")[0].reset();
                $('#ModalTambahAksesDesa').modal('hide');
                $('#NotifikasiTambahAksesDesa').html('<code class="text-primary">Pastkan data yang anda input sudah benar</code>');
                swal("Success!", "Tambahh Akses Berhasil!", "success");
                //Menampilkan Data
                ListAksesKecamatanById();
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
        url 	    : '_Page/Akses/FormDetailAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormDetailAkses').html(data);
        }
    });
});
//Edit Akses
$('#ModalEditAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormEditAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormEditAkses.php',
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
        url 	    : '_Page/Akses/ProsesEditAkses.php',
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
                ListAksesKecamatanById();
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
        url 	    : '_Page/Akses/FormUbahIjinAkses.php',
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
        url 	    : '_Page/Akses/ProsesUbahIjinAkses.php',
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
                ListAksesKecamatanById();
            }
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
                ListAksesKecamatanById();
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
                ListAksesKecamatanById();
            }
        }
    });
});