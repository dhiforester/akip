<?php
    //Cek Aksesibilitas ke halaman ini
    if($SessionAkses!=="Admin"){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section" id="ShowDataPeriodeEvaluasi">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman untuk mengelola periode evaluasi.';
                    echo '  Setiap periode evaluasi memiliki komponen penilaian yang berbeda. Anda dapat mengaturnya pada halaman ini.';
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
                                <b class="card-title"># Daftar Periode</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalTambahPeriode">
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
                                        <th><b>Tahun</b></th>
                                        <th><b>Mulai</b></th>
                                        <th><b>Selesai</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Opsi</b></th>
                                    </tr>
                                </thead>
                                <tbody id="TabelPeriode">
                                    <tr>
                                        <td colspan="6" class="text-center">
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
                                <small id="jumlah_periode">Jumlah Data : 10 Periode</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="ShowDetailPeriode">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman detail periode evaluasi.';
                    echo '  Setiap periode evaluasi memiliki komponen penilaian yang berbeda. Anda dapat mengaturnya pada halaman ini.';
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
                                <b class="card-title"># Detail Periode Evaluasi</b>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish kembali_ke_periode">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body" id="DetailPeriodeEvaluasi">
                        
                    </div>
                    <div class="card-footer" id="FooterDetailPeriodeEvaluasi">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <span id="level_indikator">
                                    # Komponen/Sub-Komponen/Kriteria/Uraian
                                </span>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="kembali_ke_komponen" data-id="" title="Kembali Ke Komponen">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="kembali_ke_sub_komponen" data-id="" title="Kembali Ke Sub Komponen">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="kembali_ke_kriteria" data-id="" title="Kembali Ke Kriteria">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="TambahKomponen" data-bs-toggle="modal" data-bs-target="#ModalTambahIndikator" data-id="" data-level="" title="">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="TambahSubKomponen" data-bs-toggle="modal" data-bs-target="#ModalTambahIndikator" data-id="" data-level="" title="">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="TambahKriteria" data-bs-toggle="modal" data-bs-target="#ModalTambahIndikator" data-id="" data-level="" title="">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" id="TambahUraian" data-bs-toggle="modal" data-bs-target="#ModalTambahUraian" data-id="" title="">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body" id="tabel_indikator">
                        Pada element ini akan ditampilkan 
                        1.Komponen
                        2.Sub Komponen
                        3.Kriteria 
                        4. Uraian
                    </div>
                    <div class="card-footer" id="FooterIndikator">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>