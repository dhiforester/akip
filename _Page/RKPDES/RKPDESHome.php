<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'bifKyWmOFi');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        //Jumlah Sesi Evaluasi
        $JumlahSeluruhEvaluasi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi"));
?>
    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Berikut ini adalah halaman untuk mengelola data RKPDES. Setiap laporan RKPDES yang anda buat dikelompokan 
                    berdasarkan <i>Credential</i> evaluasi dari admin kabupaten dan RPJMDES yang sudah anda buat sebelumnya. Oleh sebab itu, sebelum menggunakan 
                    halaman ini pastikan bahwa anda sudah mengelola RKPDES sebelumnya terlebih dulu.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    if(empty($JumlahSeluruhEvaluasi)){
                        echo '<div class="card">';
                        echo '  <div class="card-body text-center text-danger">';
                        echo '      Data <i>credentials</i> evaluasi belum dibuat oleh pihak Admin Kabupaten.<br>';
                        echo '      Laporan dokumen RKPDES hanya bisa di input ketika pihak Kabupaten memberikan <i>credentials</i> untuk melakukan evaluasi';
                        echo '  </div>';
                        echo '</div>';
                    }else{
                        //Array Semua Credential Evaluasi
                        $no=1;
                        $query = mysqli_query($Conn, "SELECT*FROM evaluasi ORDER BY id_evaluasi ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_evaluasi= $data['id_evaluasi'];
                            $periode= $data['periode'];
                            $periode_awal= $data['periode_awal'];
                            $periode_akhir= $data['periode_akhir'];
                            $updatetime= $data['updatetime'];
                            //Format
                            $strtotime2=strtotime($periode_awal);
                            $strtotime3=strtotime($periode_akhir);
                            $strtotime4=strtotime($updatetime);
                            $PeriodeAwalFormat=date('d/m/Y',$strtotime2);
                            $PeriodeAkhirFormat=date('d/m/Y',$strtotime3);
                            $UpdateFormat=date('d/m/Y H:i:s T',$strtotime4);
                            //Cek Status
                            $TanggalSekarang=date('Y-m-d');
                            if($TanggalSekarang<$periode_awal){
                                $Status='<span class="badge badge-dark"><i class="bi bi-clock"></i> Belum Mulai</span>';
                            }else{
                                if($TanggalSekarang>$periode_akhir){
                                    $Status='<span class="badge badge-danger"><i class="bi bi-calendar-x"></i> Berakhir</span>';
                                }else{
                                    $Status='<span class="badge badge-success"><i class="bi bi-calendar-check"></i> Berlangsung</span>';
                                }
                            }
                            //Menghitung Jumlah RPJMDES
                            $JumlahRpjmdes = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM rpjmdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                            $JumlahRkpdes = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM rkpdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                            //Menghitung Rincian RPJMDES
                            if(!empty($JumlahRpjmdes)){
                                //Buka RPJMDES
                                $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                                $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
                                $id_rpjmdes=$DataRpjmdes['id_rpjmdes'];
                                $JumlahRincianRpjmdes = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT tahun FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes'"));
                            }else{
                                $JumlahRincianRpjmdes="0";
                            }
                ?>
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">
                                <a href="index.php?Page=RKPDES&Sub=Detail&id=<?php echo $id_evaluasi; ?>"><?php echo "$no. Periode Evaluasi $periode"; ?></a>
                            </b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Waktu Mulai</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAwalFormat"; ?></code></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Waktu Berakhir</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAkhirFormat"; ?></code></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Status Evaluasi</div>
                                        <div class="col col-md-8">
                                            <?php echo "$Status"; ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Update</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><code class="text-grayish"><?php echo "$UpdateFormat"; ?></code></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col col-md-4">RPJMDES</div>
                                        <div class="col col-md-8">
                                            <small class="credit">
                                                <?php
                                                    if(empty($JumlahRpjmdes)){
                                                        echo '<code class="text-danger">Tidak Tersedia</code>';
                                                    }else{
                                                        echo '<code class="text-primary">Tersedia ('.$JumlahRincianRpjmdes.')</code>';
                                                    }
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">RKPDES</div>
                                        <div class="col col-md-8">
                                            <small class="credit">
                                                <?php
                                                    if(empty($JumlahRkpdes)){
                                                        echo '<code class="text-danger">Tidak Tersedia</code>';
                                                    }else{
                                                        echo '<code class="text-primary">Tersedia ('.$JumlahRkpdes.')</code>';
                                                    }
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $no++;}} ?>
            </div>
        </div>
    </section>
<?php } ?>