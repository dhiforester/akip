<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'Pa943WkOrb');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan data Api Key.';
                    echo '  Fitur ini digunakan untuk memberikan ijin akses  integrasi pihak lain dalam menggunakan semua sumberdaya data yang ada pada ekosistem aplikasi ini';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <form action="javascript:void(0);" id="ProsesBatas">
                    <div class="row">
                        <div class="col-md-8 mt-3">
                            
                        </div>
                        <div class="col-md-2 mt-3">
                            <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilter">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2 text-center mt-3">
                            <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahApiKey">
                                <i class="bi bi-plus-lg"></i> Buat Baru
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="MenampilkanTabelApiKey">
                <!-- Menampilkan Tabel API Key Disini -->
            </div>
        </div>
    </section>
<?php } ?>