<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_evaluasi
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Event Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_evaluasi=$_POST['id_evaluasi'];
        $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
        $periode_awal=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_awal');
        $periode_akhir=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_akhir');
        $updatetime=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'updatetime');
?>
    <div class="row mb-3">
        <div class="col col-md-4">ID Evaluasi</div>
        <div class="col col-md-8"><code><?php echo "$id_evaluasi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Periode</div>
        <div class="col col-md-8"><code><?php echo "$periode"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Mulai</div>
        <div class="col col-md-8"><code><?php echo "$periode_awal"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Berakhir</div>
        <div class="col col-md-8"><code><?php echo "$periode_akhir"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Update</div>
        <div class="col col-md-8"><code><?php echo "$updatetime"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12">
            <a href="index.php?Page=Evaluasi&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-md btn-outline-info btn-rounded btn-block">
                Selengkapnya <i class="bi bi-info-circle"></i>
            </a>
        </div>
    </div>
<?php } ?>