<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'bifKyWmOFi');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        //Cek apakah ada evaluasi yang belum ada
        $TanggalSekarang=date('Y-m-d');
        $JumlahEvaluasiAktif=0;
        $JumlahEvaluasiBelumDiikuti=0;
        $QryEvaluasi = mysqli_query($Conn, "SELECT*FROM evaluasi WHERE periode_awal<'$TanggalSekarang' AND periode_akhir>'$TanggalSekarang'");
        while ($DataEvaluasi = mysqli_fetch_array($QryEvaluasi)) {
            $id_evaluasi= $DataEvaluasi['id_evaluasi'];
            //Cek Apakah ID Evaluasi Tersebut Sudah Ada Di RPJMDES atau Belum
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                $id_rpjmdes="";
                $JumlahEvaluasiBelumDiikuti=$JumlahEvaluasiBelumDiikuti+1;
            }else{
                $id_rpjmdes=$DataRpjmdes['id_rpjmdes'];
                $JumlahEvaluasiBelumDiikuti=$JumlahEvaluasiBelumDiikuti+0;
            }
            $JumlahEvaluasiAktif=$JumlahEvaluasiAktif+1;
        }
        //Cek apakah ada data evaluasi?
        $JumlahSeluruhEvaluasi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi"));
?>
    <section class="section dashboard">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    if(empty($JumlahSeluruhEvaluasi)){
                        echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">';
                        echo '  Berikut ini adalah halaman pengelolaan data RPJMDES.';
                        echo '  Tidak ada <i>credentials</i> evaluasi yang diselenggarakan.';
                        echo '  Silahkan tunggu <i>credentials</i> evaluasi yang akan dibuat oleh admin kabupaten.';
                        echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    }else{
                        if(!empty($JumlahEvaluasiBelumDiikuti)){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo '  Berikut ini adalah halaman pengelolaan data RPJMDES.';
                            echo '  Ada <b>'.$JumlahEvaluasiBelumDiikuti.'</b> <i>credentials</i> evaluasi yang belum anda lengkapi.';
                            echo '  Silahkan lengkapi dokumen dan data RPJMDES pada <i>credentials</i> evaluasi tersebut sesuai periode anggaran yang diminta.';
                            echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                        }else{
                            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                            echo '  Berikut ini adalah halaman pengelolaan data RPJMDES.';
                            echo '  Ada sudah mengikuti semua <i>credentials</i> evaluasi yang diselenggarakan.';
                            echo '  Semua dokumen dan data RPJMDES pada <i>credentials</i> evaluasi membutuhkan validasi pihak Kecamatan. Silahkan periksa kembali kelengkapan data yang dibutuhkan.';
                            echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    if(empty($JumlahSeluruhEvaluasi)){
                        echo '<div class="card">';
                        echo '  <div class="card-body text-center text-danger">';
                        echo '      Data <i>credentials</i> evaluasi belum dibuat oleh pihak Admin Kabupaten.<br>';
                        echo '      Laporan dokumen RPJMDES hanya bisa di input ketika pihak Kabupaten memberikan <i>credentials</i> untuk melakukan evaluasi';
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
                                                    echo '  <i class="bi bi-info-circle"></i> Detail RPJMDES';
                                                    echo '</a>';
                                                } 
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="card-header">
                            <b class="card-title">
                                <a href="index.php?Page=RPJMDES&Sub=Rincian&id=<?php echo $id_evaluasi; ?>"><?php echo "$no. Periode Evaluasi $periode"; ?></a>
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
                                        <div class="col col-md-4">Periode</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><?php echo "$PeriodeRpjmdes"; ?></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Anggaran</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><code class="text-grayish"><?php echo "$Anggaran"; ?></code></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col col-md-4">Dokumen</div>
                                        <div class="col col-md-8">
                                            <small class="credit"><?php echo "$DokumenLabel"; ?></small>
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
                <?php $no++;}} ?>
            </div>
        </div>
    </section>
<?php } ?>