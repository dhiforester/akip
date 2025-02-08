<?php
    if(empty($_GET['id'])){
        $id_evaluasi="";
    }else{
        $id_evaluasi=$_GET['id'];
    }
    //Detail Evaluasi
    $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
    $periode_awal=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_awal');
    $periode_akhir=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_akhir');
    $updatetime=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'updatetime');
    $sekarang=date('Y-m-d');
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
    $strtotime2=strtotime($periode_awal);
    $strtotime3=strtotime($periode_akhir);
    $strtotime4=strtotime($updatetime);
    $PeriodeAwalFormat=date('d/m/Y',$strtotime2);
    $PeriodeAkhirFormat=date('d/m/Y',$strtotime3);
    $UpdateFormat=date('d/m/Y H:i:s T',$strtotime4);
    //Informasi Otoritas
    $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
    $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
    $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
    $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah lembar penilaian evaluasi SAKIP untuk tingkat kecamatan.';
                echo '  Silahkan pilih desa yang akan dilakukan penilaian dan masuk ke detail evaluasi.';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <b>1. Informasi Evaluasi</b>
                            <div class="row mb-3 mt-3">
                                <div class="col col-md-4">Periode Evaluasi</div>
                                <div class="col col-md-8">
                                    <small class="credit"><code class="text-grayish"><?php echo "$periode"; ?></code></small>
                                </div>
                            </div>
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
                            <b>2. Wilayah Otoritas</b>
                            <div class="row mb-3 mt-3">
                                <div class="col col-md-4">Provinsi</div>
                                <div class="col col-md-8">
                                <small class="credit"><code class="text-grayish"><?php echo "$NamaPropinsi"; ?></code></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kabupaten/Kota</div>
                                <div class="col col-md-8">
                                    <small class="credit"><code class="text-grayish"><?php echo "$NamaKabupaten"; ?></code></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kecamatan</div>
                                <div class="col col-md-8">
                                    <small class="credit"><code class="text-grayish"><?php echo "$NamaKecamatan"; ?></code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td align="center"><b>No</b></td>
                                            <td align="center"><b>Desa</b></td>
                                            <td align="center"><b>KK Miskin</b></td>
                                            <td align="center"><b>Stunting</b></td>
                                            <td align="center"><b>IKM</b></td>
                                            <td align="center"><b>IDM</b></td>
                                            <td align="center"><b>Evaluasi</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $JumlahDesa=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$NamaKecamatan' AND kabupaten='$NamaKabupaten' AND propinsi='$NamaPropinsi'"));
                                            if(empty($JumlahDesa)){
                                                echo '<tr>';
                                                echo '  <td colspan="7" class="text-center text-danger">Wilayah Desa Tidak Ada Untuk Otoritas Wilayah Yang Anda Gunakan</td>';
                                                echo '</tr>';
                                            }else{
                                                $no=1;
                                                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$NamaKecamatan' AND kabupaten='$NamaKabupaten' AND propinsi='$NamaPropinsi' ORDER BY desa ASC");
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $id_wilayah= $data['id_wilayah'];
                                                    $desa= $data['desa'];
                                                    //Apakah Ada Data Rekap Evaluasi?
                                                    $QryRekap = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'")or die(mysqli_error($Conn));
                                                    $DataRekap = mysqli_fetch_array($QryRekap);
                                                    if(empty($DataRekap['id_evaluasi_rekap'])){
                                                        $id_evaluasi_rekap="";
                                                        $SkorEvaluasi='<code class="text-danger">Belum</code>';
                                                    }else{
                                                        $id_evaluasi_rekap=$DataRekap['id_evaluasi_rekap'];
                                                        $SkorEvaluasi=$DataRekap['skor'];
                                                        $SkorEvaluasi='<code class="text-dark">'.$SkorEvaluasi.'</code>';
                                                    }

                                        ?>
                                                <tr>
                                                    <td align="center"><?php echo "$no"; ?></td>
                                                    <td>
                                                        <a href="index.php?Page=LembarKerja&id=<?php echo "$id_evaluasi"; ?>&id_wilayah=<?php echo "$id_wilayah"; ?>">
                                                            <?php echo "$desa"; ?>
                                                        </a>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                            if(!empty(getCapaian($Conn,$id_evaluasi,$id_wilayah,'Miskin','capaian'))){
                                                                $persentase=getCapaian($Conn,$id_evaluasi,$id_wilayah,'Miskin','capaian');
                                                                $status=getCapaian($Conn,$id_evaluasi,$id_wilayah,'Miskin','status');
                                                                if($status=="Dikirim"){
                                                                    $LabelStatus='<code class="text-warning" title="Dokumen Sudah Dikirim Dan Menunggu Validasi Kecamatan">(Dikirim)</code>';
                                                                }else{
                                                                    if($status=="Valid"){
                                                                        $LabelStatus='<code class="text-dark" title="Dokumen Sudah Dinyatakan Valid">(Valid)</code>';
                                                                    }else{
                                                                        if($status=="Refisi"){
                                                                            $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">(Refisi)</code>';
                                                                        }else{
                                                                            $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">(Belum)</code>';
                                                                        }
                                                                    }
                                                                }
                                                                echo "$persentase<br>";
                                                                echo "$LabelStatus";
                                                            }else{
                                                                echo '<code class="text-danger">-</code>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                            if(!empty(getCapaian($Conn,$id_evaluasi,$id_wilayah,'Stunting','capaian'))){
                                                                $persentase=getCapaian($Conn,$id_evaluasi,$id_wilayah,'Stunting','capaian');
                                                                $status=getCapaian($Conn,$id_evaluasi,$id_wilayah,'Stunting','status');
                                                                if($status=="Dikirim"){
                                                                    $LabelStatus='<code class="text-warning" title="Dokumen Sudah Dikirim Dan Menunggu Validasi Kecamatan">(Dikirim)</code>';
                                                                }else{
                                                                    if($status=="Valid"){
                                                                        $LabelStatus='<code class="text-dark" title="Dokumen Sudah Dinyatakan Valid">(Valid)</code>';
                                                                    }else{
                                                                        if($status=="Refisi"){
                                                                            $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">(Refisi)</code>';
                                                                        }else{
                                                                            $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">(Belum)</code>';
                                                                        }
                                                                    }
                                                                }
                                                                echo "$persentase<br>";
                                                                echo "$LabelStatus";
                                                            }else{
                                                                echo '<code class="text-danger">-</code>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                            if(!empty(getCapaian($Conn,$id_evaluasi,$id_wilayah,'IKM','capaian'))){
                                                                $persentase=getCapaian($Conn,$id_evaluasi,$id_wilayah,'IKM','capaian');
                                                                $status=getCapaian($Conn,$id_evaluasi,$id_wilayah,'IKM','status');
                                                                if($status=="Dikirim"){
                                                                    $LabelStatus='<code class="text-warning" title="Dokumen Sudah Dikirim Dan Menunggu Validasi Kecamatan">(Dikirim)</code>';
                                                                }else{
                                                                    if($status=="Valid"){
                                                                        $LabelStatus='<code class="text-dark" title="Dokumen Sudah Dinyatakan Valid">(Valid)</code>';
                                                                    }else{
                                                                        if($status=="Refisi"){
                                                                            $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">(Refisi)</code>';
                                                                        }else{
                                                                            $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">(Belum)</code>';
                                                                        }
                                                                    }
                                                                }
                                                                echo "$persentase<br>";
                                                                echo "$LabelStatus";
                                                            }else{
                                                                echo '<code class="text-danger">-</code>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                            if(!empty(getCapaian($Conn,$id_evaluasi,$id_wilayah,'IDM','capaian'))){
                                                                $persentase=getCapaian($Conn,$id_evaluasi,$id_wilayah,'IDM','capaian');
                                                                $status=getCapaian($Conn,$id_evaluasi,$id_wilayah,'IDM','status');
                                                                if($status=="Dikirim"){
                                                                    $LabelStatus='<code class="text-warning" title="Dokumen Sudah Dikirim Dan Menunggu Validasi Kecamatan">(Dikirim)</code>';
                                                                }else{
                                                                    if($status=="Valid"){
                                                                        $LabelStatus='<code class="text-dark" title="Dokumen Sudah Dinyatakan Valid">(Valid)</code>';
                                                                    }else{
                                                                        if($status=="Refisi"){
                                                                            $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">(Refisi)</code>';
                                                                        }else{
                                                                            $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">(Belum)</code>';
                                                                        }
                                                                    }
                                                                }
                                                                echo "$persentase<br>";
                                                                echo "$LabelStatus";
                                                            }else{
                                                                echo '<code class="text-danger">-</code>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="center"><?php echo "$SkorEvaluasi"; ?></td>
                                                </tr>
                                        <?php
                                                    $no++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>