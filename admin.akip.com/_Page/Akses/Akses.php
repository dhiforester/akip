<?php
    //Cek Aksesibilitas ke halaman ini
    if($SessionAkses!=="Admin"){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section" id="showAkses">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <small>
                                Berikut ini adalah halaman pengelolaan data akses. 
                                Halaman ini mengelola data akses secara umum.
                            </small>
                        </div>
                    ';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8 mb-3">
                                <b class="card-title">Daftar Pengguna</b>
                            </div>
                            <div class="col-4 mb-3 text-end">
                                <button type="button" class="btn btn-sm btn-outline-grayish btn-floating" data-bs-toggle="modal" data-bs-target="#ModalExport" title="Export Data Akses">
                                    <i class="bi bi-download"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-grayish btn-floating" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data Akses">
                                    <i class="bi bi-funnel"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-grayish btn-floating" data-bs-toggle="modal" data-bs-target="#ModalTambahAkses" title="Tambah Akses">
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
                                        <th><b>Nama</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Akses</b></th>
                                        <th><b>Option</b></th>
                                    </tr>
                                </thead>
                                <tbody id="table_akses">
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <small class="text-danger">Belum Ada Data Yang Ditampilkan</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <small id="page_info_akses">
                                    Page 1 Of 100
                                </small>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-sm btn-outline-info btn-floating" id="prev_button_akses">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info btn-floating" id="next_button_akses">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>