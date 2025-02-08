<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'Yz9PdQsV10');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{

?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman untuk menampilkan profil desa berdasarkan otoritas kecamatan.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div id="MenampilkanTabelDesa"></div>
    </section>
<?php } ?>