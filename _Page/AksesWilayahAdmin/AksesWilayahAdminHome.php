<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'NXURk3FdU8');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data askes untuk masing-masing wilayah kecamatan dan desa yang dikelola.';
                    echo '  Halaman ini digunakan untuk mempermudah anda pada saat membuatkan data akses semua wilayah sekaligus.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mt-3"></div>
            <div class="col-md-3 text-center mt-3">
                <button type="button" class="btn btn-md btn-info btn-block" data-bs-toggle="modal" data-bs-target="#ModalDownloadTemplateKecamatan">
                    <i class="bi bi-cloud-arrow-down"></i> Download Template
                </button>
            </div>
            <div class="col-md-3 text-center mt-3">
                <button type="button" class="btn btn-md btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalImportAksesKecamatan">
                    <i class="bi bi-plus-lg"></i> Import Data
                </button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <b class="card-title">DATA AKSES TINGKAT KECAMATAN</b>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td align="center"><b>No</b></td>
                                        <td align="center"><b>ID</b></td>
                                        <td align="center"><b>Kecamatan</b></td>
                                        <td align="center"><b>Jumlah Desa</b></td>
                                        <td align="center"><b>Akses Kecamatan</b></td>
                                        <td align="center"><b>Option</b></td>
                                    </tr>
                                </thead>
                                <tbody id="MenampilkanTabelKecamatan">
                                    <!-- Tabel Kecamatan Disini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>