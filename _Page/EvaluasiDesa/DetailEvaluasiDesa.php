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
                $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi'"));
                //Keterangan
                $QryRekapitulasi = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                $DataRekapitulasi = mysqli_fetch_array($QryRekapitulasi);
                if(empty($DataRekapitulasi['id_evaluasi_rekap'])){
                    $statusKepesertaan='<code class="text-danger">Belum Mengikuti</code>';
                    $TotelSkorRekapitulasi='<code class="text-danger">None</code>';
                    $Rekomendasi='<code class="text-danger">None</code>';
                    $StatusRekapitulasi='<code class="text-danger">None</code>';
                }else{
                    $statusKepesertaan='<code class="text-info">Mengikuti</code>';
                    $TotelSkorRekapitulasi=$DataRekapitulasi['skor'];
                    $TotelSkorRekapitulasi='<code class="text text-grayish">'.$TotelSkorRekapitulasi.'</code>';
                    $Rekomendasi=$DataRekapitulasi['rekomendasi'];
                    $Rekomendasi='<code class="text text-grayish">'.$Rekomendasi.'</code>';
                    $StatusRekapitulasi=$DataRekapitulasi['status'];
                    $StatusRekapitulasi='<code class="text text-grayish">'.$StatusRekapitulasi.'</code>';
                }
                $CekApakahSayaMengikuti=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                //Informasi Wilayah
                $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                $desa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
?>
            <input type="hidden" name="GetIdEvaluasi" id="GetIdEvaluasi" value="<?php echo "$id_evaluasi"; ?>">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
                        echo '  Berikut ini adalah halaman pengisian & pengelolaan instrumen SAKIP.';
                        echo '  Pastikan anda sudah mengisi semua indikator penilaian serta melampirkan dokumen pendukung untuk memudahkan proses verifikasi.';
                        echo '  Pilih pada masing-masing komponen pernyataan penilaian untuk mulai mengisi dan melihat detail informasi pengisian';
                        echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    ?>
                </div>
            </div>
            <?php if($SessionAkses=="Kecamatan"){ ?>
                <div class="row mb-3">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a href="index.php?Page=LembarKerja&id=<?php echo "$id_evaluasi"; ?>&id_wilayah=<?php echo "$SessionIdWilayah"; ?>" class="btn btn-mb btn-rounded btn-dark btn-block">
                            <i class="bi bi-chevron-left"></i> Kembali
                        </a>
                    </div>
                </div>
            <?php } ?>
            <?php if($SessionAkses=="Desa"){ ?>
                <div class="row mb-3">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a href="index.php?Page=LembarKerja&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-mb btn-rounded btn-dark btn-block">
                            <i class="bi bi-chevron-left"></i> Kembali
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Informasi Evaluasi</b>
                                    <ul>
                                        <li>
                                            <small class="credit">Periode : </small>
                                            <code class="text text-grayish"><?php echo "$periode"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Mulai : </small>
                                            <code class="text text-grayish"><?php echo "$periode_awal"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Berakhir : </small>
                                            <code class="text-grayish"><?php echo "$periode_akhir"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Peserta : </small>
                                            <code class="text text-grayish"><?php echo "$JumlahPeserta Desa"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Keterangan : </small>
                                            <code class="text text-grayish"><?php echo "$statusKepesertaan"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Update : </small>
                                            <code class="text text-grayish"><?php echo "$updatetime"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Status Evaluasi: </small>
                                            <code><?php echo "$status"; ?></code>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <b>Wilayah Otoritas</b>
                                    <ul>
                                        <li>
                                            <small class="credit">Provinsi : </small>
                                            <code class="text text-grayish"><?php echo "$propinsi"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Kabupaten/Kota : </small>
                                            <code class="text-grayish"><?php echo "$kabupaten"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Kecamatan : </small>
                                            <code class="text text-grayish"><?php echo "$kecamatan"; ?></code>
                                        </li>
                                        <li>
                                            <small class="credit">Kelurahan/Desa : </small>
                                            <code class="text text-grayish"><?php echo "$desa"; ?></code>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <b>Hasil Penilaian (Rekapitulasi)</b>
                                    <ul>
                                        <li>
                                            <small class="credit">Status : </small>
                                            <?php echo "$StatusRekapitulasi"; ?>
                                        </li>
                                        <li>
                                            <small class="credit">Skor : </small>
                                            <?php echo "$TotelSkorRekapitulasi"; ?>
                                        </li>
                                        <li>
                                            <small class="credit">Rekomendasi : </small>
                                            <?php echo "$Rekomendasi"; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">A. Upload Lampiran/Dokumen</b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        Silahkan upload berkas/dokumen berikut ini sesuai petunjuk dan deskripsi yang disediakan.
                                    </div>
                                </div>
                            </div>
                            <div class="tabel table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td align="center"><b class="text text-dark">No</b></td>
                                            <td align="center"><b class="text text-dark">Nama Lampiran</b></td>
                                            <td align="center"><b class="text text-dark">Tipe</b></td>
                                            <td align="center"><b class="text text-dark">Option</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Cek Keberadaan Data
                                            $JumlahDataReferensi = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM referensi_bukti WHERE hapus='Tidak'"));
                                            if(empty($JumlahDataReferensi)){
                                                echo '<tr>';
                                                echo '  <td colspan="4" class="text-centerv text-danger">Tidak Ada Referensi File Lampiran Yang Terhubung</td>';
                                                echo '</tr>';
                                            }else{
                                                $no = 1;
                                                //KONDISI PENGATURAN MASING FILTER
                                                $QryReferensi = mysqli_query($Conn, "SELECT*FROM referensi_bukti WHERE hapus='Tidak' ORDER BY id_referensi_bukti ASC");
                                                while ($DataReferensi = mysqli_fetch_array($QryReferensi)) {
                                                    $id_referensi_bukti= $DataReferensi['id_referensi_bukti'];
                                                    $nama_bukti= $DataReferensi['nama_bukti'];
                                                    $deskripsi= $DataReferensi['deskripsi'];
                                                    $type_file= $DataReferensi['type_file'];
                                                    //Cek File Store
                                                    $QryFileStore = mysqli_query($Conn,"SELECT * FROM file_store WHERE id_evaluasi='$id_evaluasi' AND id_referensi_bukti='$id_referensi_bukti' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                                                    $DataFileStore = mysqli_fetch_array($QryFileStore);
                                                    if(empty($DataFileStore['id_file_store'])){
                                                        $id_file_store="";
                                                        $nama_file="";
                                                        $TypeFile="";
                                                        $kunci="";
                                                    }else{
                                                        $id_file_store=$DataFileStore['id_file_store'];
                                                        $nama_file=$DataFileStore['nama_file'];
                                                        $TypeFile=$DataFileStore['type_file'];
                                                        $kunci=$DataFileStore['kunci'];
                                                    }
                                        ?>
                                                    <tr>
                                                        <td class="text-center"><b><?php echo "$no"; ?></b></td>
                                                        <td class="text-left">
                                                            <?php
                                                                if(empty($DataFileStore['id_file_store'])){
                                                                    echo '<b>'.$nama_bukti.'</b>';
                                                                }else{
                                                                    $id_file_store=$DataFileStore['id_file_store'];
                                                                    echo '<a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#ModalViewLampiran" data-id="'.$id_file_store.'">';
                                                                    echo '  <b>'.$nama_bukti.'</b>';
                                                                    echo '</a>';
                                                                }
                                                            ?>
                                                            <p>
                                                                <small class="credit">
                                                                    <?php echo "$deskripsi"; ?>
                                                                </small>
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <small class="credit">
                                                                <code class="text text-grayish">
                                                                    <?php
                                                                        $DataTipe = json_decode($type_file, true);
                                                                        foreach($DataTipe as $ListTipe){
                                                                            $Tipe=$ListTipe['type'];
                                                                            $TipeName=MimeTiTipe($Tipe);
                                                                            echo "$TipeName, ";
                                                                        }
                                                                    ?>
                                                                </code>
                                                            </small>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                if($SessionAkses=="Desa"){
                                                                    if(empty($DataFileStore['id_file_store'])){
                                                                        echo '<a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUploadDraft" data-id="'.$id_evaluasi.','.$id_referensi_bukti.'" title="Upload Draft Lampiran">';
                                                                        echo '  <i class="bi bi-upload"></i>';
                                                                        echo '</a>';
                                                                    }else{
                                                                        $id_file_store=$DataFileStore['id_file_store'];
                                                                        if($kunci=="Ya"){
                                                                            echo '<a href="javascript:void(0);" disabled class="btn btn-sm btn-outline-black" title="File Sudah Dikunci Oleh Pihak Kecamatan">';
                                                                            echo '  <i class="bi bi-lock"></i> Dikunci';
                                                                            echo '</a>';
                                                                        }else{
                                                                            echo '<div class="btn-group">';
                                                                            echo '  <a href="javascript:void(0);" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditDraft" data-id="'.$id_file_store.'">';
                                                                            echo '      <i class="bi bi-pencil"></i>';
                                                                            echo '  </a>';
                                                                            echo '  <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusDraft" data-id="'.$id_file_store.'">';
                                                                            echo '      <i class="bi bi-x"></i>';
                                                                            echo '  </a>';
                                                                            echo '</div>';
                                                                        }
                                                                    }
                                                                }else{
                                                                    if(empty($id_file_store)){
                                                                        echo '<code class="text-grayish">';
                                                                        echo '  None';
                                                                        echo '</code>';
                                                                    }else{
                                                                        if($kunci=="Ya"){
                                                                            echo '<a href="javascript:void(0);" class="btn btn-sm btn-outline-black" data-bs-toggle="modal" data-bs-target="#ModalBukaKunci" data-id="'.$id_file_store.'">';
                                                                            echo '  <i class="bi bi-key"></i> Unlock ';
                                                                            echo '</a>';
                                                                        }else{
                                                                            echo '<a href="javascript:void(0);" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ModalTutupKunci" data-id="'.$id_file_store.'">';
                                                                            echo '  <i class="bi bi-lock"></i> Lock';
                                                                            echo '</a>';
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
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
            <input type="hidden" id="GetIdWilayah" value="<?php echo "$SessionIdWilayah"; ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">B. Uraian Indikator Evaluasi</b>
                        </div>
                        <div class="card-body" id="TabelAngketEvaluasi">
                            
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
?>
</section>