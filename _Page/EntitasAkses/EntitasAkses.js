//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelEntitasAkses').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type: 'POST',
        url: '_Page/EntitasAkses/TabelEntitasAkses.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelEntitasAkses').html(data);
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
//Kondisi Ketika KeywordBy Diubah
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilter').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
//Kondisi Ketika Akses Diubah
$('#akses').change(function(){
    var akses = $('#akses').val();
    $('#FormStandarFitur').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/FormStandarFitur.php',
        data 	    :  {akses: akses},
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#FormStandarFitur').html(data);
        }
    });
});
//Proses Tambah entitas baru
$('#ProsesTambahEntitasAkses').submit(function(){
    $('#NotifikasiTambahEntitas').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahEntitasAkses')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/ProsesTambahEntitasAkses.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahEntitas').html(data);
            var NotifikasiTambahEntitasBerhasil=$('#NotifikasiTambahEntitasBerhasil').html();
            if(NotifikasiTambahEntitasBerhasil=="Success"){
                $('#NotifikasiTambahEntitas').html('Pastikan data yang anda input sudah benar');
                $("#ProsesTambahEntitasAkses")[0].reset();
                $('#ModalTambahEntitas').modal('hide');
                swal("Success!", "Tambahh Entitas Berhasil!", "success");
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});

//Modal Edit Entitas
$('#ModalEditEntitas').on('show.bs.modal', function (e) {
    var id_akses_entitas = $(e.relatedTarget).data('id');
    $('#FormEditEntitas').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/FormEditEntitas.php',
        data        : {id_akses_entitas: id_akses_entitas},
        success     : function(data){
            $('#FormEditEntitas').html(data);
            $('#NotifikasiEditEntitas').html('Pastikan data yang anda input sudah benar');
        }
    });
});
//Proses edit entitas
$('#ProsesEditEntitas').submit(function(){
    $('#NotifikasiEditEntitas').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditEntitas')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/ProsesEditEntitas.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditEntitas').html(data);
            var NotifikasiEditEntitasBerhasil=$('#NotifikasiEditEntitasBerhasil').html();
            if(NotifikasiEditEntitasBerhasil=="Success"){
                swal("Good Job!", "Edit Entitas Akses Berhasil!", "success");
                $('#ModalEditEntitas').modal('hide');
                filterAndLoadTable();
            }
        }
    });
});
//Edit ApiKey
$('#ModalDetailEntitas').on('show.bs.modal', function (e) {
    var id_akses_entitas = $(e.relatedTarget).data('id');
    $('#FormDetailEntitasAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/FormDetailEntitasAkses.php',
        data        : {id_akses_entitas: id_akses_entitas},
        success     : function(data){
            $('#FormDetailEntitasAkses').html(data);
        }
    });
});
//Hapus Entitas
$('#ModalHapusEntitas').on('show.bs.modal', function (e) {
    var id_akses_entitas = $(e.relatedTarget).data('id');
    $('#FormHapusEntitas').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/FormHapusEntitas.php',
        data        : {id_akses_entitas: id_akses_entitas},
        success     : function(data){
            $('#FormHapusEntitas').html(data);
            $('#NotifikasiHapusEntitas').html('');
        }
    });
});
//Konfirmasi Hapus Entitas
$('#ProsesHapusEntitas').submit(function(){
    var ProsesHapusEntitas = $('#ProsesHapusEntitas').serialize();
    $('#NotifikasiHapusEntitas').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/EntitasAkses/ProsesHapusEntitas.php',
        data        : ProsesHapusEntitas,
        success     : function(data){
            $('#NotifikasiHapusEntitas').html(data);
            var NotifikasiHapusEntitasBerhasil=$('#NotifikasiHapusEntitasBerhasil').html();
            if(NotifikasiHapusEntitasBerhasil=="Success"){
                filterAndLoadTable();
                $('#ModalHapusEntitas').modal('hide');
                swal("Success!", "Menghapus Entitas Akses Berhasil!", "success");
            }
        }
    });
});