
//Proses Simpan Setting Email
$('#ProsesSettingEmail').submit(function(){
    $('#NotifikasiSimpanSettingEmail').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesSettingEmail')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingEmail/ProsesSettingEmail.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiSimpanSettingEmail').html(data);
            var NotifikasiSimpanSettingEmailBerhasil=$('#NotifikasiSimpanSettingEmailBerhasil').html();
            if(NotifikasiSimpanSettingEmailBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingEmail";
            }
        }
    });
});
//Modal Test Send Email
$('#ModalTestSendEmail').on('show.bs.modal', function (e) {
    var Loading='<div class="modal-body"><div class="row"><div class="col col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div></div></div></div>';
    $('#FormTestSendEmail').html(Loading);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingEmail/FormTestSendEmail.php',
        success     : function(data){
            $('#FormTestSendEmail').html(data);
        }
    });
});
$('#ProsesTestSendEmail').submit(function(){
    $('#NotifikasiTestSendEmail').html("Loading..");
    var form = $('#ProsesTestSendEmail')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingEmail/ProsesTestSendEmail.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTestSendEmail').html(data);
            var NotifikasiTestSendEmailBerhasil=$('#NotifikasiTestSendEmailBerhasil').html();
            if(NotifikasiTestSendEmailBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingEmail";
            }
        }
    });
});