//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $('#MenampilkanTabelAktivitas').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Aktivitas/TabelAktivitas.php',
        data    : ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelAktivitas').html(data);
        }
    });
}
//Menampilkan Log Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});
//Proses Filter
$('#ProsesFilter').submit(function(){
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
//Ketika KeywordBy Diubah
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilter').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/FormFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});