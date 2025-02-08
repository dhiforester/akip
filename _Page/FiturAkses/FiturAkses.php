<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'7zJ8gEF2Mj');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data referensi fitur aplikasi yang dapat di akses oleh pengguna.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8 mt-3"></div>
            <div class="col-md-2 mt-3">
                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahFitur" title="Tambah Data Fitur">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelFitur"></div>
    </section>
<?php } ?>