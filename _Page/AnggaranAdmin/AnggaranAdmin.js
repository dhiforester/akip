$(document).ready(function() {
    $('#ProsesFilter').submit(function(){
        var ProsesFilter = $('#ProsesFilter').serialize();
        $('#TabelAnggaranByKecamatan').html('<div class="row"><div class="col-md-12 text-center">Loading...</div></div>');
        $.ajax({
            type    : 'POST',
            url     : '_Page/AnggaranAdmin/TabelAnggaranByKecamatan.php',
            data    : ProsesFilter,
            success: function(data) {
                $('#TabelAnggaranByKecamatan').html(data);
            }
        });
    });
});