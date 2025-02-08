<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_wilayah
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
?>
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            Untuk melihat uraian referensi Bidang, Sub Bidang dan Kegiatan anda akan diarahkan pada halaman khusus.
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <a href="index.php?Page=BidangKegiatan&Sub=BidangKegiatanKabupaten&id_wilayah=<?php echo "$id_wilayah"; ?>" class="btn btn-sm btn-block btn-primary">
                Lanjutkan <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
<?php } ?>