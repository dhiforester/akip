<?php
    //Cek Aksesibilitas ke halaman ini
    if($SessionAkses=="Admin"||$SessionAkses=="Kecamatan"){
        $IjinAksesSaya=1;
    }else{
        $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'lRlI7MoqtH');
    }
    
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        if(empty($_GET['id'])){
            include "_Page/Error/NoId.php";
        }else{
            if(empty($_GET['id_wilayah'])){
                $id_wilayah="";
                if($SessionAkses=="Desa"){
                    $SessionIdWilayah=$SessionIdWilayah;
                }else{
                    $SessionIdWilayah="";
                }
            }else{
                $id_wilayah=$_GET['id_wilayah'];
                if($SessionAkses=="Desa"){
                    $SessionIdWilayah=$SessionIdWilayah;
                }else{
                    $SessionIdWilayah=$id_wilayah;
                }
            }
            $id_evaluasi=$_GET['id'];
            //Jumlah Sesi Evaluasi
            $KeberadaanEvaluasi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi WHERE id_evaluasi='$id_evaluasi'"));
?>
    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Berikut ini adalah halaman lembar kerja untuk melengkapi data SAKIP. 
                    Silahkan lengkapi semua indikator informasi yang tersedia.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
            <?php
                if(empty($KeberadaanEvaluasi)){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <div class="card">';
                    echo '          <div class="card-body text-center text-danger">';
                    echo '              ID <i>credentials</i> evaluasi yang digunakan tidak ditemukan pada database.<br>';
                    echo '          </div>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
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
                <?php if($SessionAkses=="Kecamatan"){ ?>
                    <div class="row mb-3">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="index.php?Page=LembarKerjaKec&Sub=ListDesaByKecamatan&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-mb btn-rounded btn-dark btn-block">
                                <i class="bi bi-chevron-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <b class="card-title text-dark">
                                    LEMBAR KERJA PENGISIAN SAKIP TAHUN <?php echo "$periode"; ?>
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
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
                                        <div class="row mb-3">
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
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Desa</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><code class="text-grayish"><?php echo "$NamaDesa"; ?></code></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BackupLembarKerja.php -->
                <?php
                    // Data JSON yang diberikan
                        $json_data_fitur = ReferensiTargetCapaian();
                        // Decode data JSON menjadi array asosiatif
                        $DataFitur = json_decode($json_data_fitur, true);
                        // Looping untuk mengakses setiap elemen
                        foreach ($DataFitur as $ItemFitur) {
                            $NomorFitur = $ItemFitur['id'];
                            $indikator = $ItemFitur['indikator'];
                            $label_title = $ItemFitur['label_title'];
                            //Rumah Tangga Miskin
                            $QryMiskin = mysqli_query($Conn,"SELECT * FROM capaian WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah' AND indikator='$indikator'")or die(mysqli_error($Conn));
                            $DataMiskin = mysqli_fetch_array($QryMiskin);
                            if(empty($DataMiskin['id_capaian'])){
                                $id_capaian ="";
                                $jumlah_rt_miskin="";
                                $target_rt_miskin="";
                                $capaian_rt_miskin="";
                                $persentase_rt_miskin="";
                                $dokumen_rt_miskin="";
                                $catatan_rt_miskin="";
                                $status_rt_miskin="";
                                $updatetime_rt_miskin="";
                            }else{
                                $id_capaian =$DataMiskin['id_capaian'];
                                $jumlah_rt_miskin=$DataMiskin['jumlah'];
                                $target_rt_miskin=$DataMiskin['target'];
                                $capaian_rt_miskin=$DataMiskin['capaian'];
                                $persentase_rt_miskin=$DataMiskin['persentase'];
                                $dokumen_rt_miskin=$DataMiskin['dokumen'];
                                $catatan_rt_miskin=$DataMiskin['catatan'];
                                $status_rt_miskin=$DataMiskin['status'];
                                $updatetime_rt_miskin=$DataMiskin['updatetime'];
                            }
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <b class="text-dark"><?php echo "$NomorFitur. $label_title"; ?></b>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col col-md-4">
                                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_target'); ?>
                                                </div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($target_rt_miskin)){
                                                                echo '<code class="text-dark">'.$target_rt_miskin.'</code>';
                                                                echo '<code class="text-dark"> '.CekParameterCapaianTarget($json_data_fitur,$indikator,'sat_target').'</code>';
                                                            }else{
                                                                echo '<code>Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">
                                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_jumlah'); ?>
                                                </div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($jumlah_rt_miskin)){
                                                                echo '<code class="text-dark">'.$jumlah_rt_miskin.'</code>';
                                                                echo '<code class="text-dark"> '.CekParameterCapaianTarget($json_data_fitur,$indikator,'sat_jumlah').'</code>';
                                                            }else{
                                                                echo '<code>Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">
                                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_capaian'); ?>
                                                </div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($capaian_rt_miskin)){
                                                                echo '<code class="text-dark">'.$capaian_rt_miskin.'</code>';
                                                                echo '<code class="text-dark"> '.CekParameterCapaianTarget($json_data_fitur,$indikator,'sat_capaian').'</code>';
                                                            }else{
                                                                echo '<code>Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <?php if($indikator=="IKM"){ ?>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">Lampiran</div>
                                                    <div class="col col-md-8">
                                                        <small>
                                                            <a href="https://docs.google.com/document/d/1P6fXwDoUDyY-cjldUO8_4NBXTCcc6bv5/edit?usp=sharing&ouid=108851066875980620495&rtpof=true&sd=true">
                                                                Download Template Angket/Quisioner IKM 
                                                            </a>
                                                        </small>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php
                                                if(!empty(CekParameterCapaianTarget($json_data_fitur,$indikator,'label_nilai'))){
                                            ?>
                                                <div class="row mb-3">
                                                    <div class="col col-md-4">
                                                        <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_nilai'); ?>
                                                    </div>
                                                    <div class="col col-md-8">
                                                        <small class="credit">
                                                            <?php
                                                                if(!empty($persentase_rt_miskin)){
                                                                    echo '<code class="text-dark">'.$persentase_rt_miskin.'</code>';
                                                                    echo '<code class="text-dark"> '.CekParameterCapaianTarget($json_data_fitur,$indikator,'sat_nilai').'</code>';
                                                                }else{
                                                                    echo '<code>Tidak Ada</code>';
                                                                }
                                                            ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Dokumen</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($dokumen_rt_miskin)){
                                                                echo '<code class="text-primary">';
                                                                echo '  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLihatDokumen" data-id="'.$id_capaian.'"><i class="bi bi-paperclip"></i> Lampiran Dokumen</a>';
                                                                echo '</code>';
                                                            }else{
                                                                echo '<code>Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Status</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if($status_rt_miskin=="Dikirim"){
                                                                $LabelStatus='<code class="text-warning" title="Dokumen Sudah Dikirim Dan Menunggu Validasi Kecamatan">Dikirim</code>';
                                                            }else{
                                                                if($status_rt_miskin=="Valid"){
                                                                    $LabelStatus='<code class="text-dark" title="Dokumen Sudah Dinyatakan Valid">Valid</code>';
                                                                }else{
                                                                    if($status_rt_miskin=="Refisi"){
                                                                        $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">Refisi</code>';
                                                                    }else{
                                                                        $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">Tidak Ada</code>';
                                                                    }
                                                                }
                                                            }
                                                            echo "$LabelStatus"; 
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Catatan</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($catatan_rt_miskin)){
                                                                echo '<code class="text-warning">'.$catatan_rt_miskin.'</code>';
                                                            }else{
                                                                echo '<code class="text text-grayish">Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Update</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php
                                                            if(!empty($updatetime_rt_miskin)){
                                                                $strtotime=strtotime($updatetime_rt_miskin);
                                                                $Updatetime=date('d/m/Y H:i:s T',$strtotime);
                                                                echo '<code class="text-dark">'.$Updatetime.'</code>';
                                                            }else{
                                                                echo '<code>Tidak Ada</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php 
                                        if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                            if($SessionAkses=="Desa"){
                                                if($status_rt_miskin!=="Valid"){
                                                
                                    ?>
                                                <div class="button">
                                                    <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i> Option
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                        <li class="dropdown-header text-start">
                                                            <h6>Option</h6>
                                                        </li>
                                                        <li>
                                                            <?php if(empty($id_capaian)){ ?>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahKkMiskin" data-id="<?php echo "$id_evaluasi,$indikator"; ?>">
                                                                    <i class="bi bi-plus"></i> Tambah Data
                                                                </a>
                                                            <?php }else{ ?>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditCapaian" data-id="<?php echo "$id_capaian,$indikator"; ?>">
                                                                    <i class="bi bi-pencil-square"></i> Ubah Data
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangDokumen" data-id="<?php echo "$id_capaian"; ?>">
                                                                    <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusIndikator" data-id="<?php echo "$id_capaian"; ?>">
                                                                    <i class="bi bi-trash"></i> Hapus Laporan
                                                                </a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                    <?php 
                                                }else{
                                                    echo '<code class="text text-grayish">*Data Sudah Memperoleh Validitas Kecamatan</code>';
                                                }
                                            }
                                        }
                                    ?>
                                    <?php 
                                        if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                            if($SessionAkses=="Kecamatan"){
                                                if(!empty($id_capaian)){
                                    ?>
                                                <div class="button">
                                                    <a class="btn btn-sm btn-outline-grayish" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i> Option
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                        <li class="dropdown-header text-start">
                                                            <h6>Option</h6>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUpdateStatus" data-id="<?php echo "$id_capaian,$indikator"; ?>">
                                                                <i class="bi bi-pencil-square"></i> Update Status
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                    <?php 
                                                }else{
                                                    echo '<code>*Data Belum Diisi Oleh Desa</code>';
                                                }
                                            }
                                        }
                                    ?>
                                    <?php 
                                        if($SessionAkses=="Admin"){
                                    ?>
                                                <div class="button">
                                                    <a class="btn btn-sm btn-outline-grayish" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i> Option
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                        <li class="dropdown-header text-start">
                                                            <h6>Option</h6>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUpdateStatus" data-id="<?php echo "$id_capaian,$indikator"; ?>">
                                                                <i class="bi bi-pencil-square"></i> Update Status
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <b class="text-dark">
                                    5. Kriteria & Indikator Evaluasi Sakip
                                </b>
                            </div>
                            <div class="card-body">
                                <?php
                                    $QryRekapitulasi = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                                    $DataRekapitulasi = mysqli_fetch_array($QryRekapitulasi);
                                    if(empty($DataRekapitulasi['id_evaluasi_rekap'])){
                                        $id_evaluasi_rekap="";
                                        $LabelEvaluasiRekap='<code class="text-danger">None</code>';
                                        $statusKepesertaan='<code class="text-danger">Belum Mengikuti</code>';
                                        $TotelSkorRekapitulasi='<code class="text-danger">None</code>';
                                        $Rekomendasi='<code class="text-danger">None</code>';
                                        $StatusRekapitulasi='<code class="text-danger">None</code>';
                                    }else{
                                        $id_evaluasi_rekap=$DataRekapitulasi['id_evaluasi_rekap'];
                                        $LabelEvaluasiRekap='<code class="text-info">'.$id_evaluasi_rekap.'</code>';
                                        $statusKepesertaan='<code class="text-info">Mengikuti</code>';
                                        $TotelSkorRekapitulasi=$DataRekapitulasi['skor'];
                                        $TotelSkorRekapitulasi='<code class="text text-grayish">'.$TotelSkorRekapitulasi.'</code>';
                                        $Rekomendasi=$DataRekapitulasi['rekomendasi'];
                                        $Rekomendasi='<code class="text text-grayish">'.$Rekomendasi.'</code>';
                                        $StatusRekapitulasi=$DataRekapitulasi['status'];
                                        $StatusRekapitulasi='<code class="text text-grayish">'.$StatusRekapitulasi.'</code>';
                                    }
                                ?>
                                <div class="row mb-3 mt-3">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col col-md-4">ID Rekap</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$LabelEvaluasiRekap"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Total Skor/Nilai</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$TotelSkorRekapitulasi"; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Status</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$StatusRekapitulasi"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Rekomendasi</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$Rekomendasi"; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($SessionAkses=="Desa"){ ?>
                                <div class="card-footer">
                                    <a href="index.php?Page=EvaluasiDesa&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-sm btn-outline-dark">
                                        Detail <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if($SessionAkses=="Kecamatan"||$SessionAkses=="Admin"){ ?>
                                <div class="card-footer">
                                    <a href="index.php?Page=EvaluasiDesa&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>&id_wilayah=<?php echo "$SessionIdWilayah"; ?>" class="btn btn-sm btn-outline-dark">
                                        Detail <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
    </section>
<?php 
        }
    }
?>