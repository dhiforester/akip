<section class="section dashboard">
    <?php
        if(empty($_GET['id'])){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '  ID Evaluasi tidak boleh kosong!';
            echo '</div>';
        }else{
            if(empty($_GET['id2'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '  ID Kriteria Dan Indikator tidak boleh kosong!';
                echo '</div>';
            }else{
                if(empty($_GET['id3'])){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo '  ID Wilayah Desa tidak boleh kosong!';
                    echo '</div>';
                }else{
                    $id_evaluasi=$_GET['id'];
                    $id_kriteria_indikator=$_GET['id2'];
                    $id_wilayah_desa=$_GET['id3'];
                    if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo '  ID Evaluasi Hanya boleh angka! Anda mengisi nilai parameter tersebut dengan karakter ilegal';
                        echo '</div>';
                    }else{
                        if(!preg_match("/^[0-9]*$/", $id_kriteria_indikator)){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo '  ID Kriteria Dan Indikator Hanya boleh angka! Anda mengisi nilai parameter tersebut dengan karakter ilegal';
                            echo '</div>';
                        }else{
                            if(!preg_match("/^[0-9]*$/", $id_wilayah_desa)){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                echo '  ID Wilayah Desa Hanya boleh angka! Anda mengisi nilai parameter tersebut dengan karakter ilegal';
                                echo '</div>';
                            }else{
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
                                //Informasi Wilayah
                                $id_wilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'id_wilayah');
                                $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'propinsi');
                                $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'kabupaten');
                                $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'kecamatan');
                                $desa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'desa');
                                //Informasi Kriteria Indikator
                                $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
                                $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                                $level_2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                                $level_3=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_3');
                                $level_4=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_4');
                                $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
                                $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
                                $keterangan=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'keterangan');
                                $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
                                //Buka level 1
                                $Qry1 = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE level_1='$level_1' AND level='Level 1'")or die(mysqli_error($Conn));
                                $Data1 = mysqli_fetch_array($Qry1);
                                if(empty($Data1['kode'])){
                                    $kode1="";
                                    $text1="";
                                }else{
                                    $kode1=$Data1['kode'];
                                    $text1=$Data1['teks'];
                                }
                                //Buka level 2
                                $Qry2 = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE  level_1='$level_1' AND level_2='$level_2' AND level='Level 2'")or die(mysqli_error($Conn));
                                $Data2 = mysqli_fetch_array($Qry2);
                                if(empty($Data2['kode'])){
                                    $kode2="";
                                    $text2="";
                                }else{
                                    $kode2=$Data2['kode'];
                                    $text2=$Data2['teks'];
                                }
                                //Buka level 3
                                $Qry3 = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE level_1='$level_1' AND level_2='$level_2' AND level_3='$level_3' AND level='Level 3'")or die(mysqli_error($Conn));
                                $Data3 = mysqli_fetch_array($Qry3);
                                if(empty($Data3['kode'])){
                                    $kode3="";
                                    $text3="";
                                }else{
                                    $kode3=$Data3['kode'];
                                    $text3=$Data3['teks'];
                                }
                                //Buka Jawaban
                                $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                                $DataJawaban = mysqli_fetch_array($QryJawaban);
                                if(empty($DataJawaban['id_evaluasi_jawaban'])){
                                    $id_evaluasi_jawaban="";
                                    $jawaban="";
                                    $bukti="";
                                    $keterangan_desa="";
                                    $keterangan_kecamatan="";
                                    $keterangan_kabupaten="";
                                    $StatusJawaban="";
                                }else{
                                    $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                                    $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
                                    $bukti=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'bukti');
                                    $keterangan_desa=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan_desa');
                                    $keterangan_kecamatan=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan_kecamatan');
                                    $keterangan_kabupaten=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan_kabupaten');
                                    $StatusJawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'status');
                                }
?>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                        echo '  Berikut ini adalah informasi rincian dari kriteria indikator evaluasi SAKIP.';
                        echo '  Lembar halaman ini terdiri dari informasi periode evaluasi, ojek evaluasi, uraian isian pihak desa, uraian validasi kecamatan dan verifikasi kabupaten.';
                        echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <?php if($SessionAkses=="Desa"){ ?>
                        <a href="index.php?Page=EvaluasiDesa&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-mb btn-rounded btn-dark btn-block">
                            <i class="bi bi-chevron-left"></i> Kembali
                        </a>
                    <?php } ?>
                    <?php if($SessionAkses=="Kecamatan"){ ?>
                        <a href="index.php?Page=EvaluasiDesa&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>&id_wilayah=<?php echo "$id_wilayah_desa"; ?>" class="btn btn-mb btn-rounded btn-dark btn-block">
                            <i class="bi bi-chevron-left"></i> Kembali
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title text-dark">1. Informasi Evaluasi & Otoritas</b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
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
                                            <small class="credit">Status Evaluasi: </small>
                                            <code><?php echo "$status"; ?></code>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
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
                                            <small class="credit">Desa : </small>
                                            <code class="text text-grayish"><?php echo "$desa"; ?></code>
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
                            <b class="card-title text-dark">2. Kriteria & Indikator</b>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col col-md-3">Indikator</div>
                                <div class="col col-md-9">
                                    <small class="credit">
                                        <code class="text text-dark"><?php echo "$kode1. $text1"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3">Sub Indikator</div>
                                <div class="col col-md-9">
                                    <small class="credit">
                                        <code class="text text-dark"><?php echo "$kode2. $text2"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3">Kriteria</div>
                                <div class="col col-md-9">
                                    <small class="credit">
                                        <code class="text text-dark"><?php echo "$kode3. $text3"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-3">Pernyataan</div>
                                <div class="col col-md-9">
                                    <small class="credit">
                                        <code class="text text-dark"><?php echo "$kode. $teks"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">Keterangan</div>
                                <div class="col-md-9">
                                    <small class="credit">
                                        <?php
                                            if(!empty($keterangan)){
                                                echo '<code class="text text-danger">'.$keterangan.'</code>';
                                            }else{
                                                echo '<code class="text text-grayish">Tidak Ada</code>';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">Catatan Lainnya</div>
                                <div class="col-md-9">
                                    <?php
                                        if(!empty($keterangan_desa)){
                                            echo '<code class="text text-dark"><b>'.$keterangan_desa.'</b></code>';
                                        }else{
                                            echo '<code class="text text-grayish">Tidak Ada</code>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">Hasil Evaluasi</div>
                                <div class="col-md-9 table table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td align="center"><b>Label</b></td>
                                            <td><b>Alternatif</b></td>
                                            <td align="center"><b>Nilai/Skor (%)</b></td>
                                            <td align="center"><b>Jawaban</b></td>
                                        </tr>
                                        <?php
                                            $data_array = json_decode($alternatif, true);
                                            foreach ($data_array as $item) {
                                                $charr=$item['char'];
                                                $label=$item['label'];
                                                $nilai=$item['nilai'];
                                                echo '<tr>';
                                                echo "  <td align='center'>$charr</td>";
                                                echo "  <td>$label</td>";
                                                echo "  <td align='center'>$nilai</td>";
                                                if($jawaban==$charr){
                                                    echo '  <td align="center"><h1><i class="bi bi-check text-success"></i></h1></td>';
                                                }else{
                                                    echo '  <td align="center">-</td>';
                                                }
                                                echo '</tr>';
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php 
                                if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){ 
                                    if($SessionAkses=="Kecamatan"){
                                        if($StatusJawaban==""){
                                            echo '<code class="text text-grayish">*Pihak Desa Belum Mengisi Indikator Evaluasi Ini</code>';
                                        }else{
                                            if($StatusJawaban=="Selesai"){
                                                echo '<code class="text text-grayish">*Inikator Evaluasi Sudah Dinyatakan Selesai Oleh Kabupaten</code>';
                                            }else{
                                                if($StatusJawaban=="Dikirim"){
                                                    echo '<code class="text text-grayish">*Evaluasi Penilaian Telah Dikirim Pihak Desa</code>';
                                                }else{
                                                    if($StatusJawaban=="Refisi"){
                                                        echo '<code class="text text-grayish">*Menunggu Pihak Desa Melakukan Refisi dan Mengirim Kembali</code>';
                                                    }else{
                                    
                                                    }
                                                }
                                            }
                                        }
                                    }else{
                                        echo '<code class="text text-grayish">*Penilaian Evaluasi Ini Hanya Diisi Oleh Kecamatan</code>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title text-dark">3. Dokumen/Lampiran Wajib</b>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-left"><b>No</b></td>
                                            <td class="text-left"><b>Nama Dokumen</b></td>
                                            <td class="text-left"><b>Keterangan</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $JumlahDokumenTerhubung = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kriteria_indikator_ref WHERE id_kriteria_indikator='$id_kriteria_indikator'"));
                                            if(empty($JumlahDokumenTerhubung)){
                                                echo '<tr>';
                                                echo '  <td colspan="3" class="text-center text-danger">';
                                                echo '      Tidak Ada Dokumen Utama Yang Terhubung Dengan Kriteria/Indikator Ini';
                                                echo '  </td>';
                                                echo '</tr>';
                                            }else{
                                                $no = 1;
                                                $QryReferensi = mysqli_query($Conn, "SELECT*FROM kriteria_indikator_ref WHERE id_kriteria_indikator='$id_kriteria_indikator' ORDER BY id_referensi_bukti ASC");
                                                while ($DataReferensi = mysqli_fetch_array($QryReferensi)) {
                                                    $id_referensi_bukti= $DataReferensi['id_referensi_bukti'];
                                                    //Buka Referensi
                                                    $nama_bukti=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'nama_bukti');
                                                    $deskripsi=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'deskripsi');
                                                    //Cek Apakah File Sudah Di Upload Belum?
                                                    //Cek File Store
                                                    $QryFileStore = mysqli_query($Conn,"SELECT * FROM file_store WHERE id_evaluasi='$id_evaluasi' AND id_referensi_bukti='$id_referensi_bukti' AND id_wilayah='$id_wilayah_desa'")or die(mysqli_error($Conn));
                                                    $DataFileStore = mysqli_fetch_array($QryFileStore);
                                                    if(empty($DataFileStore['id_file_store'])){
                                                        $id_file_store="";
                                                        $nama_file="";
                                                        $TypeFile="";
                                                    }else{
                                                        $id_file_store=$DataFileStore['id_file_store'];
                                                        $nama_file=$DataFileStore['nama_file'];
                                                        $TypeFile=$DataFileStore['type_file'];
                                                    }
                                                    echo '<tr>';
                                                    echo '  <td class="text-center">'.$no.'</td>';
                                                    echo '  <td class="text-left">';
                                                    echo '      <b>'.$nama_bukti.'</b>';
                                                    echo '      <p>'.$deskripsi.'</p>';
                                                    echo '  </td>';
                                                    echo '  <td class="text-left">';
                                                    if(empty($DataFileStore['id_file_store'])){
                                                        echo '<code class="text text-grayish">';
                                                        echo '  Tidak Ada';
                                                        echo '</code>';
                                                    }else{
                                                        $id_file_store=$DataFileStore['id_file_store'];
                                                        echo '  <a href="javascript:void(0);" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalViewLampiran" data-id="'.$id_file_store.'">';
                                                        echo '      <i class="bi bi-file"></i> Lihat File';
                                                        echo '  </a>';
                                                    }
                                                    echo '  </td>';
                                                    echo '</tr>';
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-12 mb-3">
                                    <b class="card-title text-dark">4. Dokumen/Lampiran Pendukung</b><br>
                                    <small class="credit">
                                        Lampirkan dokumen yang dibutuhkan untuk mendukung bukti dari alternatif penilaian.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    <?php 
                                        if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){ 
                                            if($StatusJawaban==""||$StatusJawaban=="Refisi"){
                                    ?>
                                        <a class="btn btn-sm btn-outline-dark" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadLampiran" data-id="<?php echo "$id_kriteria_indikator,$id_evaluasi,$id_wilayah_desa,$id_evaluasi_jawaban"; ?>">
                                            <i class="bi bi-plus"></i> Upload Dokumen/Lampiran
                                        </a>
                                    <?php 
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="table table-responsive">
                                        <table class="table table table-hover">
                                            <tr>
                                                <td align="center"><b>No</b></td>
                                                <td><b>Nama Dokumen/Lampiran</b></td>
                                                <td align="center"><b>Option</b></td>
                                            </tr>
                                            <?php
                                                if(empty($bukti)){
                                                    echo '<tr>';
                                                    echo '  <td align="center" colspan="3" class="text-danger">Tidak Ada Lampiran File Tambahan</td>';
                                                    echo '</tr>';
                                                }else{
                                                    $DataBukti = json_decode($bukti, true);
                                                    $JumlahLampiran=count($DataBukti);
                                                    if(empty($JumlahLampiran)){
                                                        echo '<tr>';
                                                        echo '  <td align="center" colspan="3" class="text-danger">Tidak Ada Dokumen/Lampiran Tambahan Yang Tersedia</td>';
                                                        echo '</tr>';
                                                    }else{
                                                        $no=1;
                                                        foreach ($DataBukti as $item) {
                                                            $label_file=$item['label_file'];
                                                            $file_name=$item['file_name'];
                                                            echo '<tr>';
                                                            echo "  <td align='center'>$no</td>";
                                                            echo "  <td>";
                                                            echo "      <a href='javascript:void(0);' class='text-primary' data-bs-toggle='modal' data-bs-target='#ModalDetailBukti' data-id='$id_evaluasi_jawaban,$file_name'>$label_file</a>";
                                                            echo "  </td>";
                                                            echo "  <td align='center'>";
                                                            if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){ 
                                                                if($StatusJawaban==""||$StatusJawaban=="Refisi"){
                                                                    echo "<a href='javascript:void(0);' class='btn btn-sm btn-round btn-danger' data-bs-toggle='modal' data-bs-target='#ModalHapusBukti' data-id='$id_evaluasi_jawaban,$file_name'>";
                                                                    echo "  <i class='bi bi-x'></i> Hapus";
                                                                    echo "</a>";
                                                                }else{
                                                                    echo "<a href='javascript:void(0);' diabled class='btn btn-sm btn-round btn-grayish' title='File Sudah Tidak Dihapus'>";
                                                                    echo "  <i class='bi bi-lock'></i> Dikunci";
                                                                    echo "</a>";
                                                                }
                                                            }else{
                                                                echo "<a href='javascript:void(0);' diabled class='btn btn-sm btn-round btn-grayish' title='File Sudah Tidak Dihapus'>";
                                                                echo "  <i class='bi bi-lock'></i> Dikunci";
                                                                echo "</a>";
                                                            }
                                                            echo "  </td>";
                                                            echo '</tr>';
                                                            $no++;
                                                        }
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </div>
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
                            <b class="card-title text-dark">4. Status Verifikasi</b>
                        </div>
                        <div class="card-body">
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">None</div>
                                    <?php
                                        if($StatusJawaban==""){
                                            echo '<i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>';
                                        }else{
                                            echo '<i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>';
                                        }
                                    ?>
                                    <div class="activity-content <?php if($StatusJawaban==""){echo 'text-danger';} ?>">
                                        Pihak Desa belum melakukan konfirmasi pengiriman instrumen evaluasi SAKIP.
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">Dikirim</div>
                                    <?php
                                        if($StatusJawaban=="Dikirim"){
                                            echo '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                        }else{
                                            echo '<i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>';
                                        }
                                    ?>
                                    <div class="activity-content <?php if($StatusJawaban=="Dikirim"){echo 'text-success';} ?>">
                                        Pihak Desa telah mengisi instrumen evaluasi SAKIP dan menunggu pihak kecamatan melakukan verifikasi.
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">Refisi</div>
                                    <?php
                                        if($StatusJawaban=="Refisi"){
                                            echo '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                        }else{
                                            echo '<i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>';
                                        }
                                    ?>
                                    <div class="activity-content <?php if($StatusJawaban=="Refisi"){echo 'text-success';} ?>">
                                        Pihak Kecamatan/Kabupaten mengirimkan status refisi dan instrumen perlu mendapatkan tindak lanjut dari Desa untuk segera memperbaikinya.
                                        <?php
                                            if(!empty($keterangan_kecamatan)){
                                                echo '<p><code><b>Refisi Dari Kecapatan : </b> '.$keterangan_kecamatan.'</code></p>';
                                            }
                                            if(!empty($keterangan_kabupaten)){
                                                echo '<p><code><b>Refisi Dari Kecapatan : </b> '.$keterangan_kabupaten.'</code></p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">Verifikasi</div>
                                    <?php
                                        if($StatusJawaban=="Verifikasi"){
                                            echo '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                        }else{
                                            echo '<i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>';
                                        }
                                    ?>
                                    <div class="activity-content <?php if($StatusJawaban=="Verifikasi"){echo 'text-success';} ?>">
                                        Pihak Kecamatan telah melakukan verifikasi dan sedang menunggu verifikasi lanjutan pada tingkat Kabupaten.
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">Selesai</div>
                                    <?php
                                        if($StatusJawaban=="Selesai"){
                                            echo '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                        }else{
                                            echo '<i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>';
                                        }
                                    ?>
                                    <div class="activity-content <?php if($StatusJawaban=="Selesai"){echo 'text-success';} ?>">
                                        Pihak Kabupaten telah melakukan verifikasi dan instrumen evaluasi sudah valid.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Untuk Desa -->
            <?php 
                if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){ 
                    if($SessionAkses=="Desa"){
                        if($StatusJawaban==""||$StatusJawaban=="Refisi"){
                        
            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-block btn-success" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiDesa" data-id="<?php echo "$id_kriteria_indikator,$id_evaluasi,$id_wilayah_desa"; ?>">
                                    Konfirmasi Penilaian Evaluasi
                                </button>
                            </div>
                        </div>
            <?php
                        } 
                    } 
                }
            ?>
            <!-- Untuk Kecamatan -->
            <?php 
                if($sekarang>=$periode_awal&&$sekarang<=$periode_akhir){ 
                    if($SessionAkses=="Kecamatan"){
                        if($StatusJawaban==""||$StatusJawaban=="Dikirim"||$StatusJawaban=="Refisi"||$StatusJawaban=="Verifikasi"){
                        
            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-block btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimJawaban" data-id="<?php echo "$id_kriteria_indikator,$id_evaluasi,$id_wilayah_desa"; ?>">
                                    <i class="bi bi-pencil"></i> Hasil Evaluasi
                                </a>
                            </div>
                        </div>
            <?php
                        } 
                    } 
                } 
            ?>
<?php
                        }
                    }
                }
            }
        }
    }
?>
</section>