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
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <div class="alert alert-info alert-dismissible fade show" role="alert">';
                        echo '          Berikut ini adalah halaman rincian RKPDES sesuai <i>Credential</i> evaluasi pihak Kabupaten dan RPJMDES yang sudah disusun sebelumnya.';
                        echo '          Pada halaman ini anda bisa mengelola data RKPDES dan berkas/dokumen pendukung.';
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
                            echo '<div class="row">';
                            echo '  <div class="col-md-12">';
                            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo '          Anda belum mengisi data RPJMDES.<br>';
                            echo '          Untuk melakukan pengisian data RKPDES, anda diharuskan mengisi data RPJMDES terlebih dulu.';
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
                            $id_rpjmdes=$DataRpjmdes['id_rpjmdes'];
                            $periode_rpjmdes=$DataRpjmdes['periode'];
                            $PeriodeRpjmdes='<code class="text-grayish">RPJMDES Periode '.$periode_rpjmdes.'</code>';
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
                            $DokumenLabel='<code class="text-success"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_rpjmdes.'"><i class="bi bi-paperclip"></i> Dokumen RPJMDES</a></code>';
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
                            //Explode
                            $explode=explode('-',$periode_rpjmdes);
                            $periode_awal=$explode['0'];
                            $periode_akhir=$explode['1'];
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
                            <div class="card-header">
                                <b class="card-title"><i class="bi bi-info-circle"></i> Detail Informasi RKPDES</b>
                            </div>
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
                                                <small class="credit"><?php echo "$PeriodeRpjmdes"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Kepala Desa</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$kepala_desa"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Sekretaris Desa</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$sekretaris_desa"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Total Anggaran</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$Anggaran"; ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Status</div>
                                            <div class="col col-md-8">
                                                <small class="credit"><?php echo "$StatusLabel"; ?></small>
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
                    $no=1; 
                    for($i=$periode_awal; $i<=$periode_akhir; $i++){ 
                        if($i==$periode){
                            //Buka Detail RKPDES
                            $QryRkpdes = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah' AND id_rpjmdes='$id_rpjmdes' AND periode='$i'")or die(mysqli_error($Conn));
                            $DataRkpdes = mysqli_fetch_array($QryRkpdes);
                            if(empty($DataRkpdes['id_rkpdes'])){
                                $id_rkpdes="";
                                $LabelIdRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $AnggaranRkpdes="0";
                                $AnggaranRkpdes = "" . number_format($AnggaranRkpdes, 0, ',', '.');
                                $LabelAnggaranRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $dokumen_rkpdes="";
                                $LabelDokumenRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $LabelStatusRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $status_rkpdes="";
                                $LabelUpdateRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $LabelKepalaDesaRkpdes='<code class="text-danger">Tidak Ada</code>';
                                $LabelSekretarisDesaRkpdes='<code class="text-danger">Tidak Ada</code>';
                            }else{
                                $id_rkpdes=$DataRkpdes['id_rkpdes'];
                                $LabelIdRkpdes='<code class="text-info">'.$id_rkpdes.'</code>';
                                $AnggaranRkpdes=$DataRkpdes['jumlah_anggaran'];
                                $AnggaranRkpdes = "Rp " . number_format($AnggaranRkpdes, 0, ',', '.');
                                $LabelAnggaranRkpdes='<code class="text-grayish">'.$AnggaranRkpdes.'</code>';
                                $dokumen_rkpdes=$DataRkpdes['dokumen'];
                                $LabelDokumenRkpdes='<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_rkpdes.'"><code class="text-primary"><i class="bi bi-paperclip"></i> Lampiran RKPDES '.$i.'</code></a>';
                                $status_rkpdes=$DataRkpdes['status'];
                                if($status_rkpdes=="Edited"){
                                    $LabelStatusRkpdes='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                                }else{
                                    if($status_rkpdes=="Request"){
                                        $LabelStatusRkpdes='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                    }else{
                                        if($status_rkpdes=="Valid"){
                                            $LabelStatusRkpdes='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                        }else{
                                            if($status_rkpdes=="Revision"){
                                                $LabelStatusRkpdes='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                            }else{
                                                $LabelStatusRkpdes='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                            }
                                        }
                                    }
                                }
                                $UpdateRkpdes=$DataRkpdes['updatetime'];
                                $LabelUpdateRkpdes='<code class="text-grayish">'.$UpdateRkpdes.'</code>';
                                $kepala_desa_rkpdes=$DataRkpdes['kepala_desa'];
                                $sekretaris_desa_rkpdes=$DataRkpdes['sekretaris_desa'];
                                $LabelKepalaDesaRkpdes='<code class="text-grayish">'.$kepala_desa_rkpdes.'</code>';
                                $LabelSekretarisDesaRkpdes='<code class="text-grayish">'.$sekretaris_desa_rkpdes.'</code>';
                            }
                ?>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <?php 
                                        if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                            if($status_rkpdes=="Edited"||$status_rkpdes=="Revision"||$status_rkpdes==""){
                                    ?>
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                <li class="dropdown-header text-start">
                                                    <h6>Option</h6>
                                                </li>
                                                <li>
                                                    <?php if(empty($DataRkpdes['id_rkpdes'])){ ?>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahRkpdes" data-id="<?php echo "$id_rpjmdes,$i"; ?>">
                                                            <i class="bi bi-plus"></i> Tambah RKPDES
                                                        </a>
                                                    <?php 
                                                        }else{ 
                                                            if($status_rkpdes=="Edited"||$status_rkpdes=="Revision"){
                                                    ?>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditRkpdes" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangRkpdes" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDownloadTemplate" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-cloud-arrow-down"></i> Download Template
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadDataset" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-upload"></i> Import Dataset
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusRkpdes" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimRkpdes" data-id="<?php echo "$id_rkpdes"; ?>">
                                                            <i class="bi bi-send"></i> Kirim RKPDES
                                                        </a>
                                                    <?php 
                                                            }else{
                                                                echo '<a class="dropdown-item" href="index.php?Page=RPJMDES&Sub=Rincian&id='.$id_evaluasi.'">';
                                                                echo '  <i class="bi bi-info-circle"></i> Detail RKPDES';
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
                                    <input type="hidden" id="GetIdRkpdes" value="<?php echo $id_rkpdes; ?>">
                                    <div class="card-header">
                                        <b class="card-title"><?php echo "Dataset RKPDES Tahun $i"; ?></b>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
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
                                                    <div class="col col-md-4">Jumlah Anggaran</div>
                                                    <div class="col col-md-8">
                                                        <small class="credit"><?php echo "$LabelAnggaranRkpdes"; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row mb-3">
                                                    <div class="col col-md-4">Dokumen Pendukung</div>
                                                    <div class="col col-md-8">
                                                        <small class="credit"><?php echo "$LabelDokumenRkpdes"; ?></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col col-md-4">Status RKPDES</div>
                                                    <div class="col col-md-8">
                                                        <small class="credit"><?php echo "$LabelStatusRkpdes"; ?></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col col-md-4">Update</div>
                                                    <div class="col col-md-8">
                                                        <small class="credit"><?php echo "$LabelUpdateRkpdes"; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 border-top border-1 border-black">
                                            <?php
                                                //Apakah sudah punya RKPDES Rincian?
                                                $JumlahRincian=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM rkpdes_rincian WHERE id_rkpdes='$id_rkpdes'"));
                                                if(!empty($JumlahRincian)){
                                                    echo '<div class="col-md-12" id="MenampilkanDatasetRkpdes">';
                                                    echo '  Dataset Akan Tampil Disini';
                                                    echo '</div>';
                                                }else{
                                                    echo '<div class="col-md-12">';
                                                    echo '  <button type="button" class="btn btn-sm btn-block btn-outline-danger btn-rounded" disabled>';
                                                    echo '      Dataset Tidak Tersedia';
                                                    echo '  </button>';
                                                    echo '</div>';
                                                }
                                            ?>
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
                <!-- Menampilkan RKPEDES Pertahun Sesuai RPJMDES/End -->
        <?php }}}} ?>
    </section>
<?php } ?>