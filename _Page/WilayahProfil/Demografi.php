<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'SYctp1ucED');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data laporan profil demografi.';
                    echo '  Informasi demografi dapat diperbaharui berdasarkan periode tahunan.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mt-3"></div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahDemografi" title="Tambah Demografi">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelDemografi"></div>
    </section>
<?php } ?>