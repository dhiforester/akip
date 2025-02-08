<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'oA6YtX3f9g');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data sesi evaluasi.';
                    echo '  Halaman ini berfungsi untuk mengelola informasi pengaturan dan peserta wilayah otoritas yang sudah mengisi.';
                    echo '  Anda bisa melihat data seperta yang sudah mengikuti dan mengisi jawaban.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8 mt-3"></div>
            <div class="col-md-2 mt-3"></div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahEvaluasi" title="Tambah Sesi Evaluasi">
                    <i class="bi bi-person-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelEvaluasi"></div>
    </section>
<?php } ?>