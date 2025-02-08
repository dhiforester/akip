<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'rBKEcPfqtz');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data pengajuan akses.';
                    echo '  Anda bisa mengelola semua pengajuan akses dari landing page dan membuatkan akun sesuai otoritas wilayahnya secara langsung.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mt-3"></div>
            <div class="col-md-2 mt-3">
                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data Akses">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12" id="MenampilkanTabelPengajuanAkses">
                
            </div>
        </div>
    </section>
<?php } ?>