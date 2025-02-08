<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'X84HkV9Ld3');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{

?>
<section class="section dashboard">
    <?php
        //Apakah Ada ID yang Ditangkap Dari Link
        if(empty($_GET['id'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '          ID tidak boleh kosong!<br>';
            echo '          Terjadi kesalahan pada sistem ketika anda mencoba masuk ke halaman yang membutuhkan parameter ID.';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_evaluasi=$_GET['id'];
            //Validasi karakter ID
            if(!ctype_digit($id_evaluasi)){
                echo '<div class="row">';
                echo '  <div class="col-md-12">';
                echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '          Anda menggunakan karakter ilegal untuk akses data pada halaman ini.<br>';
                echo '          Terjadi kesalahan pada sistem ketika anda mencoba masuk ke halaman yang membutuhkan parameter ID.';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }else{
                //Validasi Keberadaan Data
                $QryEvaluasi = mysqli_query($Conn,"SELECT * FROM evaluasi WHERE id_evaluasi='$id_evaluasi'")or die(mysqli_error($Conn));
                $DataEvaluasi = mysqli_fetch_array($QryEvaluasi);
                if(empty($DataEvaluasi['id_evaluasi'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12">';
                    echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo '          ID Evaluasi yang anda gunakan tidak valid.<br>';
                    echo '          Terjadi kesalahan pada sistem ketika anda mencoba masuk ke halaman yang membutuhkan parameter ID.';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '          Berikut ini adalah halaman APBDES sesuai <i>Credential</i> evaluasi pihak Kabupaten dan RKPDES yang sudah disusun sebelumnya.';
                    echo '          Pada halaman ini anda bisa mengelola data APBDES dan melampirkan berkas/dokumen pendukung.';
                    echo '          Pastikan anda sudah melakukan update pengiriman data agar pihak Kecamatan bisa melakukan validasi';
                    echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                    //Buka Detail Evaluasi
                    $id_evaluasi=$DataEvaluasi['id_evaluasi'];
                    $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
                    $periode_awal=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_awal');
                    $periode_akhir=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_akhir');
                    $updatetime=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'updatetime');
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
                    //Cek Ketersediaan Data RKPDES
                    $QryRkpdes = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                    $DataRkpdes = mysqli_fetch_array($QryRkpdes);
                    if(empty($DataRkpdes['id_rkpdes'])){
                        echo '<div class="row">';
                        echo '  <div class="col-md-12">';
                        echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo '          Anda belum mengisi data RKPDES.<br>';
                        echo '          Untuk melakukan pengisian data APBDES ini, anda diharuskan mengisi data RKPDES terlebih dulu.';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3 mt-3">';
                        echo '  <div class="col-md-10"></div>';
                        echo '  <div class="col-md-2">';
                        echo '      <a href="index.php?Page=LembarKerja&id='.$id_evaluasi.'" class="btn btn-md btn-dark btn-block btn-rounded" title="Kembali Ke halaman utama RPJMDES">';
                        echo '          <i class="bi bi-arrow-left-circle"></i> Kembali';
                        echo '      </a>';
                        echo '  </div>';
                        echo '</div>';
                    }else{
                        $id_rkpdes=$DataRkpdes['id_rkpdes'];
                        $periode_rkpdes=$DataRkpdes['periode'];
                        $kepala_desa_rkpdes=$DataRkpdes['kepala_desa'];
                        $sekretaris_desa_rkpdes=$DataRkpdes['sekretaris_desa'];
                        $AnggaranRkpdes=$DataRkpdes['jumlah_anggaran'];
                        $status_rkpdes=$DataRkpdes['status'];
                        $updatetime_rkpdes=$DataRkpdes['updatetime'];
                        //Label
                        $LabelPeriodeRkpdes='<code class="text-grayish">RKPDES Periode '.$periode_rkpdes.'</code>';
                        $LabelKepalaDesaRkpdes='<code class="text-grayish">'.$kepala_desa_rkpdes.'</code>';
                        $LabelSekretarisDesaRkpdes='<code class="text-grayish">'.$sekretaris_desa_rkpdes.'</code>';
                        $LabelAnggaranRkpdes = "Rp " . number_format($AnggaranRkpdes, 2, ',', '.');
                        $LabelAnggaranRkpdes='<code class="text-grayish">'.$LabelAnggaranRkpdes.'</code>';
                        $strtotime6=strtotime($updatetime_rkpdes);
                        $LabelUpdatetimeRkpdes=date('d/m/Y H:i:s T',$strtotime6);
                        $LabelUpdatetimeRkpdes='<code class="text-grayish">'.$LabelUpdatetimeRkpdes.'</code>';
                        if($status_rkpdes=="Edited"){
                            $StatusLabelRkpdes='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                        }else{
                            if($status_rkpdes=="Request"){
                                $StatusLabelRkpdes='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                            }else{
                                if($status_rkpdes=="Valid"){
                                    $StatusLabelRkpdes='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                }else{
                                    if($status_rkpdes=="Revision"){
                                        $StatusLabelRkpdes='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                    }else{
                                        $StatusLabelRkpdes='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                    }
                                }
                            }
                        }
    ?>
                <div class="row mb-3">
                    <div class="col-md-10 mt-3"></div>
                    <div class="col-md-2 text-center mt-3">
                        <a href="index.php?Page=LembarKerja&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-md btn-dark btn-block btn-rounded" title="Kembali Ke halaman lembar kerja">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <b>A. Informasi Sesi Evaluasi</b>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Periode</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><code class="text-grayish"><?php echo "$periode"; ?></code></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Mulai</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAwalFormat"; ?></code></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Selesai</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAkhirFormat"; ?></code></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Status</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$Status"; ?></small>
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
                                            <div class="col-md-12">
                                                <b>B. Acuan Yang Digunakan</b>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Dokumen</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$LabelPeriodeRkpdes"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Kepala Desa</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$LabelKepalaDesaRkpdes"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Sekretaris Desa</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$LabelSekretarisDesaRkpdes"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Total Anggaran</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$LabelAnggaranRkpdes"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Status</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$StatusLabelRkpdes"; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menampilkan RKPEDES Pertahun Sesuai RPJMDES/start -->
                <?php 
                    //Buka Detail APBDES
                    $QryApbdes = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                    $DataApbdes = mysqli_fetch_array($QryApbdes);
                    if(empty($DataApbdes['id_apbdes'])){
                        $id_apbdes="";
                        $id_apbdes="";
                        $PeriodeApbdes="";
                        $KepalaDesaApbdes="";
                        $SekretarisDesaApbdes="";
                        $JumlahAnggaranApbdes="";
                        $DokumenApbdes="";
                        $CatatanApbdes="";
                        $StatusApbdes="";
                        $UpdatetimeApbdes="";
                    }else{
                        $id_apbdes=$DataApbdes['id_apbdes'];
                        $PeriodeApbdes=$DataApbdes['periode'];
                        $KepalaDesaApbdes=$DataApbdes['kepala_desa'];
                        $SekretarisDesaApbdes=$DataApbdes['sekretaris_desa'];
                        $JumlahAnggaranApbdes=$DataApbdes['jumlah_anggaran'];
                        $DokumenApbdes=$DataApbdes['dokumen'];
                        $CatatanApbdes=$DataApbdes['catatan'];
                        $StatusApbdes=$DataApbdes['status'];
                        $UpdatetimeApbdes=$DataApbdes['updatetime'];
                    }
                ?>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <?php 
                                    if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                        if($StatusApbdes=="Edited"||$StatusApbdes=="Revision"||$StatusApbdes==""){
                                ?>
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                            <li class="dropdown-header text-start">
                                                <h6>Option</h6>
                                            </li>
                                            <li>
                                                <?php if(empty($id_apbdes)){ ?>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahApbdes" data-id="<?php echo "$id_evaluasi"; ?>">
                                                        <i class="bi bi-plus"></i> Tambah APBDES
                                                    </a>
                                                <?php 
                                                    }else{ 
                                                        if($StatusApbdes=="Edited"||$StatusApbdes=="Revision"){
                                                ?>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditApbdes" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangApbdes" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDownloadTemplateApbdes" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-cloud-arrow-down"></i> Download Template
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadDataset" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-upload"></i> Import Dataset
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusApbdes" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimApbdes" data-id="<?php echo "$id_apbdes"; ?>">
                                                        <i class="bi bi-send"></i> Kirim APBDES
                                                    </a>
                                                <?php 
                                                        }else{
                                                            echo '<a class="dropdown-item" href="">';
                                                            echo '  <i class="bi bi-info-circle"></i> Reload Halaman';
                                                            echo '</a>';
                                                        } 
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php 
                                        }
                                    }
                                ?>
                                <input type="hidden" id="GetIdApbdes" value="<?php echo $id_apbdes; ?>">
                                <div class="card-header">
                                    <b class="card-title text-dark">C. Dataset APBDES</b>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Periode</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($PeriodeApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                echo '<code class="text-dark">'.$PeriodeApbdes.'</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Kepala Desa</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($KepalaDesaApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                echo '<code class="text-dark">'.$KepalaDesaApbdes.'</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Sekretaris Desa</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($SekretarisDesaApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                echo '<code class="text-dark">'.$SekretarisDesaApbdes.'</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Jumlah Anggaran</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($JumlahAnggaranApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                $JumlahAnggaranApbdes = "Rp " . number_format($JumlahAnggaranApbdes, 2, ',', '.');
                                                                echo '<code class="text-dark">'.$JumlahAnggaranApbdes.'</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Dokumen Pendukung</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($DokumenApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                echo '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_apbdes.'">';
                                                                echo '  <code class="text-primary"><i class="bi bi-paperclip"></i> Lampiran APBDES</code>';
                                                                echo '</a>';
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
                                                            if($StatusApbdes=="Edited"){
                                                                $LabelStatusApbdes='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                                                            }else{
                                                                if($StatusApbdes=="Request"){
                                                                    $LabelStatusApbdes='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                                                }else{
                                                                    if($StatusApbdes=="Valid"){
                                                                        $LabelStatusApbdes='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                                                    }else{
                                                                        if($StatusApbdes=="Revision"){
                                                                            $LabelStatusApbdes='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                                                        }else{
                                                                            $LabelStatusApbdes='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            echo "$LabelStatusApbdes"; 
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col col-md-4">Update</div>
                                                <div class="col col-md-8">
                                                    <small class="credit">
                                                        <?php 
                                                            if(empty($UpdatetimeApbdes)){
                                                                echo '<code>None</code>';
                                                            }else{
                                                                $strtotime_apbdes=strtotime($UpdatetimeApbdes);
                                                                $UpdatetimeApbdesFormat=date('d/m/Y H:i:s T');
                                                                echo '<code class="text-dark">'.$UpdatetimeApbdesFormat.'</code>';
                                                            }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3 border-top border-1 border-black">
                                        <?php
                                            //Apakah sudah punya APBDES Rincian?
                                            $JumlahRincian=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM apbdes_rincian WHERE id_apbdes='$id_apbdes'"));
                                            if(!empty($JumlahRincian)){
                                                echo '<div class="col-md-12 mt-3" id="MenampilkanDatasetApbdes">';
                                                echo '  Dataset Akan Tampil Disini';
                                                echo '</div>';
                                            }else{
                                                echo '<div class="col-md-12 text-center text-danger mt-3">';
                                                echo '  Dataset APBDES Tidak Tersedia';
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Menampilkan RKPEDES Pertahun Sesuai RPJMDES/End -->
        <?php }}}} ?>
    </section>
<?php
    }
?>