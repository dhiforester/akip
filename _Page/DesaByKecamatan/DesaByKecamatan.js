$('#MenampilkanTabelDesa').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
$.ajax({
    type    : 'POST',
    url     : '_Page/DesaByKecamatan/TabelDesa.php',
    success: function(data) {
        $('#MenampilkanTabelDesa').html(data);
    }
});