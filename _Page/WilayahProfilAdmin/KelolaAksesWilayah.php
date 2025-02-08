<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman pengelolaan data askes wilayah.';
                echo '  Selanjutnya anda bisa mengelola semua akses wilayah dengan mudah';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 mt-3"></div>
        <div class="col-md-2 mt-3">
            <div class="btn-group w-100">
                <button type="button" class="btn btn-md btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalTambahProvinsi">
                    <i class="bi bi-download"></i> Download
                </button>
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="btn-group w-100">
                <button type="button" class="btn btn-md btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalTambahProvinsi">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </div>
    </div>
    <div id="MenampilkanTabelAksesKecamatan">
        <!-- Tabel Data Regional Ditampilkan Disini -->
    </div>
</section>