//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var FilterRegionalData = $('#FilterRegionalData').serialize();
    $('#MenampilkanTabelRegionalData').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/TabelRegionalData.php',
        data 	    :  FilterRegionalData,
        success     : function(data){
            $('#MenampilkanTabelRegionalData').html(data);
        }
    });
}
//Fungsi Menampilkan Data Provinsi
function MenampilkanProvinsi() {
    $('#MenampilkanTabelProvinsi').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/TabelProvinsi.php',
        success     : function(data){
            $('#MenampilkanTabelProvinsi').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
    MenampilkanProvinsi();
});
$('#FilterRegionalData').submit(function(){
    filterAndLoadTable();
});
//Ketika KeywordBy Diubah
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilter').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
//Tambah RegionalData
$('#ModalTambahRegionalData').on('show.bs.modal', function (e) {
    $('#FormTambahRegionalData').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/FormTambahRegionalData.php',
        success     : function(data){
            $('#FormTambahRegionalData').html(data);
            //Kondisi id_mitra dipilih
            $('#kategori').change(function(){
                var kategori = $('#kategori').val();
                if(kategori=="Propinsi"){
                    $('#FormTambahRegionalDataLanjutan').load("_Page/RegionalData/FormProvinsi.php");
                }
                if(kategori=="Kabupaten"){
                    $('#FormTambahRegionalDataLanjutan').load("_Page/RegionalData/FormKabupaten.php");
                }
                if(kategori=="Kecamatan"){
                    $('#FormTambahRegionalDataLanjutan').load("_Page/RegionalData/FormKecamatan.php");
                }
                if(kategori=="Desa"){
                    $('#FormTambahRegionalDataLanjutan').load("_Page/RegionalData/FormDesa.php");
                }
            });
            //Proses Tambah RegionalData
            $('#ProsesTambahRegionalData').submit(function(){
                $('#NotifikasiTambahRegionalData').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRegionalData')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/RegionalData/ProsesTambahRegionalData.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRegionalData').html(data);
                        var NotifikasiTambahRegionalDataBerhasil=$('#NotifikasiTambahRegionalDataBerhasil').html();
                        if(NotifikasiTambahRegionalDataBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});

//Edit RegionalData
$('#ModalEditRegionalData').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormEditRegionalData').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/FormEditRegionalData.php',
        data        : {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormEditRegionalData').html(data);
            $('#NotifikasiEditRegionalData').html('<small class="text-primary">Pastikan bahwa data yang anda input sudah benar</small>');
        }
    });
});
//Proses Tambah RegionalData
$('#ProsesEditRegionalData').submit(function(){
    $('#NotifikasiEditRegionalData').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditRegionalData')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/ProsesEditRegionalData.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditRegionalData').html(data);
            var NotifikasiEditRegionalDataBerhasil=$('#NotifikasiEditRegionalDataBerhasil').html();
            if(NotifikasiEditRegionalDataBerhasil=="Success"){
                filterAndLoadTable();
                $('#ModalEditRegionalData').modal('hide');
                swal("Success!", "Edit Wilayah Berhasil!", "success");
            }
        }
    });
});
//Hapus RegionalData
$('#ModalDeleteRegionalData').on('show.bs.modal', function (e) {
    var id_wilayah = $(e.relatedTarget).data('id');
    $('#FormDeleteRegionalData').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/FormDeleteRegionalData.php',
        data        : {id_wilayah: id_wilayah},
        success     : function(data){
            $('#FormDeleteRegionalData').html(data);
            $('#NotifikasiHapusRegionalData').html('');
        }
    });
});
//Konfirmasi Hapus RegionalData
$('#ProsesHapusRegionalData').submit(function(){
    var ProsesHapusRegionalData = $('#ProsesHapusRegionalData').serialize();
    $('#NotifikasiHapusRegionalData').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/ProsesHapusRegionalData.php',
        data        : ProsesHapusRegionalData,
        success     : function(data){
            $('#NotifikasiHapusRegionalData').html(data);
            var NotifikasiHapusRegionalDataBerhasil=$('#NotifikasiHapusRegionalDataBerhasil').html();
            if(NotifikasiHapusRegionalDataBerhasil=="Success"){
                filterAndLoadTable();
                $('#ModalDeleteRegionalData').modal('hide');
                swal("Success!", "Hapus Wilayah Berhasil!", "success");
            }
        }
    });
});
//Hapus RegionalData
$('#ModalWilayahByLevel').on('show.bs.modal', function (e) {
    $('#FormListWilayahByLevel').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RegionalData/FormListWilayahByLevel.php',
        success     : function(data){
            $('#FormListWilayahByLevel').html(data);
        }
    });
});