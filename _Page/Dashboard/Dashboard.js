$(document).ready(function() {
    $('#DaftarSakipDesa').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Dashboard/DaftarSakipDesa.php',
        success: function(data) {
            $('#DaftarSakipDesa').html(data);
        }
    });
    $('#DaftarKecamatanByKabupaten').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
    $.ajax({
        type    : 'POST',
        url     : '_Page/Dashboard/DaftarKecamatanByKabupaten.php',
        success: function(data) {
            $('#DaftarKecamatanByKabupaten').html(data);
        }
    });
});