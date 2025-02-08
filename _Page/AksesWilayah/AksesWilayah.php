<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'PyRvIaWGu7');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{

?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data akses untuk pengguna pada tingkat desa/kelurahan. Anda bisa menambahkan data akses baru, melihat detail informasi user, ';
                    echo '  Dan melihat riwayat aktivitas user tersebut. Ijin akses dan entitas akses disesuaikan berdasarkan pengaturan aplikasi.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mt-3"></div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahAkses" title="Tambah Akses">
                    <i class="bi bi-person-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelAkses"></div>
    </section>
<?php } ?>