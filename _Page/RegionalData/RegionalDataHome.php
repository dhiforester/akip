<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'U1S6XDJxFV');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan referensi wilayah administratif.';
                    echo '  Selanjutnya data yang ada pada halaman ini akan digunakan oleh pengguna sebagai data dasar identifikasi wilayah sesuai otoritas masing-masing pengguna.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mt-3"></div>
            <div class="col-md-4 mt-3">
                <div class="btn-group w-100">
                    <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#ModalFilterRegionalData">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#ModalWilayahByLevel">
                        <i class="bi bi-table"></i> Level
                    </button>
                    <!-- <a href="index.php?Page=Wilayah&Sub=Group" class="btn btn-md btn-info">
                        <i class="bi bi-list"></i> Grouping
                    </a> -->
                </div>
            </div>
            <div class="col-md-2 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahRegionalData">
                    <i class="bi bi-plus-lg"></i> Tambah Wilayah
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelRegionalData">
            <!-- Tabel Data Regional Ditampilkan Disini -->
        </div>
    </section>
<?php } ?>