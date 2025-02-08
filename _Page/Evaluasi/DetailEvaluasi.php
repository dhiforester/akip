<section class="section dashboard">
    <?php
        if(empty($_GET['id'])){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '  ID Evaluasi tidak boleh kosong!';
            echo '</div>';
        }else{
            $id_evaluasi=$_GET['id'];
            if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '  ID Evaluasi Hanya boleh angka!';
                echo '</div>';
            }else{
                //Detail Evaluasi
                $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
                $periode_awal=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_awal');
                $periode_akhir=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_akhir');
                $updatetime=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'updatetime');
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
                $JumlahRekap = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi'"));
                $JumlahMenungguVerifikasi = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT id_wilayah FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND status='Verifikasi'"));
?>
            <input type="hidden" name="GetIdEvaluasi" id="GetIdEvaluasi" value="<?php echo "$id_evaluasi"; ?>">
            <div class="row mb-3">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <a href="index.php?Page=Evaluasi" class="btn btn-mb btn-rounded btn-dark btn-block">
                        <i class="bi bi-chevron-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">
                                <?php echo "Detail Evaluasi Periode $periode"; ?>
                            </b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Waktu Mulai</div>
                                        <div class="col col-md-8">
                                            <code class="text text-dark"><?php echo "$periode_awal"; ?></code>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Waktu Berakhir</div>
                                        <div class="col col-md-8">
                                            <code class="text-dark"><?php echo "$periode_akhir"; ?></code>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Updatetime</div>
                                        <div class="col col-md-8">
                                            <code class="text-dark"><?php echo "$updatetime"; ?></code>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Status Evaluasi</div>
                                        <div class="col col-md-8">
                                            <?php echo "$status"; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Rekap Evaluasi</div>
                                        <div class="col col-md-8">
                                            <code class="text text-dark"><?php echo "$JumlahRekap Desa"; ?></code>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Menunggu Verifikasi</div>
                                        <div class="col col-md-8">
                                            <code class="text text-dark"><?php echo "$JumlahMenungguVerifikasi Desa"; ?></code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <b class="card-title">Data Kecamatan</b>
                </div>
                <div id="TabelPesertaEvaluasi">
                    <!-- Menampilkan List Kecamatan Disini -->
                </div>
            </div>
<?php
        }
    }
?>
</section>