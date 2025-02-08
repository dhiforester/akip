<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'KLFvTlU9PZ');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman untuk mengelola parameter lampiran bukti yang nantinya harus diisi oleh pemerintah Desa sebagai bahan pertimbangan pihak kecamatan dalam memberikan penilaian SAKIP.';
                    echo '  Silahkan tambahkan parameter/jenis lampiran dokumen yang berhubungan dengan bukti (eviEvidence) berikut dengan tipe serta mekanisme petunjuk pengisiannya.';
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
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahLampiranBukti" title="Tambah Parameter Lampiran Bukti">
                                    <i class="bi bi-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="MenampilkanTabelLampiranBukti">
                        <!-- Menampilkan Data Disini -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>