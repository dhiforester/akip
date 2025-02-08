<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi"));
?>
<div class="row mb-3">
    <?php
        if(empty($jml_data)){
            echo '<div class="col-md-12">';
            echo '  <div class="card">';
            echo '      <div class="card-body text-center">';
            echo '          Tidak Ada Data Sesi Evaluasi Yang Ditemukan';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT*FROM evaluasi ORDER BY periode ASC");
            while ($data = mysqli_fetch_array($query)) {
                $id_evaluasi= $data['id_evaluasi'];
                $periode= $data['periode'];
                $periode_awal= $data['periode_awal'];
                $periode_akhir= $data['periode_akhir'];
                $updatetime= $data['updatetime'];
                $sekarang=date('Y-m-d');
                if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){
                    $status='<span class="text-success">Active</span>';
                }else{
                    if($sekarang<$periode_awal){
                        $status='<span class="text-info">Coming Soon</span>';
                    }else{
                        if($sekarang>$periode_akhir){
                            $status='<span class="text-danger">Expired</span>';
                        }else{
                            $status='<span class="text-dark">None</span>';
                        }
                    }
                }
                //Hitung Jumlah Peserta
                $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi'"));
                //Keterangan
                $CekApakahSayaMengikuti=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                if(empty($CekApakahSayaMengikuti)){
                    $statusKepesertaan='<span class="text-danger">Belum Mengikuti</span>';
                }else{
                    $statusKepesertaan='<span class="text-info">Mengikuti</span>';
                }
    ?>
    </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?Page=EvaluasiDesa&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>" class="card-title"  data-id="<?php echo "$id_evaluasi"; ?>">
                        <b>Periode Evaluasi Tahun <?php echo "$periode";?></b>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="credit">Mulai : </small>
                            <code class="text text-grayish"><?php echo "$periode_awal"; ?></code><br>
                            <small class="credit">Berakhir : </small>
                            <code class="text-grayish"><?php echo "$periode_akhir"; ?></code>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">Peserta : </small>
                            <code class="text text-grayish"><?php echo "$JumlahPeserta Desa"; ?></code><br>
                            <small class="credit">Keterangan : </small>
                            <code class="text text-grayish"><?php echo "$statusKepesertaan"; ?></code>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">Update : </small>
                            <code class="text text-grayish"><?php echo "$updatetime"; ?></code><br>
                            <small class="credit">Status : </small>
                            <code><?php echo "$status"; ?></code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
                $no++; 
            }
        }
    ?>
</div>