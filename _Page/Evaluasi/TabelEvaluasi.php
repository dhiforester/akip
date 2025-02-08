<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi"));
?>
<div class="row mb-3">
    <div class="col-md-12">
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
                $query = mysqli_query($Conn, "SELECT*FROM evaluasi ORDER BY periode DESC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_evaluasi= $data['id_evaluasi'];
                    $periode= $data['periode'];
                    $periode_awal= $data['periode_awal'];
                    $periode_akhir= $data['periode_akhir'];
                    $updatetime= $data['updatetime'];
                    $sekarang=date('Y-m-d');
                    if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){
                        $status='<span class="badge badge-success">Active</span>';
                    }else{
                        if($sekarang<$periode_awal){
                            $status='<span class="badge badge-info">Coming Soon</span>';
                        }else{
                            if($sekarang>$periode_akhir){
                                $status='<span class="badge badge-danger">Expired</span>';
                            }else{
                                $status='<span class="badge badge-dark">None</span>';
                            }
                        }
                    }
                    //Hitung Jumlah Peserta
                    $JumlahRekap = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi'"));
                    $JumlahMenungguVerifikasi = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT id_wilayah FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND status='Verifikasi'"));
        ?>
        
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailEvaluasi" data-id="<?php echo "$id_evaluasi"; ?>">
                                <i class="bi bi-info-circle"></i> Detail Evaluasi
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditEvaluasi" data-id="<?php echo "$id_evaluasi"; ?>">
                                <i class="bi bi-pencil"></i> Edit Evaluasi
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusEvaluasi" data-id="<?php echo "$id_evaluasi"; ?>">
                                <i class="bi bi-trash"></i> Hapus Evaluasi
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title" data-bs-toggle="modal" data-bs-target="#ModalDetailEvaluasi" data-id="<?php echo "$id_evaluasi"; ?>">
                        <b><?php echo "$periode";?></b>
                    </a>
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
        <?php
                    $no++; 
                }
            }
        ?>
    </div>
</div>