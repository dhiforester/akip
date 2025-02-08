<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'kEMFLyaK1p');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data akses. Anda bisa menambahkan data akses baru, melihat detail informasi user, ';
                    echo '  Dan melihat riwayat aktivitas user tersebut. Ijin akses dan entitas akses disesuaikan berdasarkan pengaturan aplikasi.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mt-3"></div>
            <div class="col-md-3 mt-3">
                <div class="btn-group w-100">
                    <button type="button" class="btn btn-md btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalExport" title="Export Data">
                        <i class="bi bi-file-earmark-font"></i> Export
                    </button>
                    <button type="button" class="btn btn-md btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalImport" title="Import Data">
                        <i class="bi bi-upload"></i> Import
                    </button>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="btn-group w-100">
                    <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data Penduduk">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahPenduduk" title="Tambah Data Penduduk/Warga">
                        <i class="bi bi-person-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div id="MenampilkanTabelPenduduk"></div>
    </section>
<?php } ?>