<?php
    //Cek Aksesibilitas ke halaman ini
    if($SessionAkses!=="Admin"){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section" id="ShowProvinsi">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan referensi wilayah administratif provinsi.';
                    echo '  Masing-masing provinsi terdiri dari kabupaten/kota yang bisa anda kelola secara dinamis.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <b class="card-title">Provinsi Di Indonesia</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalFilterProvinsi">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalTambahProvinsi">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>Provinsi</b></th>
                                        <th><b>Kab/Kot</b></th>
                                        <th><b>OPD</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelProvinsi">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <small class="text-danger">Tidak Ada Data Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <small id="page_info_provinsi">Page 1 Of 100</small>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="prev_button_provinsi">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="next_button_provinsi">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="ShowKabupaten">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan referensi wilayah administratif kabupaten/kota.';
                    echo '  Masing-masing kabupaten/kota memiliki OPD yang bisa anda kelola secara dinamis.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <b class="card-title" id="put_provinsi_name">
                                    Provinsi
                                </b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="back_to_provinsi" title="Kembali Ke Data Provinsi">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalFilterKabupaten" title="Cari Kabupaten/Kota">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalTambahKabkot" title="Tambah Data Kabupaten/Kota">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>Kab/Kot</b></th>
                                        <th><b>OPD</b></th>
                                        <th><b>Akun</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelKabupaten">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <small class="text-danger">Tidak Ada Data Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <small id="page_info_kabupaten">Page 1 Of 100</small>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="prev_button_kabupaten">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="next_button_kabupaten">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="ShowOpd">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan referensi data OPD.';
                    echo '  Masing-masing OPD memiliki akun akses yang bisa anda kelola secara dinamis.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <b class="card-title" id="put_provinsi_name2">Provinsi</b> / <b class="card-title" id="put_kabkot_name">Kabupaten-Kota</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="back_to_kabupaten" title="Kembali Ke Kabupaten/Kota">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="button_tambah_opd" data-bs-toggle="modal" data-bs-target="#ModalTambahOpd" data-id="" title="Tambah OPD">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>OPD</b></th>
                                        <th><b>Akun</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelOpd">
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <small class="text-danger">Tidak Ada Data Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <small id="page_info_opd">Page 1 Of 100</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="showDetailOpd">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <b class="card-title" id="put_opd_name">Nama OPD</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="back_to_opd" title="Kembali Ke Data OPD">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body" id="detail_opd">
                        <!-- Detail OPD akan muncul disini -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>