<!-- <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <b class="card-title text-dark">
                                    LEMBAR KERJA SAKIP TAHUN <?php echo "$periode"; ?>
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <ol>
                                            <li class="mb-3">
                                            <?php
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
                                                <a href="index.php?Page=RPJMDES&Sub=Rincian&id=<?php echo "$id_evaluasi"; ?>" class="mb-3">Rencana Pembangunan Jangka Menengah Desa (RPJMDES)</a>
                                                <div class="row mt-3">
                                                    <div class="col-md-6 ml-3">
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Periode</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$PeriodeRpjmdes"; ?></small></div>
                                                        </div>
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Kepala Desa</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$kepala_desa"; ?></small></div>
                                                        </div>
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Sekretaris Desa</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$sekretaris_desa"; ?></small></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ml-3">
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Anggaran</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$Anggaran"; ?></small></div>
                                                        </div>
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Status</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$StatusLabel"; ?></small></div>
                                                        </div>
                                                        <div class="row  mb-3">
                                                            <div class="col col-md-4">Updatetime</div>
                                                            <div class="col col-md-6"><small class="credit"><?php echo "$UpdateRpjmdesFormat"; ?></small></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3">
                                                <?php
                                                    //Buka Detail RKPDES
                                                    $QryRkpdes = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah' AND id_rpjmdes='$id_rpjmdes' AND periode='$periode'")or die(mysqli_error($Conn));
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
                                                        $PeriodeRkpdes='<code class="text-danger">Tidak Ada</code>';
                                                    }else{
                                                        $id_rkpdes=$DataRkpdes['id_rkpdes'];
                                                        $LabelIdRkpdes='<code class="text-info">'.$id_rkpdes.'</code>';
                                                        $AnggaranRkpdes=$DataRkpdes['jumlah_anggaran'];
                                                        $AnggaranRkpdes = "Rp " . number_format($AnggaranRkpdes, 0, ',', '.');
                                                        $LabelAnggaranRkpdes='<code class="text-grayish">'.$AnggaranRkpdes.'</code>';
                                                        $dokumen_rkpdes=$DataRkpdes['dokumen'];
                                                        $LabelDokumenRkpdes='<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_rkpdes.'"><code class="text-primary"><i class="bi bi-paperclip"></i> Lampiran RKPDES '.$periode.'</code></a>';
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
                                                        $PeriodeRkpdes=$DataRkpdes['periode'];
                                                        $PeriodeRkpdes='<code class="text-grayish">'.$PeriodeRkpdes.'</code>';
                                                    }
                                                ?>
                                                <a href="index.php?Page=RKPDES&Sub=Detail&id=<?php echo "$id_evaluasi"; ?>" class="mb-3">Rencana Kerja Pemerintah Desa (RKPDES)</a>
                                                <div class="row mb-3 mt-3">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Periode</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$PeriodeRkpdes"; ?></small>
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
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Anggaran</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$LabelAnggaranRkpdes"; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Status</div>
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
                                            </li>
                                            <li class="mb-3">
                                                <?php
                                                    //Cek Ketersediaan APBDES
                                                    $QryApbdes = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                                                    $DataApbdes = mysqli_fetch_array($QryApbdes);
                                                    if(empty($DataApbdes['id_apbdes'])){
                                                        $id_apbdes="";
                                                        $periode="";
                                                        $kepala_desa="";
                                                        $sekretaris_desa="";
                                                        $jumlah_anggaran="";
                                                        $dokumen="";
                                                        $status="";
                                                        $updatetime="";
                                                        //Label
                                                        $LabelPeriodeApbdes='<code class="text-danger">None</code>';
                                                        $LabelKepalaDesaApbdes='<code class="text-danger">None</code>';
                                                        $LabelSekretarisDesaApbdes='<code class="text-danger">None</code>';
                                                        $AnggaranApbdes='<code class="text-danger">None</code>';
                                                        $StatusLabelApbdes='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                                        $UpdatetimeApbdes='<code class="text-danger">None</code>';
                                                    }else{
                                                        $id_apbdes=$DataApbdes['id_apbdes'];
                                                        $periode=$DataApbdes['periode'];
                                                        $kepala_desa=$DataApbdes['kepala_desa'];
                                                        $sekretaris_desa=$DataApbdes['sekretaris_desa'];
                                                        $jumlah_anggaran=$DataApbdes['jumlah_anggaran'];
                                                        $dokumen=$DataApbdes['dokumen'];
                                                        $status_apbdes=$DataApbdes['status'];
                                                        $updatetime=$DataApbdes['updatetime'];
                                                        //Label
                                                        if($status_apbdes=="Edited"){
                                                            $StatusLabelApbdes='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                                                        }else{
                                                            if($status_apbdes=="Request"){
                                                                $StatusLabelApbdes='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                                            }else{
                                                                if($status_apbdes=="Valid"){
                                                                    $StatusLabelApbdes='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                                                }else{
                                                                    if($status_apbdes=="Revision"){
                                                                        $StatusLabelApbdes='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                                                    }else{
                                                                        $StatusLabelApbdes='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $LabelPeriodeApbdes='<code class="text-grayish">'.$periode.'</code>';
                                                        $LabelKepalaDesaApbdes='<code class="text-grayish">'.$kepala_desa.'</code>';
                                                        $LabelSekretarisDesaApbdes='<code class="text-grayish">'.$sekretaris_desa.'</code>';
                                                        $Anggaran = "Rp " . number_format($jumlah_anggaran, 2, ',', '.');
                                                        $AnggaranApbdes='<code class="text-grayish">'.$Anggaran.'</code>';
                                                        $strtotime6=strtotime($updatetime);
                                                        $UpdatetimeApbdes=date('d/m/Y H:i:s T',$strtotime6);
                                                        $UpdatetimeApbdes='<code class="text-grayish">'.$UpdatetimeApbdes.'</code>';
                                                    }
                                                ?>
                                                <a href="index.php?Page=APBDES&Sub=Detail&id=<?php echo "$id_evaluasi"; ?>" class="text-primary">
                                                    Anggaran Pendapatan Dan Belanja Desa (APBDES)
                                                </a>
                                                <div class="row mb-3 mt-3">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Periode</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$LabelPeriodeApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Kepala Desa</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$LabelKepalaDesaApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Sekretaris Desa</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$LabelSekretarisDesaApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Anggaran</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$AnggaranApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Status</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$StatusLabelApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Update</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit"><?php echo "$UpdatetimeApbdes"; ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3">
                                                <?php
                                                    //Menghitung Jumlah 
                                                    $JumlahPerjanjian=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM perjanjian_kinerja WHERE id_evaluasi='$id_evaluasi'"));
                                                    $JumlahSasaran=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM perjanjian_sasaran WHERE id_evaluasi='$id_evaluasi'"));
                                                    $JumlahKegiatan=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM perjanjian_anggaran WHERE id_evaluasi='$id_evaluasi'"));
                                                ?>
                                                <a href="index.php?Page=PerjanjianKinerja&Sub=Detail&id=<?php echo $id_evaluasi ?>">Perjanjian Kinerja</a>
                                                <div class="row mb-3 mt-3">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Jumlah Perjanjian</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit">
                                                                    <?php 
                                                                        if(!empty($JumlahPerjanjian)){
                                                                            echo '<code class="text text-grayish">'.$JumlahPerjanjian.'</code>';
                                                                        }else{
                                                                            echo '<code>None</code>';
                                                                        } 
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Sasaran & Indikator</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit">
                                                                    <?php 
                                                                        if(!empty($JumlahSasaran)){
                                                                            echo '<code class="text text-grayish">'.$JumlahSasaran.'</code>';
                                                                        }else{
                                                                            echo '<code>None</code>';
                                                                        } 
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Jumlah Kegiatan</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit">
                                                                    <?php 
                                                                        if(!empty($JumlahKegiatan)){
                                                                            echo '<code class="text text-grayish">'.$JumlahSasaran.'</code>';
                                                                        }else{
                                                                            echo '<code>None</code>';
                                                                        } 
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col col-md-4">Anggaran</div>
                                                            <div class="col col-md-8">
                                                                <small class="credit">
                                                                    <?php 
                                                                        $SqlJumlahPerjanjian = "SELECT SUM(anggaran) AS jumlah_total FROM perjanjian_anggaran WHERE id_evaluasi='$id_evaluasi'";
                                                                        $result = $Conn->query($SqlJumlahPerjanjian);
                                                                        if ($result) {
                                                                            if ($result->num_rows > 0) {
                                                                                $row = $result->fetch_assoc();
                                                                                $JumlahTotalAnggaran=$row['jumlah_total'];
                                                                            } else {
                                                                                $JumlahTotalAnggaran =0;
                                                                            }
                                                                            if(!empty($JumlahTotalAnggaran)){
                                                                                echo '<code class="text text-grayish">'.$JumlahTotalAnggaran.'</code>';
                                                                            }else{
                                                                                echo '<code>None</code>';
                                                                            } 
                                                                        }else{
                                                                            // Menampilkan pesan kesalahan
                                                                            echo "Error: " . $SqlJumlah . "<br>" . $Conn->error;
                                                                            $JumlahTotalAnggaran = 0; // Set nilai default jika query gagal
                                                                        }
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->