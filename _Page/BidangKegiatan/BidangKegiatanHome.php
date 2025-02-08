<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'sMOaqDnpgo');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data parameter bidang dan kegiatan pada tingkat Kabupaten/Kota.';
                    echo '  Anda bisa mengelola semua data parameter bidang, sub bidang dan kegiatan yang sudah dibuat oleh masing-masing Kabupaten/Kota.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-7 mt-3"></div>
            <div class="col-md-2 mt-3">
                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterDistinctKabupaten" title="Filter Data">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <div class="col-md-3 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihKabupaten" title="Tambah Bidang Tingkat Kabupaten">
                    <i class="bi bi-chevron-double-up"></i> Lihat Semua Kab/Kota
                </button>
            </div>
        </div>
        <div id="MenampilkanTabelBidangDistinctKabupaten">
            
        </div>
    </section>
<?php } ?>