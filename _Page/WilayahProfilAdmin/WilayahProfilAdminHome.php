<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'ezqzXIbCCR');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman informasi profil wilayah berdasarkan otoritas. ';
                    echo '  Anda bisa melihat uraian indikator informasi pada masing-masing desa yang ditampilkan berdasarkan kecamatan berikut ini';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <a href="index.php?Page=WilayahProfilAdmin&Sub=KelolaAksesWilayah" class="btn btn-md btn-info w-100">
                    <i class="bi bi-list-check"></i> Kelola Akses Wilayah
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <b class="card-title">List Profile Wilayah</b>
                            </div>
                            <div class="card-body" id="TabelKecamatan">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>