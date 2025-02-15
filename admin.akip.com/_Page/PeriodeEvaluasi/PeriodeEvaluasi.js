//Fungsi Show Periode
function showPeriode(height) {
    $('#ShowDataPeriodeEvaluasi').show();
    $('#ShowDetailPeriode').hide();
    $('#TabelPeriode').html('<tr><td colspan="4" class="text-center">Loading...</td></tr>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/TabelPeriode.php',
        success     : function(data){
            $('#TabelPeriode').html(data);
            $('html, body').animate({ scrollTop: height }, 300);
        }
    });
}
//Fungsi Menampilkan Detail Periode
function showDetailPeriode(id_evaluasi_periode) {
    $('#ShowDataPeriodeEvaluasi').hide();
    $('#ShowDetailPeriode').show();
    $('#DetailPeriodeEvaluasi').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/DetailPeriodeEvaluasi.php',
        data 	    : {id_evaluasi_periode: id_evaluasi_periode},
        success     : function(data){
            $('#DetailPeriodeEvaluasi').html(data);
            ketinggian=0;
            $('html, body').animate({ scrollTop: ketinggian }, 300);
        }
    });
}
//Fungsi Menampilkan Komponen
function showKomponen(id_evaluasi_periode) {
    var level="Komponen";
    var title="Tambah Komponen";
    $('#level_indikator').html('<b># Komponen</b>');

    //Tempelkan Data Pada Modal
    $('#tabel_indikator').html('Loading..');
    $('#put_id_evaluasi_periode_for_indikator').val(id_evaluasi_periode);

    //Menampilkan Data
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/tabel_komponen.php',
        data 	    : {id_evaluasi_periode: id_evaluasi_periode},
        success     : function(data){
            $('#tabel_indikator').html(data);
            // Menempelkan nilai ke atribut tombol
            $('#TambahKomponen').attr({
                'data-id': id_evaluasi_periode,
                'data-level': level,
                'title': title
            });

            //Khusus untuk fungsi ini tombol kembali di sembunyikan
            $('#kembali_ke_komponen').hide();
            $('#kembali_ke_sub_komponen').hide();
            $('#kembali_ke_kriteria').hide();
            //Sembunyikan Tombol Tambah
            $('#TambahKomponen').show();
            $('#TambahSubKomponen').hide();
            $('#TambahKriteria').hide();
            $('#TambahUraian').hide();
        }
    });
}

//Fungsi Menampilkan Sub Komponen
function showSubKomponen(id_komponen) {
    var level="Sub Komponen";
    var title="Tambah Sub Komponen";
    $('#level_indikator').html('# Komponen / <b>Sub Komponen</b>');
    $('#tabel_indikator').html('Loading..');
    //Tempelkan Data Pada Modal
    $('#put_id_komponen_for_indikator').val(id_komponen);

    //Menampilkan Data
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/tabel_sub_komponen.php',
        data 	    : {id_komponen: id_komponen},
        success     : function(data){
            $('#tabel_indikator').html(data);
            // Menempelkan nilai ke atribut tombol
            $('#TambahSubKomponen').attr({
                'data-id': id_komponen,
                'data-level': level,
                'title': title
            });
            //Khusus untuk fungsi ini tombol kembali di sembunyikan
            $('#kembali_ke_komponen').show();
            $('#kembali_ke_sub_komponen').hide();
            $('#kembali_ke_kriteria').hide();
            //Sembunyikan Tombol Tambah
            $('#TambahKomponen').hide();
            $('#TambahSubKomponen').show();
            $('#TambahKriteria').hide();
            $('#TambahUraian').hide();
        }
    });
}
//Fungsi Menampilkan Kriteria
function showKriteria(id_komponen_sub) {
    var level="Kriteria";
    var title="Tambah Kriteria";
    $('#level_indikator').html('# Komponen / # Sub Komponen / <b>Kriteria</b>');
    $('#tabel_indikator').html('Loading..');
    //Tempelkan Data Pada Modal
    $('#put_id_komponen_sub_for_indikator').val(id_komponen_sub);

    //Menampilkan Data
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/tabel_kriteria.php',
        data 	    : {id_komponen_sub: id_komponen_sub},
        success     : function(data){
            $('#tabel_indikator').html(data);
            // Menempelkan nilai ke atribut tombol
            $('#TambahKriteria').attr({
                'data-id': id_komponen_sub,
                'data-level': level,
                'title': title
            });
            //Khusus untuk fungsi ini tombol kembali di sembunyikan
            $('#kembali_ke_komponen').hide();
            $('#kembali_ke_sub_komponen').show();
            $('#kembali_ke_kriteria').hide();
            //Sembunyikan Tombol Tambah
            $('#TambahKomponen').hide();
            $('#TambahSubKomponen').hide();
            $('#TambahKriteria').show();
            $('#TambahUraian').hide();
        }
    });
}

//Fungsi Menampilkan Uraian
function showUraian(id_kriteria) {
    var level="Uraian";
    var title="Tambah Uraian";
    $('#level_indikator').html('# Komponen / # Sub Komponen / # Kriteria / <b>Uraian</b>');
    $('#tabel_indikator').html('Loading..');
    //Tempelkan Data Pada Modal
    $('#TambahUraian').attr({
        'data-id': id_kriteria
    });

    //Menampilkan Data
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/PeriodeEvaluasi/tabel_uraian.php',
        data 	    : {id_kriteria: id_kriteria},
        success     : function(data){
            $('#tabel_indikator').html(data);
            //Khusus untuk fungsi ini tombol kembali di sembunyikan
            $('#kembali_ke_komponen').hide();
            $('#kembali_ke_sub_komponen').hide();
            $('#kembali_ke_kriteria').show();
            //Sembunyikan Tombol Tambah
            $('#TambahKomponen').hide();
            $('#TambahSubKomponen').hide();
            $('#TambahKriteria').hide();
            $('#TambahUraian').show();
        }
    });
}

//Menampilkan Data Pertama Kali
$(document).ready(function() {
    var height=0;
    showPeriode(height);

    //Proses Tambah Periode
    $("#ProsesTambahPeriode").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalTambahPeriode");
        let $Notifikasi = $("#NotifikasiTambahPeriode");
        let $ButtonProses = $("#ButtonTambahPeriode");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);
    
        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesTambahPeriode.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahPeriode")[0].reset();

                    //Tampilkan Data
                    showPeriode(0);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Periode Berhasil!',
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

    //Modal Edit Periode
    $('#ModalEditPeriode').on('show.bs.modal', function (e) {
        var id_evaluasi_periode = $(e.relatedTarget).data('id');
        var mode = $(e.relatedTarget).data('mode');
        var $ButtonProses = $("#ButtonEditPeriode");
        var ButtonElement='<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html(ButtonElement).prop("disabled", true);
        $('#FormEditPeriode').html('Loading..');
        //Ketinggian
        height = $(window).scrollTop();
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/detail-periode.php",
            type        : "POST",
            dataType    : "JSON",
            data        : {id_evaluasi_periode: id_evaluasi_periode},
            success: function (response) {
                if (response.status === "Success") {
                    let periode=response.data_detail.periode;
                    let date_mulai=response.data_detail.date_mulai;
                    let date_selesai=response.data_detail.date_selesai;

                    $('#FormEditPeriode').html(`
                        <input type="hidden" name="mode" id="mode_edit_periode" class="form-control" value="${mode}">
                        <input type="hidden" name="id_evaluasi_periode" id="id_evaluasi_periode_edit" class="form-control" value="${id_evaluasi_periode}">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="periode_edit">Periode/Tahun</label>
                                <input type="text" name="periode" id="periode_edit" class="form-control" value="${periode}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="tanggal_mulai_edit">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai_edit" class="form-control" value="${date_mulai}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="tanggal_selesai_edit">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai_edit" class="form-control" value="${date_selesai}">
                            </div>
                        </div>
                    `);
                    $ButtonProses.html(ButtonElement).prop("disabled", false);
                    $('#NotifikasiEditPeriode').html('');
                }else{
                    $('#NotifikasiEditPeriode').html(
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response.message+'</div>'
                    );
                    $ButtonProses.html(ButtonElement).prop("disabled", true);
                }
            },
            error: function () {
                $('#NotifikasiEditPeriode').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response+'</div>'
                );
                $ButtonProses.html(ButtonElement).prop("disabled", true);
            },
        });
    });

    //Proses Edit Periode
    $("#ProsesEditPeriode").on("submit", function (e) {
        e.preventDefault();
        //Tangkap id dan mode
        var mode=$("#mode_edit_periode").val();
        var id=$("#id_evaluasi_periode_edit").val();
        // Tombol loading
        let $ModalElement = $("#ModalEditPeriode");
        let $Notifikasi = $("#NotifikasiEditPeriode");
        let $ButtonProses = $("#ButtonEditPeriode");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesEditPeriode.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditPeriode")[0].reset();

                    //Tampilkan Data
                    if(mode=="List"){
                        showPeriode(height);
                    }else{
                        showDetailPeriode(id);
                    }
                    
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Periode Berhasil!',
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

    //Modal Hapus Periode
    $('#ModalHapusPeriode').on('show.bs.modal', function (e) {
        var id_evaluasi_periode = $(e.relatedTarget).data('id');
        var $ButtonProses = $("#ButtonHapusPeriode");
        var ButtonElement='<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html(ButtonElement).prop("disabled", true);
        $('#FormHapusPeriode').html('Loading..');
        //Ketinggian
        height = $(window).scrollTop();
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/detail-periode.php",
            type        : "POST",
            dataType    : "JSON",
            data        : {id_evaluasi_periode: id_evaluasi_periode},
            success: function (response) {
                if (response.status === "Success") {
                    let periode=response.data_detail.periode;
                    let date_mulai=response.data_detail.date_mulai;
                    let date_selesai=response.data_detail.date_selesai;

                    $('#FormHapusPeriode').html(`
                        <input type="hidden" name="id_evaluasi_periode" class="form-control" value="${id_evaluasi_periode}">
                        <div class="row mb-3">
                            <div class="col-4">
                                <small>Periode Data</small>
                            </div>
                            <div class="col-8">
                                <small class="text text-grayish">${periode}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <small>Tanggal Mulai</small>
                            </div>
                            <div class="col-8">
                                <small class="text text-grayish">${date_mulai}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <small>Tanggal Selesai</small>
                            </div>
                            <div class="col-8">
                                <small class="text text-grayish">${date_selesai}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <small>Apakah anda yakin akan menghapus data tersebut?</small>
                            </div>
                        </div>
                    `);
                    $ButtonProses.html(ButtonElement).prop("disabled", false);
                    $('#NotifikasiHapusPeriode').html('');
                }else{
                    $('#NotifikasiHapusPeriode').html(
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response.message+'</div>'
                    );
                    $ButtonProses.html(ButtonElement).prop("disabled", true);
                }
            },
            error: function () {
                $('#NotifikasiHapusPeriode').html(
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan pada sistem. Silakan coba lagi. <br> Response : '+response+'</div>'
                );
                $ButtonProses.html(ButtonElement).prop("disabled", true);
            },
        });
    });

    //Proses Hapus
    $("#ProsesHapusPeriode").on("submit", function (e) {
        e.preventDefault();
    
        // Tombol loading
        let $ModalElement = $("#ModalHapusPeriode");
        let $Notifikasi = $("#NotifikasiHapusPeriode");
        let $ButtonProses = $("#ButtonHapusPeriode");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesHapusPeriode.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusPeriode")[0].reset();

                    //Tampilkan Data
                    showPeriode(height);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Periode Berhasil!',
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

    //show_detail_periode
    $(document).on('click', '.show_detail_periode', function() {
        height = $(window).scrollTop();
        var id_evaluasi_periode = $(this).data('id');
        showDetailPeriode(id_evaluasi_periode);
        showKomponen(id_evaluasi_periode);
    });

    //show_sub_komponen
    $(document).on('click', '.show_sub_komponen', function() {
        height = $(window).scrollTop();
        var id_komponen = $(this).data('id');
        showSubKomponen(id_komponen);
    });
    
    //show_kriteria
    $(document).on('click', '.show_kriteria', function() {
        height = $(window).scrollTop();
        var id_komponen_sub = $(this).data('id');
        showKriteria(id_komponen_sub);
    });

    //show_uraian
    $(document).on('click', '.show_uraian', function() {
        height = $(window).scrollTop();
        var id_kriteria = $(this).data('id');
        showUraian(id_kriteria);
    });
    //kembali_ke_periode
    $(document).on('click', '.kembali_ke_periode', function() {
        var id_evaluasi_periode = $(this).data('id');
        showPeriode(height);
    });

    //kembali_ke_komponen
    $(document).on('click', '#kembali_ke_komponen', function() {
        var id_evaluasi_periode =$('#put_id_evaluasi_periode_for_indikator').val();
        showKomponen(id_evaluasi_periode);
    });

    //kembali_ke_sub_komponen
    $(document).on('click', '#kembali_ke_sub_komponen', function() {
        var id_komponen =$('#put_id_komponen_for_indikator').val();
        showSubKomponen(id_komponen);
    });

    //kembali_ke_kriteria
    $(document).on('click', '#kembali_ke_kriteria', function() {
        var id_komponen_sub =$('#put_id_komponen_sub_for_indikator').val();
        showKriteria(id_komponen_sub);
    });
    //Modal Tambah Indikator
    $('#ModalTambahIndikator').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        var level = $(e.relatedTarget).data('level');

        //Atur Form Berdasarkan Level
        if(level=="Komponen"){
            //Tempelkan Judul
            $('#judul_form_tambah_indikator').html('<i class="bi bi-plus"></i> Tambah Komponen');
            $('#put_id_evaluasi_periode_for_indikator').val(id);
            $('#put_level').val(level);
        }else{
            if(level=="Sub Komponen"){
                //Tempelkan Judul
                $('#judul_form_tambah_indikator').html('<i class="bi bi-plus"></i> Tambah Sub Komponen');
                $('#put_id_komponen_for_indikator').val(id);
                $('#put_level').val(level);
            }else{
                if(level=="Kriteria"){
                    //Tempelkan Judul
                    $('#judul_form_tambah_indikator').html('<i class="bi bi-plus"></i> Tambah Kriteria');
                    $('#put_id_komponen_sub_for_indikator').val(id);
                    $('#put_level').val(level);
                }
            }
        }
    });

    //Proses Tambah Indikator
    $("#ProsesTambahIndikator").on("submit", function (e) {
        e.preventDefault();
        var level = $("#put_level").val();
        var id_evaluasi_periode = $("#put_id_evaluasi_periode_for_indikator").val();
        var id_komponen = $("#put_id_komponen_for_indikator").val();
        var id_komponen_sub = $("#put_id_komponen_sub_for_indikator").val();
        // Tombol loading
        let $ModalElement = $("#ModalTambahIndikator");
        let $Notifikasi = $("#NotifikasiTambahIndikator");
        let $ButtonProses = $("#ButtonTambahIndikator");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesTambahIndikator.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahIndikator")[0].reset();

                    //Tampilkan Data
                    if(level=="Komponen"){
                        showKomponen(id_evaluasi_periode);
                    }else{
                        if(level=="Sub Komponen"){
                            showSubKomponen(id_komponen);
                        }else{
                            if(level=="Kriteria"){
                                showKriteria(id_komponen_sub);
                            }
                        }
                    }
                    
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Data Berhasil!',
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

    //Modal Edit Indikator
    $('#ModalEditIndikator').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        var nama = $(e.relatedTarget).data('nama');
        var kode = $(e.relatedTarget).data('kode');
        var keterangan = $(e.relatedTarget).data('keterangan');
        var level = $(e.relatedTarget).data('level');

        //Atur Form Berdasarkan Level
        if(level=="Komponen"){
            //Tempelkan Judul
            $('#judul_form_indikator_edit').html('<i class="bi bi-pencil"></i> Edit Komponen');
            $('#put_id_indikator_edit').val(id);
            $('#put_level_edit').val(level);
            $('#kode_edit').val(kode);
            $('#nama_indikator_edit').val(nama);
            $('#keterangan_edit').val(keterangan);
        }else{
            if(level=="Sub Komponen"){
                //Tempelkan Judul
                $('#judul_form_indikator_edit').html('<i class="bi bi-pencil"></i> Edit Sub Komponen');
                $('#put_id_indikator_edit').val(id);
                $('#put_level_edit').val(level);
                $('#kode_edit').val(kode);
                $('#nama_indikator_edit').val(nama);
                $('#keterangan_edit').val(keterangan);
            }else{
                if(level=="Kriteria"){
                    //Tempelkan Judul
                    $('#judul_form_indikator_edit').html('<i class="bi bi-pencil"></i> Edit Kriteria');
                    $('#put_id_indikator_edit').val(id);
                    $('#put_level_edit').val(level);
                    $('#kode_edit').val(kode);
                    $('#nama_indikator_edit').val(nama);
                    $('#keterangan_edit').val(keterangan);
                }
            }
        }
    });

    //Proses Edit Indikator
    $("#ProsesEditIndikator").on("submit", function (e) {
        e.preventDefault();
        var level = $("#put_level_edit").val();
        // Tombol loading
        let $ModalElement = $("#ModalEditIndikator");
        let $Notifikasi = $("#NotifikasiEditIndikator");
        let $ButtonProses = $("#ButtonEditIndikator");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesEditIndikator.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    var id_back=response.id_back;
                    //reset form
                    $("#ProsesEditIndikator")[0].reset();

                    //Tampilkan Data
                    if(level=="Komponen"){
                        showKomponen(id_back);
                    }else{
                        if(level=="Sub Komponen"){
                            var id_evaluasi_periode=response.id_back.id_evaluasi_periode;
                            var id_komponen=response.id_back.id_komponen;
                            showSubKomponen(id_komponen);
                        }else{
                            if(level=="Kriteria"){
                                var id_komponen_sub=response.id_back.id_komponen_sub;
                                showKriteria(id_komponen_sub);
                            }
                        }
                    }
                    
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Data Berhasil!',
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

    //Modal Hapus Indikator
    $('#ModalHapusIndikator').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        var nama = $(e.relatedTarget).data('nama');
        var kode = $(e.relatedTarget).data('kode');
        var keterangan = $(e.relatedTarget).data('keterangan');
        var level = $(e.relatedTarget).data('level');
        //Tempelkan Parameter Wajib
        $('#put_id_indikator_hapus').val(id);
        $('#put_level_hapus').val(level);
        $('#put_kode_for_delete_indikator').html(kode);
        $('#put_nama_for_delete_indikator').html(nama);
        $('#put_keterangan_for_delete_indikator').html(keterangan);
        
        //Atur Form Berdasarkan Level
        if(level=="Komponen"){
            //Tempelkan Judul
            $('#judul_form_indikator_hapus').html('<i class="bi bi-trash"></i> Hapus Komponen');
            $('#NotifikasiHapusIndikator').html('Apakah anda yakin akan menghapus komponen tersebut?');
        }else{
            if(level=="Sub Komponen"){
                //Tempelkan Judul
                $('#judul_form_indikator_hapus').html('<i class="bi bi-trash"></i> Hapus Sub Komponen');
                $('#NotifikasiHapusIndikator').html('Apakah anda yakin akan menghapus Sub komponen tersebut?');
            }else{
                if(level=="Kriteria"){
                    //Tempelkan Judul
                    $('#judul_form_indikator_hapus').html('<i class="bi bi-trash"></i> Hapus Kriteria');
                    $('#NotifikasiHapusIndikator').html('Apakah anda yakin akan menghapus Kriteria tersebut?');
                }
            }
        }

    });

    //Proses Hapus Indikator
    $("#ProsesHapusIndikator").on("submit", function (e) {
        e.preventDefault();
        var level = $("#put_level_hapus").val();
        // Tombol loading
        let $ModalElement = $("#ModalHapusIndikator");
        let $Notifikasi = $("#NotifikasiHapusIndikator");
        let $ButtonProses = $("#ButtonHapusIndikator");
        let ButtonElement = '<i class="bi bi-trash"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesHapusIndikator.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusIndikator")[0].reset();

                    //Tampilkan Data
                    if(level=="Komponen"){
                        showKomponen(id_back);
                    }else{
                        if(level=="Sub Komponen"){
                            var id_evaluasi_periode=response.id_back.id_evaluasi_periode;
                            var id_komponen=response.id_back.id_komponen;
                            showSubKomponen(id_evaluasi_periode, id_komponen);
                        }else{
                            if(level=="Kriteria"){
                                var id_komponen_sub=response.id_back.id_komponen_sub;
                                showKriteria(id_komponen_sub);
                            }else{
                                
                            }
                        }
                    }
                    
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Data Berhasil!',
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

    //Modal Tambah Uraian
    $('#ModalTambahUraian').on('show.bs.modal', function (e) {
        var id_kriteria = $(e.relatedTarget).data('id');

        //Reset Form
        $("#ProsesTambahUraian")[0].reset();
        
        //Kosongkan Notifikasi
        $("#NotifikasiTambahUraian").html('');

        //Tempelkan id_kriteria
        $("#put_id_kriteria_for_tambah_uraian").val(id_kriteria);

        //Hapus List Alternatif
        $("#list_alternatif").html('');

        //Sembunyikan Form Lampiran
        $("#FormTipeFile").hide();
        $("#FormMaxFile").hide();
    });

    // Fungsi untuk menambahkan form alternatif
    $('#TambahFormAlternatif').click(function() {
        var newForm = `
            <div class="row mb-3">
                <div class="col-5">
                    <input type="text" name="label_alternatif[]" class="form-control">
                    <small>Label</small>
                </div>
                <div class="col-5">
                    <input type="number" step="0.01" min="0" name="value_alternatif[]" class="form-control">
                    <small>Skor</small>
                </div>
                <div class="col-2 text-end">
                    <div class="btn-group shadow-0">
                        <button type="button" class="btn btn-sm btn-floating btn-outline-danger hapus_form_alternatif">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#list_alternatif').append(newForm);
    });

    // Fungsi untuk menghapus form alternatif
    $(document).on('click', '.hapus_form_alternatif', function() {
        $(this).closest('.row.mb-3').remove();
    });

    //Proses Tambah Uraian
    $("#ProsesTambahUraian").on("submit", function (e) {
        e.preventDefault();
        var id_kriteria = $("#put_id_kriteria_for_tambah_uraian").val();
        // Tombol loading
        let $ModalElement = $("#ModalTambahUraian");
        let $Notifikasi = $("#NotifikasiTambahUraian");
        let $ButtonProses = $("#ButtonTambahUraian");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesTambahUraian.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahUraian")[0].reset();

                    //Tampilkan Data
                    showUraian(id_kriteria);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Data Berhasil!',
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

    //Modal Edit Uraian
    $('#ModalEditUraian').on('show.bs.modal', function (e) {
        var id_uraian = $(e.relatedTarget).data('id');
        $("#FormEditUraian").html('Loading...');
        $("#NotifikasiEditUraian").html('');
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/FormEditUraian.php",
            type        : "POST",
            data        : {id_uraian: id_uraian},
            success: function (response) {
                $("#FormEditUraian").html(response);
            }
        });
    });

    //Proses Edit Uraian
    $("#ProsesEditUraian").on("submit", function (e) {
        e.preventDefault();
        var id_kriteria = $("#id_kriteria_for_edit").val();
        // Tombol loading
        let $ModalElement = $("#ModalEditUraian");
        let $Notifikasi = $("#NotifikasiEditUraian");
        let $ButtonProses = $("#ButtonTambahUraian");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesEditUraian.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesEditUraian")[0].reset();

                    //Tampilkan Data
                    showUraian(id_kriteria);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Edit Data Berhasil!',
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

    //Modal Hapus Uraian
    $('#ModalHapusUraian').on('show.bs.modal', function (e) {
        var id_uraian = $(e.relatedTarget).data('id_uraian');
        var id_kriteria = $(e.relatedTarget).data('id_kriteria');
        var kode = $(e.relatedTarget).data('kode');
        var nama = $(e.relatedTarget).data('nama');

        //Tempelkan Data
        $("#put_id_uraian_for_hapus_uraian").val(id_uraian);
        $("#put_id_kriteria_for_hapus_uraian").val(id_kriteria);
        $("#put_kode_for_delete_uraian").html(kode);
        $("#put_name_for_delete_uraian").html(nama);
        
        //Atur Notifikasi
        $("#NotifikasiHapusUraian").html('<small>Apakah Anda Yakin Akan Menghapus Data Tersebut?</small>');
        
    });

    //Proses Hapus Lampiran
    $("#ProsesHapusUraian").on("submit", function (e) {
        e.preventDefault();
        var id_kriteria = $("#put_id_kriteria_for_hapus_uraian").val();
        // Tombol loading
        let $ModalElement = $("#ModalHapusUraian");
        let $Notifikasi = $("#NotifikasiHapusUraian");
        let $ButtonProses = $("#ButtonHapusUraian");
        let ButtonElement = '<i class="bi bi-check"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesHapusUraian.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusUraian")[0].reset();

                    //Tampilkan Data
                    showUraian(id_kriteria);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Uraian Berhasil!',
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

    //Modal Tambah Lampiran
    $('#ModalTambahLampiran').on('show.bs.modal', function (e) {
        var id_uraian = $(e.relatedTarget).data('id');

        //Reset Form
        $("#ProsesTambahLampiran")[0].reset();
        
        //Kosongkan Notifikasi
        if(id_uraian===""){
            $("#NotifikasiTambahUraian").html('<div class="alert alert-danger">ID Uraian Tidak Dapat Ditangkap Oleh Sistem!</div>');
        }else{
            $("#NotifikasiTambahUraian").html('');
            //Tempelkan id_uraian
            $("#put_id_uraian_untuk_lampiran").val(id_uraian);
        }
        
    });

    //Proses Tambah Lampiran
    $("#ProsesTambahLampiran").on("submit", function (e) {
        e.preventDefault();
        var id_kriteria = $("#TambahUraian").data('id');
        // Tombol loading
        let $ModalElement = $("#ModalTambahLampiran");
        let $Notifikasi = $("#NotifikasiTambahLampiran");
        let $ButtonProses = $("#ButtonTambahLampiran");
        let ButtonElement = '<i class="bi bi-save"></i> Simpan';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesTambahLampiran.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesTambahLampiran")[0].reset();

                    //Tampilkan Data
                    showUraian(id_kriteria);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Tambah Lampiran Berhasil!',
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

    //Modal Hapus Lampiran
    $('#ModalHapusLampiran').on('show.bs.modal', function (e) {
        var id_lampiran = $(e.relatedTarget).data('id_lampiran');
        var id_uraian = $(e.relatedTarget).data('id_uraian');
        var id_kriteria = $(e.relatedTarget).data('id_kriteria');
        //Loading Form
        $("#FormHapusLampiran").html('Loadiing...');

        //Reset Notifikasi
        $("#NotifikasiHapusLampiran").html('');

        //Konfirmasi Hapus
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/FormHapusLampiran.php",
            type        : "POST",
            data        : {
                id_uraian: id_uraian, 
                id_lampiran: id_lampiran, 
                id_kriteria: id_kriteria
            },
            success: function (response) {
                $("#FormHapusLampiran").html(response);
            }
        });
    });

    //Proses Hapus Lampiran
    $("#ProsesHapusLampiran").on("submit", function (e) {
        e.preventDefault();
        var id_kriteria = $("#id_kriteria_for_hapus_lampiran").val();
        // Tombol loading
        let $ModalElement = $("#ModalHapusLampiran");
        let $Notifikasi = $("#NotifikasiHapusLampiran");
        let $ButtonProses = $("#ButtonHapusLampiran");
        let ButtonElement = '<i class="bi bi-save"></i> Ya, Hapus';
        $ButtonProses.html('Loading..');
        $ButtonProses.prop("disabled", true);
    
        // Ambil data form
        let formData = new FormData(this);

        // Kirim data ke server
        $.ajax({
            url         : "_Page/PeriodeEvaluasi/ProsesHapusLampiran.php",
            type        : "POST",
            data        : formData,
            contentType : false,
            processData : false,
            dataType    : "json",
            success: function (response) {
                var id_back=response.id_back;
                //Apabila Proses Berhasil
                if (response.status === "Success") {
                    
                    //reset form
                    $("#ProsesHapusLampiran")[0].reset();

                    //Tampilkan Data
                    showUraian(id_kriteria);
                    
                    // Tampilkan swal notifikasi
                    Swal.fire(
                        'Success!',
                        'Hapus Lampiran Berhasil!',
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