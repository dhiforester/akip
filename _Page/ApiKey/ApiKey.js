//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/TabelApiKey.php',
        data 	    :  ProsesFilter,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});
//Ketika Proses Filter Dimulai
$('#ProsesFilter').submit(function(){
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilter').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
$('#GenerateApiKey').click(function(){
    $('#api_key').val('Generating..');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/ProsesGenerateApiKey.php',
        success     : function(data){
            var ApiKeyIsPure= data.replace(/[^\w\s]/gi, '');
            $('#api_key').val(ApiKeyIsPure);
        }
    });
});
//Tambah ApiKey
$('#ProsesTambahApiKey').submit(function(){
    $('#NotifikasiTambahApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/ProsesTambahApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahApiKey').html(data);
            var NotifikasiTambahApiKeyBerhasil=$('#NotifikasiTambahApiKeyBerhasil').html();
            if(NotifikasiTambahApiKeyBerhasil=="Success"){
                $("#ProsesTambahApiKey")[0].reset();
                filterAndLoadTable();
                $('#ModalTambahApiKey').modal('toggle');
                swal("Success!", "Tambah API Key Berhasil!", "success");
            }
        }
    });
});
//Detail ApiKey
$('#ModalDetailApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormDetailApiKey').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormDetailApiKey.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormDetailApiKey').html(data);
        }
    });
});
//Edit ApiKey
$('#ModalEditApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormEditApiKey').html("Loading...");
    $('#NotifikasiEditApiKey').html('<small class="credit text-primary">Pastikan Data Yang Anda Input Sudah Sesuai</small>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormEditApiKey.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormEditApiKey').html(data);
        }
    });
});
//Proses Tambah ApiKey
$('#ProsesEditApiKey').submit(function(){
    $('#NotifikasiEditApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/ProsesEditApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditApiKey').html(data);
            var NotifikasiEditApiKeyBerhasil=$('#NotifikasiEditApiKeyBerhasil').html();
            if(NotifikasiEditApiKeyBerhasil=="Success"){
                filterAndLoadTable();
                $('#ModalEditApiKey').modal('toggle');
                swal("Success!", "Edit API Key Berhasil!", "success");
            }
        }
    });
});
//Hapus ApiKey
$('#ModalHapusApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormHapusApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormDeleteApiKey.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormHapusApiKey').html(data);
            $('#NotifikasiHapusApiKey').html('');
        }
    });
});
//Konfirmasi Hapus ApiKey
$('#ProsesHapusApiKey').submit(function(){
    $('#NotifikasiHapusApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/ProsesHapusApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusApiKey').html(data);
            var NotifikasiHapusApiKeyBerhasil=$('#NotifikasiHapusApiKeyBerhasil').html();
            if(NotifikasiHapusApiKeyBerhasil=="Success"){
                filterAndLoadTable();
                $('#ModalHapusApiKey').modal('toggle');
                swal("Success!", "Hapus API Key Berhasil!", "success");
            }
        }
    });
});