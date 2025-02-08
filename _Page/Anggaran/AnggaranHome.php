<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'EjS8E6S6nV');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data anggaran tahunan.';
                    echo '  Pada halaman utama, anda bisa menggunakannya untuk membuat satu paket data set anggaran untuk beberapa tahun.';
                    echo '  Satu paket data set berlaku untuk satu periode anggaran yang berisi beberapa uraian.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mt-3"></div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahAnggaran" title="Tambah Anggaran">
                    <i class="bi bi-plus"></i> Buat Anggaran
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelAnggaran"></div>
    </section>
<?php } ?>