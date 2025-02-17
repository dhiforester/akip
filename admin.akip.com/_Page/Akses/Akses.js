//Fungsi Menampilkan Data Akses
function showDataAkses(height) {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#showAkses').show();
    $('#table_akses').html('<tr><td class="text-center">Loading...</td></tr>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Akses/TabelAkses.php',
        data    : ProsesFilter,
        success: function(data) {
            $('#table_akses').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    showDataAkses(0);
});

//Filter Data Submit
$('#ProsesFilter').submit(function(){
    $('#page').val(1);
    showDataAkses(0);
    $('#ModalFilter').modal('hide');
});

//Change Keyword By
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});

//Ketika Akses Diubah, Tampilkan Wilayah
$('#akses').change(function(){
    var akses = $('#akses').val();
    $('#FormPilihWilayah').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormPilihWilayah.php',
        data 	    :  {akses: akses},
        success     : function(data){
            $('#FormPilihWilayah').html(data);
        }
    });
});

//Pagging
$(document).on('click', '#next_button_akses', function() {
    var page_now = parseInt($('#page').val(), 10); // Pastikan nilai diambil sebagai angka
    var next_page = page_now + 1;
    $('#page').val(next_page);
    showDataAkses(0);
});
$(document).on('click', '#prev_button_akses', function() {
    var page_now = parseInt($('#page').val(), 10); // Pastikan nilai diambil sebagai angka
    var next_page = page_now - 1;
    $('#page').val(next_page);
    showDataAkses(0);
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

//Upload Image Profile
$('#foto').on('change', function () {
    var file = this.files[0];
    var maxSize = 2 * 1024 * 1024; // Maksimal 2 MB
    var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    $('#NotifikasiValidasiFile').text('').removeClass('text-danger text-success');

    if (file) {
    // Validasi ukuran file
    if (file.size > maxSize) {
        $('#NotifikasiValidasiFile').text('Ukuran file terlalu besar! Maksimal 2 MB.')
        .addClass('text-danger');
        this.value = ''; // Reset file input
        return;
    }

    // Validasi tipe file
    if ($.inArray(file.type, allowedTypes) === -1) {
        $('#NotifikasiValidasiFile').text('Format file tidak valid! Hanya JPG, JPEG, PNG, GIF yang diperbolehkan.')
        .addClass('text-danger');
        this.value = ''; // Reset file input
        return;
    }

    $('#NotifikasiValidasiFile').text('File valid.').addClass('text-success');
    }
});

//Proses Tambah Akses
$("#ProsesTambahAkses").on("submit", function (e) {
    e.preventDefault();
    var id_inspektorat= $("#put_id_inspektorat_to_tambah_akses").val();
    // Tombol loading
    let $ModalElement = $("#ModalTambahAkses");
    let $Notifikasi = $("#NotifikasiTambahAkses");
    let $ButtonProses = $("#ButtonTambahAkses");
    let ButtonElement = '<i class="bi bi-save"></i> Simpan';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesTambahAkses.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {
                
                //reset form
                $("#ProsesTambahAkses")[0].reset();

                //Tampilkan Data Akses
                showDataAkses(0);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Tambah Akses Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');
                $('#FormPilihWilayah').html('');
                $('#NotifikasiValidasiFile').html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
    });
});

//Modal Detail Akses
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

    //Kosongkan Notifikasi
    $('#NotifikasiEditAkses').html("");

    //Tempelkan id_akses
    $('#put_id_akses_to_edit').val(id_akses);

    //Buka Data Detail
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/detail_akses.php',
        data        : {id_akses: id_akses},
        dataType    : "json",
        success     : function(response){
            if(response.status=="Success"){
                var nama=response.data_detail.nama;
                var kontak=response.data_detail.kontak;
                var email=response.data_detail.email;
                $('#nama_edit').val(nama);
                $('#email_edit').val(email);
                $('#kontak_edit').val(kontak);
            }else{
                $('#NotifikasiEditAkses').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Error : '+response.message+'</div>'
                );
                $('#ButtonEditAkses').prop("disabled", true);
            }
        },
        error: function () {
            $('#NotifikasiEditAkses').html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $('#ButtonEditAkses').prop("disabled", true);
        },
    });
});

//Proses Edit Akses
$("#ProsesEditAkses").on("submit", function (e) {
    e.preventDefault();
    var id_inspektorat= $("#put_id_inspektorat_to_tambah_akses").val();
    // Tombol loading
    let $ModalElement = $("#ModalEditAkses");
    let $Notifikasi = $("#NotifikasiEditAkses");
    let $ButtonProses = $("#ButtonEditAkses");
    let ButtonElement = '<i class="bi bi-save"></i> Simpan';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesEditAkses.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {
                
                //reset form
                $("#ProsesEditAkses")[0].reset();

                //Tampilkan Data Akses
                showDataAkses(0);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Edit Akses Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
    });
});

//Modal Ubah Password
$('#ModalUbahPassword').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    //Tempelkan id_akses
    $('#put_id_akses_for_edit_password').val(id_akses);
    //Kosongkan Form
    $('#password1_edit').val('');
    $('#password2_edit').val('');
    //Kosongkan Notifikasi
    $('#NotifikasiUbahPassword').html('');
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
});

//Proses Ubah Password
$("#ProsesUbahPassword").on("submit", function (e) {
    e.preventDefault();
    height = $(window).scrollTop();
    // Tombol loading
    let $ModalElement = $("#ModalUbahPassword");
    let $Notifikasi = $("#NotifikasiUbahPassword");
    let $ButtonProses = $("#ButtonUbahPassword");
    let ButtonElement = '<i class="bi bi-save"></i> Simpan';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesUbahPassword.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {
                
                //Reset Form
                $("#ProsesUbahPassword")[0].reset();

                //Tampilkan Data
                showDataAkses(height);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Ubah Password Akses Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
    });
});

//Modal Ubah Foto
$('#ModalUbahFoto').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    
    //Reset Form
    $("#ProsesUbahFoto")[0].reset();

    //Tempelkan id_akses
    $('#put_id_akses_for_edit_foto').val(id_akses);

    //Kosongkan Notifikasi
    $('#NotifikasiUbahFoto').html('');
    $('#NotifikasiValidasiFileEdit').html('');
});

//Saat Upload Foto
$('#foto_edit').on('change', function () {
    var file = this.files[0];
    var maxSize = 2 * 1024 * 1024; // Maksimal 2 MB
    var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    $('#NotifikasiValidasiFileEdit').text('').removeClass('text-danger text-success');

    if (file) {
        // Validasi ukuran file
        if (file.size > maxSize) {
            $('#NotifikasiValidasiFileEdit').text('Ukuran file terlalu besar! Maksimal 2 MB.')
            .addClass('text-danger');
            this.value = ''; // Reset file input
            return;
        }

        // Validasi tipe file
        if ($.inArray(file.type, allowedTypes) === -1) {
            $('#NotifikasiValidasiFileEdit').text('Format file tidak valid! Hanya JPG, JPEG, PNG, GIF yang diperbolehkan.')
            .addClass('text-danger');
            this.value = ''; // Reset file input
            return;
        }

        $('#NotifikasiValidasiFileEdit').text('File valid Dan Siap Diupload.').addClass('text-success');
    }
});

//Proses Ubah Foto
$("#ProsesUbahFoto").on("submit", function (e) {
    e.preventDefault();
    height = $(window).scrollTop();
    // Tombol loading
    let $ModalElement = $("#ModalUbahFoto");
    let $Notifikasi = $("#NotifikasiUbahFoto");
    let $ButtonProses = $("#ButtonUbahFoto");
    let ButtonElement = '<i class="bi bi-save"></i> Simpan';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesEditFoto.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {
                
                //Reset Form
                $("#ProsesUbahFoto")[0].reset();

                //Tampilkan Data
                showDataAkses(height);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Ubah Foto Pengguna Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
    });
});

//Modal Edit Level Akses
$('#ModalEditLevelAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormEditLevelAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormEditLevelAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormEditLevelAkses').html(data);
            $('#NotifikasiEditLevelAkses').html('');
        }
    });
});

//Proses Edit Level Akses
$("#ProsesEditLevelAkses").on("submit", function (e) {
    e.preventDefault();
    height = $(window).scrollTop();
    // Tombol loading
    let $ModalElement = $("#ModalEditLevelAkses");
    let $Notifikasi = $("#NotifikasiEditLevelAkses");
    let $ButtonProses = $("#ButtonEditLevelAkses");
    let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesEditLevelAkses.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {

                //Tampilkan Data
                showDataAkses(height);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Edit Level Akses Pengguna Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
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

//Proses Hapus akses
$("#ProsesHapusAkses").on("submit", function (e) {
    e.preventDefault();
    height = $(window).scrollTop();
    // Tombol loading
    let $ModalElement = $("#ModalHapusAkses");
    let $Notifikasi = $("#NotifikasiHapusAkses");
    let $ButtonProses = $("#ButtonHapusAkses");
    let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
    $ButtonProses.html('Loading..');
    $ButtonProses.prop("disabled", true);

    // Ambil data form
    let formData = new FormData(this);

    // Kirim data ke server
    $.ajax({
        url         : "_Page/Akses/ProsesHapusAkses.php",
        type        : "POST",
        data        : formData,
        contentType : false,
        processData : false,
        dataType    : "json",
        success: function (response) {
            //Apabila Proses Berhasil
            if (response.status === "Success") {

                //Tampilkan Data
                showDataAkses(height);
                
                // Tampilkan swal notifikasi
                Swal.fire(
                    'Success!',
                    'Hapus Akses Pengguna Berhasil!',
                    'success'
                )

                // Reset tombol
                $ButtonProses.html(ButtonElement);
                $ButtonProses.prop("disabled", false);

                //Kosongkan Notifikasi
                $Notifikasi.html('');

                //Tutup Modal
                $ModalElement.modal('hide');
            } else {
                // Tampilkan pesan error
                $Notifikasi.html(
                    `<div class="alert alert-danger" role="alert">${response.message}</div>`
                );
                $ButtonProses.html(ButtonElement).prop("disabled", false);
            }
        },
        error: function () {
            $Notifikasi.html(
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
            );
            $ButtonProses.html(ButtonElement).prop("disabled", false);
        },
    });
});

//Modal Export Akses
$('#ModalExport').on('show.bs.modal', function (e) {
    //Kosongkan Notifikasi
    $('#NotifikasiExport').html("");
});

//Proses Export akses
$("#ProsesExport").on("submit", function (e) {
    $('#ButtonExport').html('Loading..').prop("disabled", true);
    //Diresctory Export
    var directoryPath = "_Page/Akses/ProsesExport.php";
    //Buka Tab Baru
    window.open(directoryPath, '_blank');
    //Kembalikan Tombol
    $('#ButtonExport').html('<i class="bi bi-download"></i> Ya, Export').prop("disabled", false);
    //Tutup Modal
    $('#ModalExport').modal('hide');
    //Swal Berhasil
    Swal.fire(
        'Success!',
        'Export Data Akses Berhasil!',
        'success'
    )
});