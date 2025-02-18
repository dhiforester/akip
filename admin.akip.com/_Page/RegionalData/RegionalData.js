//Fungsi Menampilkan Provinsi
function showProvinsi(height) {
    $('#ShowProvinsi').show();
    $('#ShowKabupaten').hide();
    $('#ShowOpd').hide();
    $('#showDetailOpd').hide();
    var FilterProvinsi = $('#FilterProvinsi').serialize();
    $('#TabelProvinsi').html('<tr><td colspan="4" class="text-center">Loading...</td></tr>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/TabelProvinsi.php',
        data 	    :  FilterProvinsi,
        success     : function(data){
            $('#TabelProvinsi').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}

//Fungsi Menampilkan Kabupaten
function showKabupaten(height) {
    $('#ShowProvinsi').hide();
    $('#ShowKabupaten').show();
    $('#ShowOpd').hide();
    $('#showDetailOpd').hide();
    $('#TabelKabupaten').html('Loading...');
    var FilterKabupaten = $('#FilterKabupaten').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/TabelKabupaten.php',
        data 	    :  FilterKabupaten,
        success     : function(data){
            $('#TabelKabupaten').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}
//Fungsi Menampilkan Opd
function showOpd(height) {
    $('#ShowProvinsi').hide();
    $('#ShowKabupaten').hide();
    $('#ShowOpd').show();
    $('#showDetailOpd').hide();
    $('#TabelOpd').html('Loading...');
    var FilterOpd = $('#FilterOpd').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/TabelOpd.php',
        data 	    :  FilterOpd,
        success     : function(data){
            $('#TabelOpd').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}
//Fungsi Menampilkan Detail OPD
function showDetailOpd(id_opd) {
    $('#ShowProvinsi').hide();
    $('#ShowKabupaten').hide();
    $('#ShowOpd').hide();
    $('#showDetailOpd').show();
    $('#detail_opd').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/DetailOpd.php',
        data 	    :  {id_opd: id_opd},
        success     : function(data){
            $('#detail_opd').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    showProvinsi(0);
    
    //Ketika 'FilterProvinsi' di submit
    $(document).on('submit', '#FilterProvinsi', function() {
        //Reset Halaman
        $('#page_provinsi').val(1);

        //Tutup Modal
        $('#ModalFilterProvinsi').modal('hide');

        //Tampilkan Data
        showProvinsi(0);
    });

    //Ketika 'FilterKabupaten' di submit
    $(document).on('submit', '#FilterKabupaten', function() {
        //Reset Halaman
        $('#page_kabupaten').val(1);

        //Tutup Modal
        $('#ModalFilterKabupaten').modal('hide');

        //Tampilkan Data
        showKabupaten(0);
    });

    

    //Ketika 'show_tabel_kabupaten' di click
    $(document).on('click', '.show_tabel_kabupaten', function() {
        var id = $(this).data('id');

        //Tempelkan Ke Filter
        $('#id_provinsi').val(id);
        $('#put_id_provinsi_for_tambah_kabkot').val(id);

        //Hitung Ketinggian Sekarang
        height = $(window).scrollTop();
        showKabupaten(0);
    });
    //Ketika 'show_tabel_opd' di click
    $(document).on('click', '.show_tabel_opd', function() {
        var id = $(this).data('id');

        //Tempelkan Ke Filter
        $('#id_kabkot').val(id);
        $('#button_tambah_opd').val(id);

        //Tempelkan ke Form tambah OPD
        $('#put_id_kabkot_for_tambah_opd').val(id);

        //Hitung Ketinggian Sekarang
        height = $(window).scrollTop();
        showOpd(0);
    });
    //Ketika 'show_detail_opd' di click
    $(document).on('click', '.show_detail_opd', function() {
        var id_opd = $(this).data('id');

        //Hitung Ketinggian Sekarang
        height = $(window).scrollTop();
        showDetailOpd(id_opd);
    });

    //Ketika 'back_to_provinsi' di click
    $(document).on('click', '#back_to_provinsi', function() {
        //Reset Filter Kabkot
        $('#page_kabupaten').val(1);
        $('#keyword_kabupaten').val("");
        //Kembali Ke Provinsi
        showProvinsi(height);
    });
    //Ketika 'back_to_provinsi' di click
    $(document).on('click', '#back_to_kabupaten', function() {
        showKabupaten(height);
    });
    //Ketika 'back_to_opd' di click
    $(document).on('click', '#back_to_opd', function() {
        showOpd(height);
    });

    //Pagging Provinsi
    $(document).on('click', '#next_button_provinsi', function() {
        var page_now = parseInt($('#page_provinsi').val(), 10); // Pastikan nilai diambil sebagai angka
        var next_page = page_now + 1;
        $('#page_provinsi').val(next_page);
        showProvinsi(0);
    });
    $(document).on('click', '#prev_button_provinsi', function() {
        var page_now = parseInt($('#page_provinsi').val(), 10); // Pastikan nilai diambil sebagai angka
        var next_page = page_now - 1;
        $('#page_provinsi').val(next_page);
        showProvinsi(0);
    });
    //Pagging Kabupaten
    $(document).on('click', '#next_button_kabupaten', function() {
        var page_now = parseInt($('#page_kabupaten').val(), 10); // Pastikan nilai diambil sebagai angka
        var next_page = page_now + 1;
        $('#page_kabupaten').val(next_page);
        showKabupaten(0);
    });
    $(document).on('click', '#prev_button_kabupaten', function() {
        var page_now = parseInt($('#page_kabupaten').val(), 10); // Pastikan nilai diambil sebagai angka
        var next_page = page_now - 1;
        $('#page_kabupaten').val(next_page);
        showKabupaten(0);
    });

    //Proses Tambah Provinsi
    $("#ProsesTambahProvinsi").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalTambahProvinsi");
        let $Notifikasi = $("#NotifikasiTambahProvinsi");
        let $ButtonProses = $("#ButtonTambahProvinsi");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesTambahProvinsi.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahProvinsi")[0].reset();

                    //Tampilkan Data
                    showProvinsi(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Provinsi Berhasil!',
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
    
    //Modal Edit Provinsi
    $('#ModalEditProvinsi').on('show.bs.modal', function (e) {
        var id_provinsi = $(e.relatedTarget).data('id');
        var provinsi = $(e.relatedTarget).data('value');

        //Put Parameter
        $('#id_provinsi_edit').val(id_provinsi);
        $('#provinsi_edit').val(provinsi);

        //Kosongkan Notifikasi
        $('#NotifikasiEditProvinsi').html('');
    });

    //Proses Edit Provinsi
    $("#ProsesEditProvinsi").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalEditProvinsi");
        let $Notifikasi = $("#NotifikasiEditProvinsi");
        let $ButtonProses = $("#ButtonEditProvinsi");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesEditProvinsi.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditProvinsi")[0].reset();

                    //Tampilkan Data
                    showProvinsi(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Provinsi Berhasil!',
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

    //Modal Hapus Provinsi
    $('#ModalHapusProvinsi').on('show.bs.modal', function (e) {
        var id_provinsi = $(e.relatedTarget).data('id');
        var provinsi = $(e.relatedTarget).data('value');

        //Put Parameter
        $('#id_provinsi_hapus').val(id_provinsi);
        $('#put_provinsi_id_for_delete').html(id_provinsi);
        $('#put_provinsi_name_for_delete').html(provinsi);

        //Kosongkan Notifikasi
        $('#NotifikasiHapusProvinsi').html('Apakah Anda Yakin Akan Menghapus Data Tersebut?');
    });

    //Proses Hapus Provinsi
    $("#ProsesHapusProvinsi").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalHapusProvinsi");
        let $Notifikasi = $("#NotifikasiHapusProvinsi");
        let $ButtonProses = $("#ButtonHapusProvinsi");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesHapusProvinsi.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusProvinsi")[0].reset();

                    //Tampilkan Data
                    showProvinsi(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Provinsi Berhasil!',
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
    //Proses Tambah Kabkot
    $("#ProsesTambahKabkot").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalTambahKabkot");
        let $Notifikasi = $("#NotifikasiTambahKabkot");
        let $ButtonProses = $("#ButtonTambahKabkot");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesTambahKabkot.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahKabkot")[0].reset();

                    //Tampilkan Data
                    showKabupaten(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Kabupaten Kota Berhasil!',
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

    //Modal Edit Kabkot
    $('#ModalEditKabkot').on('show.bs.modal', function (e) {
        var id_kabkot = $(e.relatedTarget).data('id');
        var kabkot = $(e.relatedTarget).data('value');

        //Put Parameter
        $('#put_id_kabkot_for_edit').val(id_kabkot);
        $('#kabkot_edit').val(kabkot);

        //Kosongkan Notifikasi
        $('#NotifikasiEditKabkot').html('');
    });

    //Proses Edit Kabkot
    $("#ProsesEditKabkot").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalEditKabkot");
        let $Notifikasi = $("#NotifikasiEditKabkot");
        let $ButtonProses = $("#ButtonEditKabkot");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesEditKabkot.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditKabkot")[0].reset();

                    //Tampilkan Data
                    showKabupaten(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Kabupaten Kota Berhasil!',
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

    //Modal Hapus Kabkot
    $('#ModalHapusKabkot').on('show.bs.modal', function (e) {
        var id_kabkot = $(e.relatedTarget).data('id');
        var kabkot = $(e.relatedTarget).data('value');

        //Put Parameter
        $('#id_kabkot_hapus').val(id_kabkot);
        $('#put_id_kabkot_hapus').html(id_kabkot);
        $('#put_kabkot_hapus').html(kabkot);

        //Kosongkan Notifikasi
        $('#NotifikasiHapusKabkot').html('Apakah Anda Yakin Akan Menghapus Data Tersebut?');
    });

    //Proses Hapus Kabkot
    $("#ProsesHapusKabkot").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalHapusKabkot");
        let $Notifikasi = $("#NotifikasiHapusKabkot");
        let $ButtonProses = $("#ButtonHapusKabkot");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/RegionalData/ProsesHapusKabkot.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusKabkot")[0].reset();

                    //Tampilkan Data
                    showKabupaten(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Kabupaten Kota Berhasil!',
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

    //Proses Tambah OPD
    $("#ProsesTambahOpd").on("submit", function (e) {
        e.preventDefault();

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
            url         : "_Page/RegionalData/ProsesTambahOpd.php",
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
                    showOpd(0);
                    
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

    //Modal Edit OPD
    $('#ModalEditOpd').on('show.bs.modal', function (e) {
        var id_opd = $(e.relatedTarget).data('id');
        var opd = $(e.relatedTarget).data('name');
        var telepon = $(e.relatedTarget).data('tel');
        var alamat = $(e.relatedTarget).data('alamat');

        //Put Parameter
        $('#put_id_opd').val(id_opd);
        $('#opd_edit').val(opd);
        $('#telepon_edit').val(telepon);
        $('#alamat_edit').val(alamat);

        //Kosongkan Notifikasi
        $('#NotifikasiEditOpd').html('');
    });

    //Proses Edit OPD
    $("#ProsesEditOpd").on("submit", function (e) {
        e.preventDefault();

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
                    showOpd(0);
                    
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
        var opd = $(e.relatedTarget).data('name');
        var telepon = $(e.relatedTarget).data('tel');
        var alamat = $(e.relatedTarget).data('alamat');

        //Put Parameter
        $('#id_opd_hapus').val(id_opd);
        $('#put_nama_opd_hapus').html(opd);
        $('#put_telepon_hapus').html(telepon);
        $('#put_alamat_hapus').html(alamat);

        //Kosongkan Notifikasi
        $('#NotifikasiHapusOpd').html('Apakah Anda Yakin Akan Menghapus Data Tersebut?');
    });

    //Proses Hapus OPD
    $("#ProsesHapusOpd").on("submit", function (e) {
        e.preventDefault();

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
                    showOpd(0);
                    
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
    $('#togglePassword2').click(function () {
        const passwordField = $('#password_edit');
        const eyeIcon = $('#eyeIcon');

        // Toggle tipe input antara password dan text
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash'); // Ubah ikon ke mata tertutup
        } else {
            passwordField.attr('type', 'password');
            eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye'); // Ubah ikon ke mata terbuka
        }
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
        var id_opd = $(e.relatedTarget).data('id');

        //Put Parameter
        $('#put_id_opd_tambah_akses').val(id_opd);

        //Kosongkan Notifikasi
        $('#NotifikasiTambahAkses').html('');
    });

    //Proses Tambah Akses
    $("#ProsesTambahAkses").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let id_opd = $("#put_id_opd_tambah_akses").val();
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
            url         : "_Page/RegionalData/ProsesTambahAkses.php",
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

                    //Tampilkan Data
                    showDetailOpd(id_opd)
                    
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

    //Modal Detail Akses
    $('#ModalDetailAkses').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        $('#FormDetailAkses').html('Loading...');
        $.ajax({
            url         : "_Page/RegionalData/detail-akses.php",
            type        : "POST",
            dataType    : "JSON",
            data        : {id_akses: id_akses},
            success: function (response) {
                if (response.status === "Success") {
                    let nama=response.data_detail.nama;
                    let email=response.data_detail.email;
                    let kontak=response.data_detail.kontak;
                    let akses=response.data_detail.akses;
                    let timestamp_creat=response.data_detail.timestamp_creat;
                    let foto=response.data_detail.foto;
                    let url_foto=response.data_detail.url_foto;
                    $('#FormDetailAkses').html(`
                        <div class="row mb-4">
                            <div class="col-12 text-center">
                                <img src="${url_foto}" alt="" width="200px" height="200px" class="rounded-circle">
                            </div>
                        </div>
                        <div class="row mb-2 mt-3">
                            <div class="col-6"><small>Nama</small></div>
                            <div class="col-6"><small class="text text-grayish">${nama}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Email</small></div>
                            <div class="col-6"><small class="text text-grayish">${email}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Kontak</small></div>
                            <div class="col-6"><small class="text text-grayish">${kontak}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Akses</small></div>
                            <div class="col-6"><small class="text text-grayish">${akses}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Date Creat</small></div>
                            <div class="col-6"><small class="text text-grayish">${timestamp_creat}</small></div>
                        </div>
                    `);
                }else{
                    $('#FormDetailAkses').html(
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response.message+'</div>'
                    );
                }
            },
            error: function () {
                $('#FormDetailAkses').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response+'</div>'
                );
            },
        });
    });
    //Modal Edit Akses
    $('#ModalEditAkses').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        $('#FormEditAkses').html('Loading...');
        $.ajax({
            url         : "_Page/RegionalData/FormEditAkses.php",
            type        : "POST",
            data        : {id_akses: id_akses},
            success: function (response) {
                $('#FormEditAkses').html(response);
            }
        });
    });

    //Proses Edit Akses
    $("#ProsesEditakses").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let id_opd = $("#put_id_opd_for_edit_akses").val();
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
            url         : "_Page/RegionalData/ProsesEditakses.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditakses")[0].reset();

                    //Tampilkan Data
                    showDetailOpd(id_opd)
                    
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
        var id_opd = $(e.relatedTarget).data('idopd');
        //Tempelkan Nilai
        $('#put_id_akses_for_edit_password').val(id_akses);
        $('#put_id_opd_for_edit_password').val(id_opd);
    });

    //Proses Edit Password
    $("#ProsesUbahPassword").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let id_opd = $("#put_id_opd_for_edit_password").val();
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
            url         : "_Page/RegionalData/ProsesUbahPassword.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesUbahPassword")[0].reset();

                    //Tampilkan Data
                    showDetailOpd(id_opd)
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Proses Ubah Password Berhasil!',
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

        $('#NotifikasiValidasiFileEdit').text('File valid.').addClass('text-success');
        }
    });

    //Modal Ubah Foto
    $('#ModalUbahFoto').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        var id_opd = $(e.relatedTarget).data('idopd');
        //Tempelkan Nilai
        $('#put_id_akses_for_edit_foto').val(id_akses);
        $('#put_id_opd_for_edit_foto').val(id_opd);
    });

    //Proses Edit Foto
    $("#ProsesUbahFoto").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let id_opd = $("#put_id_opd_for_edit_foto").val();
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
            url         : "_Page/RegionalData/ProsesUbahFoto.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesUbahFoto")[0].reset();

                    //Tampilkan Data
                    showDetailOpd(id_opd)
                    
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

    //Modal Hapus Akses
    $('#ModalHapusAkses').on('show.bs.modal', function (e) {
        var id_akses = $(e.relatedTarget).data('id');
        var id_opd = $(e.relatedTarget).data('idopd');
        //Tempelkan Nilai
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $('#put_id_akses_for_hapus').val(id_akses);
        $('#put_id_opd_for_hapus').val(id_opd);
        //Disabled Tombol
        $('#ButtonHapusAkses').html(ButtonElement).prop("disabled", true);
        //Menampilkan Detail
        $('#FormDetailAkses').html('Loading...');
        $.ajax({
            url         : "_Page/RegionalData/detail-akses.php",
            type        : "POST",
            dataType    : "JSON",
            data        : {id_akses: id_akses},
            success: function (response) {
                if (response.status === "Success") {
                    let nama=response.data_detail.nama;
                    let email=response.data_detail.email;
                    let kontak=response.data_detail.kontak;
                    let akses=response.data_detail.akses;
                    let timestamp_creat=response.data_detail.timestamp_creat;
                    let foto=response.data_detail.foto;
                    $('#FormHapusAkses').html(`
                        <div class="row mb-2 mt-3">
                            <div class="col-6"><small>Nama</small></div>
                            <div class="col-6"><small class="text text-grayish">${nama}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Email</small></div>
                            <div class="col-6"><small class="text text-grayish">${email}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Kontak</small></div>
                            <div class="col-6"><small class="text text-grayish">${kontak}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Akses</small></div>
                            <div class="col-6"><small class="text text-grayish">${akses}</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small>Date Creat</small></div>
                            <div class="col-6"><small class="text text-grayish">${timestamp_creat}</small></div>
                        </div>
                    `);
                    $('#NotifikasiHapusAkses').html(`
                        <div class="row mb-2">
                            <div class="col-12"><small>Apakah anda yakin akan menghapus data tersebut?</small></div>
                        </div>
                    `);
                    $('#ButtonHapusAkses').html(ButtonElement).prop("disabled", false);
                }else{
                    $('#ButtonHapusAkses').html(ButtonElement).prop("disabled", true);
                    $('#FormHapusAkses').html(
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response.message+'</div>'
                    );
                }
            },
            error: function () {
                $('#ButtonHapusAkses').html(ButtonElement).prop("disabled", true);
                $('#FormHapusAkses').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response+'</div>'
                );
            },
        });
    });

    //Proses Hapus Akses
    $("#ProsesHapusAkses").on("submit", function (e) {
        e.preventDefault();

        // Tombol loading
        let id_opd = $("#put_id_akses_for_hapus").val();
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
            url         : "_Page/RegionalData/ProsesHapusAkses.php",
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

                    //Tampilkan Data
                    showDetailOpd(id_opd)
                    
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
});
