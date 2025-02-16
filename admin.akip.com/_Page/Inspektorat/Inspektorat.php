<?php
    //Cek Aksesibilitas ke halaman ini
    if($SessionAkses!=="Admin"){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section" id="ShowInspektorat">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan inspektorat pada masing-masing Kabupaten/Kota.';
                    echo '  Setiap inspektorat memiliki data akses yang terhubung pada OPD yang bisa dikelola secara dinamis.';
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
                                <b class="card-title"># Daftar Inspektorat</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalFilterInspektorat">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalTambahInspektorat">
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
                                        <th><b>Inspektorat</b></th>
                                        <th><b>Provinsi</b></th>
                                        <th><b>Kab/Kot</b></th>
                                        <th><b>User</b></th>
                                        <th><b>OPD</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelInspektorat">
                                    <tr>
                                        <td colspan="7" class="text-center">
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
                                <small id="page_info_inspektorat">Page 1 Of 100</small>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="prev_button_inspektorat">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-info" id="next_button_inspektorat">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="ShowDetailInspektorat">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <b class="card-title"># Detail Inspektorat</b>
                            </div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="kembali_ke_data_inspektorat" title="Kembali Ke Data Inspektorat">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body" id="DetailInspektorat">

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <b class="card-title"># Akun/Akses Inspektorat</b>
                            </div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-primary" id="TambahAkses" data-bs-toggle="modal" data-bs-target="#ModalTambahAkses" data-id="" title="Tambah Data Akses Inspektorat">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <small>
                                Berikut ini adalah data akun akses yang dapat digunakan untuk login ke akun Inspektorat.
                            </small>
                        </div>
                        <div class="table table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>Nama</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Kontak</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelAkses">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <small class="text-danger">Tidak Ada Data Akses Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small id="put_jumlah_data_akses"></small>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <b class="card-title"># Daftar OPD</b>
                            </div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-primary" id="TambahOpd" data-bs-toggle="modal" data-bs-target="#ModalTambahOpd" data-id="" title="Tambah Data OPD">
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
                                        <th><b>Nama OPD</b></th>
                                        <th><b>Kontak</b></th>
                                        <th><b>Alamat</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelOpd">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <small class="text-danger">Tidak Ada Data OPD Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small id="put_jumlah_data_opd"></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>