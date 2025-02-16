//Fungsi Menampilkan Provinsi
function ShowInspektorat(height) {
    $('#ShowInspektorat').show();
    $('#ShowDetailInspektorat').hide();
    var FilterInspektorat = $('#FilterInspektorat').serialize();
    $('#TabelInspektorat').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inspektorat/TabelInspektorat.php',
        data 	    :  FilterInspektorat,
        success     : function(data){
            $('#TabelInspektorat').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}

//Fungsi Menampilkan Detail Inspektorat
function ShowDetailInspektorat(id_inspektorat,height) {
    $('#ShowInspektorat').hide();
    $('#ShowDetailInspektorat').show();
    $('#DetailInspektorat').html('Loading...');
    $('#TabelAkses').html('Loading...');
    $('#TabelOpd').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inspektorat/TabelAkses.php',
        data 	    :  {id: id_inspektorat},
        success     : function(data){
            $('#TabelAkses').html(data);
        }
    });
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inspektorat/TabelOpd.php',
        data 	    :  {id: id_inspektorat},
        success     : function(data){
            $('#TabelOpd').html(data);
        }
    });
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inspektorat/DetailInspektorat.php',
        data 	    :  {id: id_inspektorat},
        success     : function(data){
            $('#DetailInspektorat').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });

    //Tempelkan id_inspektorat ke tombol tambah akses
    $('#TambahAkses').attr({'data-id': id_inspektorat});
    $('#TambahOpd').attr({'data-id': id_inspektorat});
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {

    //Ketinggian Default
    var height=0;
    ShowInspektorat(0);

    //Event ketika id_provinsi di ubah
    $(document).on('change', '#id_provinsi', function() {
        var id_provinsi = $(this).val();
        $('#id_kabkot').html('<option value="">Loading..</option>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Inspektorat/list_kabkot.php',
            data 	    :  {id_provinsi: id_provinsi},
            success     : function(data){
                $('#id_kabkot').html(data);
            }
        });
    });
    
    //Proses Tambah Inspektorat
    $("#ProsesTambahInspektorat").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalTambahInspektorat");
        let $Notifikasi = $("#NotifikasiTambahInspektorat");
        let $ButtonProses = $("#ButtonTambahInspektorat");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/ProsesTambahInspektorat.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //Reset Form Tambah Dan Filter
                    $("#ProsesTambahInspektorat")[0].reset();
                    $("#FilterInspektorat")[0].reset();

                    //Tampilkan Data
                    ShowInspektorat(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Inpektorat Berhasil!',
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

    //Modal Edit Inspektorat
    $('#ModalEditInspektorat').on('show.bs.modal', function (e) {
        var id_inspektorat = $(e.relatedTarget).data('id');
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        let $ButtonProses = $("#ButtonEditInspektorat");
        let $Notifikasi = $("#NotifikasiEditInspektorat");
        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/detail_inspektorat.php",
            type        : "POST",
            dataType    : "json",
            data        : {id_inspektorat: id_inspektorat},
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    var id_provinsi=response.data_detail.id_provinsi;
                    var id_kabkot=response.data_detail.id_kabkot;
                    var nama_inspektorat=response.data_detail.nama_inspektorat;
                    var telepon=response.data_detail.telepon;
                    var alamat=response.data_detail.alamat;
                    //Menampilkan List Kabkot
                    $('#id_kabkot_edit').html('<option value="">Loading..</option>');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/list_kabkot.php',
                        data 	    :  {id_provinsi: id_provinsi},
                        success     : function(data){
                            $('#id_kabkot_edit').html(data);
                            $("#id_kabkot_edit").val(id_kabkot);
                        }
                    });
                    // Reset tombol
                    $ButtonProses.html(ButtonElement);
                    $ButtonProses.prop("disabled", false);

                    //Kosongkan Notifikasi
                    $Notifikasi.html('');

                    //Tempelkan Komponen
                    $("#put_id_inspektorat_for_edit").val(id_inspektorat);
                    $("#id_provinsi_edit").val(id_provinsi);
                    $("#nama_edit").val(nama_inspektorat);
                    $("#kontak_edit").val(telepon);
                    $("#alamat_edit").val(alamat);
                } else {
                    // Tampilkan pesan error
                    $Notifikasi.html(
                        `<div class="alert alert-danger" role="alert">${response.message}</div>`
                    );
                    $ButtonProses.html(ButtonElement).prop("disabled", true);
                }
            },
            error: function () {
                $Notifikasi.html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
                $ButtonProses.html(ButtonElement).prop("disabled", true);
            },
        });
    });

    //Event ketika id_provinsi di ubah
    $(document).on('change', '#id_provinsi_edit', function() {
        var id_provinsi = $(this).val();
        $('#id_kabkot_edit').html('<option value="">Loading..</option>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Inspektorat/list_kabkot.php',
            data 	    :  {id_provinsi: id_provinsi},
            success     : function(data){
                $('#id_kabkot_edit').html(data);
            }
        });
    });

    //Proses Edit Inspektorat
    $("#ProsesEditInspektorat").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let $ModalElement = $("#ModalEditInspektorat");
        let $Notifikasi = $("#NotifikasiEditInspektorat");
        let $ButtonProses = $("#ButtonEditInspektorat");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);

        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/ProsesEditInspektorat.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //Reset Form Tambah Dan Filter
                    $("#ProsesEditInspektorat")[0].reset();
                    $("#FilterInspektorat")[0].reset();

                    //Tampilkan Data
                    ShowInspektorat(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Inpektorat Berhasil!',
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

    //Modal Hapus Inspektorat
    $('#ModalHapusInspektorat').on('show.bs.modal', function (e) {
        var id_inspektorat = $(e.relatedTarget).data('id');
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        let $ButtonProses = $("#ButtonHapusInspektorat");
        let $Notifikasi = $("#NotifikasiHapusInspektorat");
        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/detail_inspektorat.php",
            type        : "POST",
            dataType    : "json",
            data        : {id_inspektorat: id_inspektorat},
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    var id_provinsi=response.data_detail.id_provinsi;
                    var id_kabkot=response.data_detail.id_kabkot;
                    var nama_inspektorat=response.data_detail.nama_inspektorat;
                    var telepon=response.data_detail.telepon;
                    var alamat=response.data_detail.alamat;
                    
                    // Reset tombol
                    $ButtonProses.html(ButtonElement);
                    $ButtonProses.prop("disabled", false);

                    //Kosongkan Notifikasi
                    $Notifikasi.html('');

                    //Tempelkan Komponen
                    $("#put_id_inspektorat_for_deleter").val(id_inspektorat);
                    $("#FormHapusInspektorat").html(`
                        <div class="row mb-2">
                            <div class="col-4"><small>Inspektorat</small></div>
                            <div class="col-8"><small class="text text-grayish">${nama_inspektorat}</small></div>
                        </div> 
                        <div class="row mb-2">
                            <div class="col-4"><small>Kontak/Tel</small></div>
                            <div class="col-8"><small class="text text-grayish">${telepon}</small></div>
                        </div> 
                        <div class="row mb-2">
                            <div class="col-4"><small>Alamat</small></div>
                            <div class="col-8"><small class="text text-grayish">${alamat}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12"><small>Apakah anda yakin akan menghapus data tersebut?</small></div>
                        </div>   
                    `);
                } else {
                    // Tampilkan pesan error
                    $Notifikasi.html(
                        `<div class="alert alert-danger" role="alert">${response.message}</div>`
                    );
                    $ButtonProses.html(ButtonElement).prop("disabled", true);
                }
            },
            error: function () {
                $Notifikasi.html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
                $ButtonProses.html(ButtonElement).prop("disabled", true);
            },
        });
    });

    //Proses Hapus Inspektorat
    $("#ProsesHapusInspektorat").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let $ModalElement = $("#ModalHapusInspektorat");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        let $ButtonProses = $("#ButtonHapusInspektorat");
        let $Notifikasi = $("#NotifikasiHapusInspektorat");
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);

        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/ProsesHapusInspektorat.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {

                    //Tampilkan Data
                    ShowInspektorat(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Inpektorat Berhasil!',
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

    //Event ketika detail_inspektorat di click
    $(document).on('click', '.detail_inspektorat', function() {
        var id_inspektorat = $(this).data('id');
        height = $(window).scrollTop();
        ShowDetailInspektorat(id_inspektorat,0);
    });
    //Event ketika kembali_ke_data_inspektorat di click
    $(document).on('click', '#kembali_ke_data_inspektorat', function() {
        ShowInspektorat(height);
    });

    //Untuk menampilkan password
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");
    const eyeIcon = document.querySelector("#eyeIcon");

    togglePassword.addEventListener("click", function () {
        // Toggle jenis input antara 'password' dan 'text'
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Toggle ikon mata
        eyeIcon.classList.toggle("bi-eye");
        eyeIcon.classList.toggle("bi-eye-slash");
    });
    
    
    //Validasi File Foto
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

    
    //Generate Password
    $('#GeneratePassword').on('click', function () {
        var length = 10;
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var password = "";

        for (var i = 0, n = charset.length; i < length; ++i) {
        password += charset.charAt(Math.floor(Math.random() * n));
        }

        $('#password').val(password); // Set password input dengan hasil random
    });
    $('#GeneratePassword2').on('click', function () {
        var length = 10;
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var password = "";

        for (var i = 0, n = charset.length; i < length; ++i) {
        password += charset.charAt(Math.floor(Math.random() * n));
        }

        $('#password_edit').val(password); // Set password input dengan hasil random
    });

    //Ketika Tambah Akses
    $('#ModalTambahAkses').on('show.bs.modal', function (e) {
        var id_inspektorat = $(e.relatedTarget).data('id');
        //Put id_inspektorat ke form
        $('#put_id_inspektorat_to_tambah_akses').val(id_inspektorat);

        //Kosongkan Notifikasi
        $('#NotifikasiTambahAkses').html('');

        //Kosongkan Validasi Upload
        $('#NotifikasiValidasiFile').html('');
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
            url         : "_Page/Inspektorat/ProsesTambahAkses.php",
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
                    $('#TabelAkses').html('Loading...');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelAkses.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelAkses').html(data);
                        }
                    });
                    
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
                $('#NotifikasiEditAkses').html('');
            }
        });
    });

    //Proses Edit Akses
    $("#ProsesEditAkses").on("submit", function (e) {
        e.preventDefault();
        //Tangkap id_inspektorat
        var id_inspektorat= $("#TambahAkses").data('id');
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
                    $('#TabelAkses').html('Loading...');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelAkses.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelAkses').html(data);
                        }
                    });
                    
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

    //Modal Edit Password
    $('#ModalEditPassword').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        
        //Reset Form
        $("#ProsesEditPassword")[0].reset();
        $('#NotifikasiEditPassword').html("");

        //Tempelkan id_akases
        $('#put_id_akses_for_edit_password').val(id_akses);

        //Cek Form Password
        let passwordField = $('#password_edit');
        let confirmPasswordField = $('#Ulangi_password_edit');

        // Cek status checkbox, ubah type input
        if ($(this).is(':checked')) {
            passwordField.attr('type', 'text');
            confirmPasswordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
            confirmPasswordField.attr('type', 'password');
        }
    });

    //Menampilkan Password
    $('#tampilkan_password').on('change', function(){
        let passwordField = $('#password_edit');
        let confirmPasswordField = $('#Ulangi_password_edit');

        // Cek status checkbox, ubah type input
        if ($(this).is(':checked')) {
            passwordField.attr('type', 'text');
            confirmPasswordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
            confirmPasswordField.attr('type', 'password');
        }
    });

    //Proses Edit Password
    $("#ProsesEditPassword").on("submit", function (e) {
        e.preventDefault();
        //Tangkap id_inspektorat
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalEditPassword");
        let $Notifikasi = $("#NotifikasiEditPassword");
        let $ButtonProses = $("#ButtonEditPassword");
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
                    
                    //reset form
                    $("#ProsesEditPassword")[0].reset();

                    //Tampilkan Data Akses
                    $('#TabelAkses').html('Loading...');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelAkses.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelAkses').html(data);
                        }
                    });
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Password Berhasil!',
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

    //Modal Edit Foto
    $('#ModalEditFoto').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        
        //Reset Form
        $("#ProsesEditFoto")[0].reset();
        $('#NotifikasiEditFoto').html("");
        $('#NotifikasiValidasiFileEdit').html("");

        //Tempelkan id_akases
        $('#put_id_akses_for_edit_foto').val(id_akses);
    });

    //Validasi File Foto Edit
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

            $('#NotifikasiValidasiFileEdit').text('File valid Dan Siap Untuk Diupload.').addClass('text-success');
        }
    });

    //Proses Edit Foto
    $("#ProsesEditFoto").on("submit", function (e) {
        e.preventDefault();
        //Tangkap id_inspektorat
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalEditFoto");
        let $Notifikasi = $("#NotifikasiEditFoto");
        let $ButtonProses = $("#ButtonEditFoto");
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
                    
                    //reset form
                    $("#ProsesEditFoto")[0].reset();

                    //Tampilkan Data Akses
                    $('#TabelAkses').html('Loading...');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelAkses.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelAkses').html(data);
                        }
                    });
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Foto Berhasil!',
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

    //Modal Hapus Akses
    $('#ModalHapusAkses').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        $('#FormHapusAkses').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/detail_akses.php',
            data        : {id_akses: id_akses},
            dataType    : "json",
            success     : function(response){
                if(response.status==="Success"){
                    $('#ButtonHapusAkses').prop("disabled", false);
                    $('#FormHapusAkses').html(`
                        <div class="row mb-3">
                            <div class="col-4"><small>Nama</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.nama}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Kontak</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.kontak}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Email</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.email}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Akses</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.akses}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Datetime</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.timestamp_creat}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                Apakah anda yakin akan menghapus data tersebut?
                            </div>
                        </div>
                    `);
                }else{
                    $('#FormHapusAkses').html(
                        '<div class="alert alert-danger" role="alert">Error : '+response.message+'</div>'
                    );
                    $('#ButtonHapusAkses').prop("disabled", true);
                }
            },
            error: function () {
                $('#NotifikasiEditAkses').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
                $('#ButtonHapusAkses').prop("disabled", true);
            },
        });
        //Tempelkan id_akases
        $('#put_id_akses_for_hapus_akses').val(id_akses);
        $('#NotifikasiEditAkses').html("");
    });

    //Proses Hapus Akses
    $("#ProsesHapusAkses").on("submit", function (e) {
        e.preventDefault();
        //Tangkap id_inspektorat
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalHapusAkses");
        let $Notifikasi = $("#NotifikasiEditFoto");
        let $ButtonProses = $("#ButtonHapusAkses");
        let ButtonElement = '<i class="bi bi-chack"></i> Ya, Hapus';
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
                    
                    //reset form
                    $("#ProsesHapusAkses")[0].reset();

                    //Tampilkan Data Akses
                    $('#TabelAkses').html('Loading...');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelAkses.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelAkses').html(data);
                        }
                    });
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Akses Berhasil!',
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

    //Modal Tambah OPD
    $('#ModalTambahOpd').on('show.bs.modal', function (e) {
        var id_inspektorat = $(e.relatedTarget).data('id');
        
        //Reset Form
        $("#ProsesTambahOpd")[0].reset();

        //Hapus Notifikasi
        $('#NotifikasiTambahOpd').html("");

        //Tempelkan id_akases
        $('#put_id_inspektorat_for_tambah_opd').val(id_inspektorat);
    });
    //Proses Tambah OPD
    $("#ProsesTambahOpd").on("submit", function (e) {
        e.preventDefault();
        var height = $(window).scrollTop();
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalTambahOpd");
        let $Notifikasi = $("#NotifikasiTambahOpd");
        let $ButtonProses = $("#ButtonTambahOpd");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);

        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/Inspektorat/ProsesTambahOpd.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahOpd")[0].reset();

                    //Tampilkan Data
                    ShowDetailInspektorat(id_inspektorat,height);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah OPD Berhasil!',
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

    //Modal Detail OPD
    $('#ModalDetailOpd').on('show.bs.modal', function (e) {
        var id_opd = $(e.relatedTarget).data('id');

        //Kosongkan Notifikasi
        $('#FormDetailOpd').html('Loading...');

        $.ajax({
            url         : "_Page/Inspektorat/detail_opd.php",
            type        : "POST",
            data        : {id_opd: id_opd},
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    $('#FormDetailOpd').html(`
                        <div class="row mb-3">
                            <div class="col-4"><small>Nama OPD</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.nama_opd}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Kontak</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.telepon}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Alamat</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.alamat}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Provinsi</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.provinsi}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Kabupaten/Kota</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.kabkot}</small></div>
                        </div>
                    `);
                } else {
                    // Tampilkan pesan error
                    $('#FormDetailOpd').html(
                        `<div class="alert alert-danger" role="alert">${response.message}</div>`
                    );
                }
            },
            error: function () {
                $('#FormDetailOpd').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
            },
        });
    });

    //Modal Edit OPD
    $('#ModalEditOpd').on('show.bs.modal', function (e) {
        var id_opd = $(e.relatedTarget).data('id');
        //Kosongkan Notifikasi
        $('#FormEditOpd').html('Loading...');
        $('#NotifikasiEditOpd').html('');
        $.ajax({
            url         : "_Page/Inspektorat/detail_opd.php",
            type        : "POST",
            data        : {id_opd: id_opd},
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    $('#put_id_opd').val(id_opd);
                    $('#FormEditOpd').html(`
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="opd_edit">Nama OPD</label>
                                <input type="text" name="opd" id="opd_edit" class="form-control" value="${response.data_detail.nama_opd}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="telepon_edit">Telepon</label>
                                <input type="text" name="telepon" id="telepon_edit" class="form-control" inputmode="numeric" value="${response.data_detail.telepon}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="alamat_edit">Alamat</label>
                                <textarea name="alamat" id="alamat_edit" class="form-control">${response.data_detail.alamat}</textarea>
                            </div>
                        </div>
                    `);
                    $('#ButtonEditOpd').prop("disabled", false);
                } else {
                    // Tampilkan pesan error
                    $('#FormEditOpd').html(
                        `<div class="alert alert-danger" role="alert">${response.message}</div>`
                    );
                    $('#ButtonEditOpd').prop("disabled", true);
                }
            },
            error: function () {
                $('#FormEditOpd').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
                $('#ButtonEditOpd').prop("disabled", true);
            },
        });
    });

    //Proses Edit OPD
    $("#ProsesEditOpd").on("submit", function (e) {
        e.preventDefault();
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalEditOpd");
        let $Notifikasi = $("#NotifikasiEditOpd");
        let $ButtonProses = $("#ButtonEditOpd");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);

        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesEditOpd.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditOpd")[0].reset();

                    //Tampilkan Data
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelOpd.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelOpd').html(data);
                        }
                    });
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit OPD Berhasil!',
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

    //Modal Hapus OPD
    $('#ModalHapusOpd').on('show.bs.modal', function (e) {
        var id_opd = $(e.relatedTarget).data('id');
        
        //Loading Form Hapus
        $('#FormHapusOpd').html('Loading...');

        //Kosongkan Notifikasi
        $('#NotifikasiHapusOpd').html('');

        $.ajax({
            url         : "_Page/Inspektorat/detail_opd.php",
            type        : "POST",
            data        : {id_opd: id_opd},
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    $('#put_id_opd_hapus').val(id_opd);
                    $('#FormHapusOpd').html(`
                        <div class="row mb-3">
                            <div class="col-4"><small>Nama OPD</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.nama_opd}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Kontak</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.telepon}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Alamat</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.alamat}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Provinsi</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.provinsi}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Kabupaten/Kota</small></div>
                            <div class="col-8"><small class="text text-grayish">${response.data_detail.kabkot}</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12"><small>Apakah Anda Yakin Akan Menghapus OPD tersebut?</small></div>
                        </div>
                    `);
                    $('#ButtonHapusOpd').prop("disabled", false);
                } else {
                    // Tampilkan pesan error
                    $('#FormHapusOpd').html(
                        `<div class="alert alert-danger" role="alert">${response.message}</div>`
                    );
                    $('#ButtonHapusOpd').prop("disabled", true);
                }
            },
            error: function () {
                $('#FormHapusOpd').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi.</div>'
                );
                $('#ButtonHapusOpd').prop("disabled", true);
            },
        });
    });

    //Proses Hapus OPD
    $("#ProsesHapusOpd").on("submit", function (e) {
        e.preventDefault();
        var id_inspektorat= $("#TambahAkses").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalHapusOpd");
        let $Notifikasi = $("#NotifikasiHapusOpd");
        let $ButtonProses = $("#ButtonHapusOpd");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);

        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesHapusOpd.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditOpd")[0].reset();

                    //Tampilkan Data
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Inspektorat/TabelOpd.php',
                        data 	    :  {id: id_inspektorat},
                        success     : function(data){
                            $('#TabelOpd').html(data);
                        }
                    });
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus OPD Berhasil!',
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
});