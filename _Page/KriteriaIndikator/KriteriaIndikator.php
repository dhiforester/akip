<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'Zd0og16k0X');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data komponen kriteria & indikator penilaian pada evaluasi kinerja.';
                    echo '  Anda bisa mengelola semua data parameter indikator, sub indikator dan kriteria penilaian yang selanjutnya dapat digunakan dalam proses penilaian kinerja.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-10 mt-3"></div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahKriteriaIndikator" title="Pilih Komponen Penilaian">
                                    <i class="bi bi-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="MenampilkanTabelKriteriaIndikator">
                        <!-- Menampilkan Data Kriteria Dan Indikator Disini -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>