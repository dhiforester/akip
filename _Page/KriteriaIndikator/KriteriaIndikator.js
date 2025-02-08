//Fungsi
function LoadKriteriaIndikator() {
    $.ajax({
        type    : 'POST',
        url     : '_Page/KriteriaIndikator/TabelKriteriaIndikator.php',
        success: function(data) {
            $('#MenampilkanTabelKriteriaIndikator').html(data);
        }
    });
}
//Menampilkan Pertama Kali
$(document).ready(function() {
    LoadKriteriaIndikator();
});
//Modal Tambah Kriteria dan Indikator
$('#ModalTambahKriteriaIndikator').on('show.bs.modal', function (e) {
    $('#FormTambahKriteriaIndikator').html("Loading...");
    $('#NotifikasiTambahKriteriaIndikator').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormTambahKriteriaIndikator.php',
        success     : function(data){
            $('#FormTambahKriteriaIndikator').html(data);
        }
    });
});
//Proses Tambah Kriteria Dan Indikator
$('#ProsesTambahKriteriaIndikator').submit(function(){
    $('#NotifikasiTambahKriteriaIndikator').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahKriteriaIndikator')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/ProsesTambahKriteriaIndikator.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahKriteriaIndikator').html(data);
            var NotifikasiTambahKriteriaIndikatorBerhasil=$('#NotifikasiTambahKriteriaIndikatorBerhasil').html();
            if(NotifikasiTambahKriteriaIndikatorBerhasil=="Success"){
                $("#ProsesTambahKriteriaIndikator")[0].reset();
                $('#ModalTambahKriteriaIndikator').modal('hide');
                swal("Success!", "Tambahh Kriteria/Indikator Berhasil!", "success");
                //Menampilkan Data
                LoadKriteriaIndikator();
            }
        }
    });
});
//Modal Hapus Kriteria dan Indikator
$('#ModalHapusKriteria').on('show.bs.modal', function (e) {
    var id_kriteria_indikator = $(e.relatedTarget).data('id');
    $('#FormHapusKriteria').html("Loading...");
    $('#NotifikasiHapusKriteria').html('');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormHapusKriteria.php',
        data        : {id_kriteria_indikator: id_kriteria_indikator},
        success     : function(data){
            $('#FormHapusKriteria').html(data);
        }
    });
});
//Ketika Proses Hapus
$('#ProsesHapusKriteria').submit(function(){
    $('#NotifikasiHapusKriteria').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusKriteria')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/ProsesHapusKriteria.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusKriteria').html(data);
            var NotifikasiHapusKriteriaBerhasil=$('#NotifikasiHapusKriteriaBerhasil').html();
            if(NotifikasiHapusKriteriaBerhasil=="Success"){
                $('#ModalHapusKriteria').modal('hide');
                swal("Success!", "Hapus Kriteria/Indikator Berhasil!", "success");
                //Menampilkan Data
                LoadKriteriaIndikator();
            }
        }
    });
});
//Modal Edit Kriteria dan Indikator
$('#ModalEditKriteria').on('show.bs.modal', function (e) {
    var id_kriteria_indikator = $(e.relatedTarget).data('id');
    $('#FormEditKriteriaIndikator').html("Loading...");
    $('#NotifikasiEditKriteriaIndikator').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormEditKriteriaIndikator.php',
        data        : {id_kriteria_indikator: id_kriteria_indikator},
        success     : function(data){
            $('#FormEditKriteriaIndikator').html(data);
        }
    });
});
//Proses Edit Kriteria Dan Indikator
$('#ProsesEditKriteria').submit(function(){
    $('#NotifikasiEditKriteriaIndikator').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditKriteria')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/ProsesEditKriteria.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditKriteriaIndikator').html(data);
            var NotifikasiEditKriteriaIndikatorBerhasil=$('#NotifikasiEditKriteriaIndikatorBerhasil').html();
            if(NotifikasiEditKriteriaIndikatorBerhasil=="Success"){
                $('#ModalEditKriteria').modal('hide');
                swal("Success!", "Edit Kriteria/Indikator Berhasil!", "success");
                //Menampilkan Data
                LoadKriteriaIndikator();
            }
        }
    });
});

//Modal Add Form dan Indikator
$('#ModalAddFormIndikator').on('show.bs.modal', function (e) {
    var id_kriteria_indikator = $(e.relatedTarget).data('id');
    $('#FormAddFormIndikator').html("Loading...");
    $('#NotifikasiAddFormIndikator').html('<code class="text-primary">Pastikan Data Yang Anda Input Sudah Sesuai</code>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormAddFormIndikator.php',
        data        : {id_kriteria_indikator: id_kriteria_indikator},
        success     : function(data){
            $('#FormAddFormIndikator').html(data);
        }
    });
});
//Proses Edit Kriteria Dan Indikator
$('#ProsesAddFormIndikator').submit(function(){
    $('#NotifikasiAddFormIndikator').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesAddFormIndikator')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/ProsesTambahKriteriaIndikator.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiAddFormIndikator').html(data);
            var NotifikasiTambahKriteriaIndikatorBerhasil=$('#NotifikasiTambahKriteriaIndikatorBerhasil').html();
            if(NotifikasiTambahKriteriaIndikatorBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Detail Pernyataan
$('#ModalDetailPernyataan').on('show.bs.modal', function (e) {
    var id_kriteria_indikator = $(e.relatedTarget).data('id');
    $('#FormDetailPernyataan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormDetailPernyataan.php',
        data        : {id_kriteria_indikator: id_kriteria_indikator},
        success     : function(data){
            $('#FormDetailPernyataan').html(data);
        }
    });
});
//Modal Referensi Parameter
$('#ModalReferensiParameter').on('show.bs.modal', function (e) {
    var id_kriteria_indikator = $(e.relatedTarget).data('id');
    $('#FormReferensiParameter').html("Loading...");
    $('#NotifikasiReferensiParameter').html('<b>Pastikan Parameter Lampiran/Bukti Sudah Sesuai</b>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/FormReferensiParameter.php',
        data        : {id_kriteria_indikator: id_kriteria_indikator},
        success     : function(data){
            $('#FormReferensiParameter').html(data);
        }
    });
});
//Proses Referensi Parameter
$('#ProsesReferensiParameter').submit(function(){
    $('#NotifikasiReferensiParameter').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesReferensiParameter')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/KriteriaIndikator/ProsesReferensiParameter.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiReferensiParameter').html(data);
            var NotifikasiReferensiParameterBerhasil=$('#NotifikasiReferensiParameterBerhasil').html();
            if(NotifikasiReferensiParameterBerhasil=="Success"){
                $('#ModalReferensiParameter').modal('hide');
                swal("Success!", "mengatur Referensi Parameter Lampiran/Bukti Berhasil!", "success");
                LoadKriteriaIndikator();
            }
        }
    });
});