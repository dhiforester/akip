<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'sc35cWspYg');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengelolaan evaluasi.';
                    echo '  Semua sesi evaluasi yang dilaksanakan akan ditampilkan pada halaman ini.';
                    echo '  Silahkan ikuti dan isi semua instrumen evaluasi yang diselenggarakan sebelum batas waktu berakhir';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div id="MenampilkanTabelEvaluasiDesa"></div>
    </section>
<?php } ?>