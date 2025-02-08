<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'7q67hxIWmb');
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
                        echo '<div class="row">';
                        echo '  <div class="col-md-12">';
                        echo '      <div class="alert alert-info alert-dismissible fade show" role="alert">';
                        echo '          Berikut ini adalah halaman rincian RPJMDES sesuai <i>Credential</i> evaluasi pihak Kabupaten.';
                        echo '          Pada halaman ini anda bisa mengelola data RPJMDES dan berkas/dokumen pendukung.';
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
                        //Cek Ketersediaan Data RPJMDES
                        $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                        $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
                        if(empty($DataRpjmdes['id_rpjmdes'])){
                            $id_rpjmdes="";
                            $PeriodeRpjmdes='<code class="text-danger">No Data</code>';
                            $kepala_desa='<code class="text-danger">No Data</code>';
                            $sekretaris_desa='<code class="text-danger">No Data</code>';
                            $status_rpjmdes="";
                            $IdRpjmdesLabel='<code class="text-danger">No Data</code>';
                            $StatusLabel='<code class="text-danger">No Data</code>';
                            $DokumenLabel='<code class="text-danger">No Data</code>';
                            $catatan='<code class="text-danger">No Data</code>';
                            $UpdateRpjmdesFormat='<code class="text-danger">No Data</code>';
                            $Anggaran='<code class="text-danger">No Data</code>';
                            $JumlahDokumen=0;
                        }else{
                            $id_rpjmdes=$DataRpjmdes['id_rpjmdes'];
                            $periode_rpjmdes=$DataRpjmdes['periode'];
                            $PeriodeRpjmdes='<code class="text-grayish">'.$periode_rpjmdes.'</code>';
                            $kepala_desa=$DataRpjmdes['kepala_desa'];
                            $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                            $kepala_desa='<code class="text-grayish">'.$kepala_desa.'</code>';
                            $sekretaris_desa='<code class="text-grayish">'.$sekretaris_desa.'</code>';
                            $status_rpjmdes=$DataRpjmdes['status'];
                            $IdRpjmdesLabel='<code class="text-grayish">'.$id_rpjmdes.'</code>';
                            if($status_rpjmdes=="Edited"){
                                $StatusLabel='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                            }else{
                                if($status_rpjmdes=="Request"){
                                    $StatusLabel='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                }else{
                                    if($status_rpjmdes=="Valid"){
                                        $StatusLabel='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                    }else{
                                        if($status_rpjmdes=="Revision"){
                                            $StatusLabel='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                        }else{
                                            $StatusLabel='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                        }
                                    }
                                }
                            }
                            $dokumen=$DataRpjmdes['dokumen'];
                            $DokumenLabel='<code class="text-primary"><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_rpjmdes.'"><i class="bi bi-paperclip"></i> Dokumen RPJMDES</a></code>';
                            if(empty($DataRpjmdes['catatan'])){
                                $catatan='<code class="text-danger">No Data</code>';
                            }else{
                                $catatan=$DataRpjmdes['catatan'];
                                $catatan='<code class="text-danger">'.$catatan.'</code>';
                            }
                            $Anggaran=$DataRpjmdes['jumlah_anggaran'];
                            $Anggaran = "Rp " . number_format($Anggaran, 2, ',', '.');
                            $Anggaran='<code class="text-grayish">'.$Anggaran.'</code>';
                            $UpdateRpjmdes=$DataRpjmdes['updatetime'];
                            $strtotime55=strtotime($UpdateRpjmdes);
                            $UpdateRpjmdesFormat=date('d/m/Y H:i:s T',$strtotime55);
                            $UpdateRpjmdesFormat='<code class="text-grayish">'.$UpdateRpjmdesFormat.'</code>';
                        }
        ?>
            <input type="hidden" id="GetIdRpjmdes" value="<?php echo "$id_rpjmdes"; ?>">
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
                        <?php if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ ?>
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                    <li class="dropdown-header text-start">
                                        <h6>Option</h6>
                                    </li>
                                    <li>
                                        <?php if(empty($DataRpjmdes['id_rpjmdes'])){ ?>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahRpjmdes" data-id="<?php echo "$id_evaluasi"; ?>">
                                                <i class="bi bi-plus"></i> Tambah RPJMDES
                                            </a>
                                        <?php 
                                            }else{ 
                                                if($status_rpjmdes=="Edited"||$status_rpjmdes=="Revision"){
                                        ?>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                                <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                                <i class="bi bi-send"></i> Kirim RPJMDES
                                            </a>
                                        <?php 
                                                }else{
                                                    echo '<a class="dropdown-item" href="index.php?Page=RPJMDES&Sub=Rincian&id='.$id_evaluasi.'">';
                                                    echo '  <i class="bi bi-info-circle"></i> Reload Halaman RPJMDES';
                                                    echo '</a>';
                                                } 
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="card-header">
                            <b class="card-title"><i class="bi bi-info-circle"></i> Detail Berkas RPJMDES</b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Informasi Evaluasi</b>
                                    <ul>
                                        <li>
                                            Periode : <small class="credit"><code class="text-grayish"><?php echo "$periode"; ?></code></small>
                                        </li>
                                        <li>
                                            Mulai : <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAwalFormat"; ?></code></small>
                                        </li>
                                        <li>
                                            Selesai : <small class="credit"><code class="text-grayish"><?php echo "$PeriodeAkhirFormat"; ?></code></small>
                                        </li>
                                        <li>
                                            Status : <small class="credit"><?php echo "$Status"; ?></small>
                                        </li>
                                        <li>
                                            Update : <small class="credit"><code class="text-grayish"><?php echo "$UpdateFormat"; ?></code></small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <b>Informasi RPJMDES</b>
                                    <ul>
                                        <li>
                                            Periode : <small class="credit"><?php echo "$PeriodeRpjmdes"; ?></small>
                                        </li>
                                        <li>
                                            Kepala Desa : <small class="credit"><?php echo "$kepala_desa"; ?></small>
                                        </li>
                                        <li>
                                            Sekretaris Desa : <small class="credit"><?php echo "$sekretaris_desa"; ?></small>
                                        </li>
                                        <li>
                                            Anggaran : <small class="credit"><?php echo "$Anggaran"; ?></small>
                                        </li>
                                        <li>
                                            Dokumen : <small class="credit"><?php echo "$DokumenLabel"; ?></small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <b>Keterangan Lainnya</b>
                                    <ul>
                                        <li>Catatan : <small class="credit"><?php echo "$catatan"; ?></small></li>
                                        <li>Status : <small class="credit"><?php echo "$StatusLabel"; ?></small></li>
                                        <li>Update : <small class="credit"><?php echo "$UpdateRpjmdesFormat"; ?></small></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                    <?php 
                        if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                            if(!empty($DataRpjmdes['id_rpjmdes'])){
                                if($status_rpjmdes=="Edited"||$status_rpjmdes=="Revision"){
                    ?>
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                    <li class="dropdown-header text-start">
                                        <h6>Option</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDownloadTemplateRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                            <i class="bi bi-cloud-arrow-down"></i> Download Template
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalImportDataRpjmdes" data-id="<?php echo "$id_rpjmdes"; ?>">
                                            <i class="bi bi-upload"></i> Import Data
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php }}} ?>
                        <div class="card-header">
                            <b class="card-title"><i class="bi bi-table"></i> Uraian RPJMDES</b>
                        </div>
                        <div class="card-body">
                            <?php
                                //Apabila belum ada RPJMDES
                                if(empty($DataRpjmdes['id_rpjmdes'])){
                                    echo '<div class="row">';
                                    echo '  <div class="col-md-12 text-center text-danger">';
                                    echo '      Silahkan Lengkapi Informasi RPJMDES Wilayah Otoritas Anda Terlebih Dulu';
                                    echo '  </div>';
                                    echo '</div>';
                                }else{
                                    echo '<div class="row">';
                                    echo '  <div class="col-md-12" id="MenampilkanRincianRpjmdes">';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }}} ?>
    </section>
<?php } ?>