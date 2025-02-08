<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'MMSeclCilK');
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
                    echo '          Berikut ini adalah halaman perjanjian kinerja sesuai <i>Credential</i> evaluasi pihak Kabupaten yang sudah disusun sebelumnya.';
                    echo '          Pada halaman ini anda bisa mengelola data perjanjian kinerja dan melampirkan berkas/dokumen pendukung.';
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
    ?>
                <div class="row mb-3">
                    <div class="col-md-10 mt-3"></div>
                    <div class="col-md-2 text-center mt-3">
                        <a href="index.php?Page=LembarKerja&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-md btn-dark btn-block btn-rounded" title="Kembali Ke halaman lembar kerja">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>A. Informasi Sesi Evaluasi</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
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
                                    </div>
                                    <div class="col-md-6">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Informasi Rumah Tangga Miskin -->
                <?php
                    //Rumah Tangga Miskin
                    $QryMiskin = mysqli_query($Conn,"SELECT * FROM rt_miskin WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                    $DataMiskin = mysqli_fetch_array($QryMiskin);
                    if(empty($DataMiskin['id_rt_miskin'])){
                        $id_rt_miskin="";
                        $jumlah_rt_miskin="";
                        $target_rt_miskin="";
                        $capaian_rt_miskin="";
                        $persentase_rt_miskin="";
                        $dokumen_rt_miskin="";
                        $catatan_rt_miskin="";
                        $status_rt_miskin="";
                        $updatetime_rt_miskin="";
                    }else{
                        $id_rt_miskin=$DataMiskin['id_rt_miskin'];
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
                            <?php 
                                if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                    if($status_rt_miskin=="Edited"||$status_rt_miskin=="Revision"||$status_rt_miskin==""){
                            ?>
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li class="dropdown-header text-start">
                                            <h6>Option</h6>
                                        </li>
                                        <li>
                                            <?php if(empty($id_rt_miskin)){ ?>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahKkMiskin" data-id="<?php echo "$id_evaluasi"; ?>">
                                                    <i class="bi bi-plus"></i> Tambah Data KK Miskin
                                                </a>
                                            <?php }else{ ?>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditPerjanjianKinerja" data-id="<?php echo "$id_rt_miskin"; ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangDokumen" data-id="<?php echo "$id_rt_miskin"; ?>">
                                                    <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimBerkas" data-id="<?php echo "$id_rt_miskin"; ?>">
                                                    <i class="bi bi-send"></i> Kirim Berkas
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusPerjanjianKinerja" data-id="<?php echo "$id_rt_miskin"; ?>">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                            <?php 
                                    }
                                }
                            ?>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <b>B. Menurunnya Rumah Tangga Miskin</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Jumlah KK Miskin</div>
                                            <div class="col col-md-8">
                                                <small class="credit">
                                                    <?php
                                                        if(!empty($jumlah_rt_miskin)){
                                                            echo '<code class="text-grayish">'.$jumlah_rt_miskin.' KK</code>';
                                                        }else{
                                                            echo '<code>None</code>';
                                                        }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Target Penurunan</div>
                                            <div class="col col-md-8">
                                                <small class="credit">
                                                    <?php
                                                        if(!empty($target_rt_miskin)){
                                                            echo '<code class="text-grayish">'.$jumlah_rt_miskin.' KK</code>';
                                                        }else{
                                                            echo '<code>None</code>';
                                                        }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Capaian</div>
                                            <div class="col col-md-8">
                                                <small class="credit">
                                                    <?php
                                                        if(!empty($capaian_rt_miskin)){
                                                            echo '<code class="text-grayish">'.$capaian_rt_miskin.' KK</code>';
                                                        }else{
                                                            echo '<code>None</code>';
                                                        }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-4">Persentase</div>
                                            <div class="col col-md-8">
                                                <small class="credit">
                                                    <?php
                                                        if(!empty($persentase_rt_miskin)){
                                                            echo '<code class="text-grayish">'.$persentase_rt_miskin.' %</code>';
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
                                            <div class="col col-md-4">Dokumen</div>
                                            <div class="col col-md-8">
                                                <small class="credit">
                                                    <?php
                                                        if(!empty($dokumen_rt_miskin)){
                                                            echo '<code class="text-primary">';
                                                            echo '  <a href="javascript:void(0);"><i class="bi bi-paperclip"></i> Lampiran Dokumen RT Miskin</a>';
                                                            echo '</code>';
                                                        }else{
                                                            echo '<code>None</code>';
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
                                                        if($status_rt_miskin=="Edited"){
                                                            $LabelStatus='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                                                        }else{
                                                            if($status_rt_miskin=="Request"){
                                                                $LabelStatus='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                                            }else{
                                                                if($status_rt_miskin=="Valid"){
                                                                    $LabelStatus='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                                                }else{
                                                                    if($status_rt_miskin=="Revision"){
                                                                        $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                                                    }else{
                                                                        $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo "$LabelStatus"; 
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
                                                            echo '<code class="text-grayish">'.$Updatetime.'</code>';
                                                        }else{
                                                            echo '<code>None</code>';
                                                        }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                ?>
                    <div class="row mb-3">
                        <div class="col-md-10"></div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahPerjanjianKinerja" data-id="<?php echo "$id_evaluasi"; ?>" title="Tambah Perjanjian Kinerja">
                                <i class="bi bi-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <!-- Menampilkan List Perjanjian Kinerja/Start -->
                <?php
                    $JumlahPerjanjian=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM perjanjian_kinerja WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                    if(empty($JumlahPerjanjian)){
                        echo '<div class="row">';
                        echo '  <div class="col-md-12 text-center">';
                        echo '      <div class="card">';
                        echo '          <div class="card-body text-center text-danger">';
                        echo '              Belum Ada Data Perjanjian Kinerja';
                        echo '          </div>';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }else{
                        $no=1;
                        $QryPerjanjianKinerja = mysqli_query($Conn, "SELECT * FROM perjanjian_kinerja WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah' ORDER BY id_perjanjian_kinerja DESC");
                        while ($DataPerjanjianKinerja = mysqli_fetch_array($QryPerjanjianKinerja)) {
                            $id_perjanjian_kinerja= $DataPerjanjianKinerja['id_perjanjian_kinerja'];
                            $kategori= $DataPerjanjianKinerja['kategori'];
                            $nama_1= $DataPerjanjianKinerja['nama_1'];
                            $jabatan_1= $DataPerjanjianKinerja['jabatan_1'];
                            $nama_2= $DataPerjanjianKinerja['nama_2'];
                            $jabatan_2= $DataPerjanjianKinerja['jabatan_2'];
                            $tanggal= $DataPerjanjianKinerja['tanggal'];
                            $dokumen= $DataPerjanjianKinerja['dokumen'];
                            $status= $DataPerjanjianKinerja['status'];
                            $updatetime= $DataPerjanjianKinerja['updatetime'];
                            //Format Tanggal
                            $strtotime1=strtotime($tanggal);
                            $strtotime2=strtotime($updatetime);
                            $TanggalFormat=date('d/m/Y', $strtotime1);
                            $UpdatetimeFormat=date('d/m/Y H:i:s T', $strtotime2);
                ?>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                    <?php 
                                        if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                            if($status=="Edited"||$status=="Revision"||$status==""){
                                    ?>
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                <li class="dropdown-header text-start">
                                                    <h6>Option</h6>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditPerjanjianKinerja" data-id="<?php echo "$id_perjanjian_kinerja"; ?>">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUploadUlangDokumen" data-id="<?php echo "$id_perjanjian_kinerja"; ?>">
                                                        <i class="bi bi-upload"></i> Upload Ulang Dokumen
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahSasaranTarget" data-id="<?php echo "$id_perjanjian_kinerja"; ?>">
                                                        <i class="bi bi-plus"></i> Sasaran & Target
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKirimBerkas" data-id="<?php echo "$id_perjanjian_kinerja"; ?>">
                                                        <i class="bi bi-send"></i> Kirim Berkas
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusPerjanjianKinerja" data-id="<?php echo "$id_perjanjian_kinerja"; ?>">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php 
                                            }
                                        }
                                    ?>
                                        <div class="card-header">
                                            <b class="card-title text-dark"><?php echo "$no. Perjanjian Kinerja $TanggalFormat"; ?></b>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Kategori</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish">
                                                                    <?php 
                                                                        if($kategori=="Perangkat-Kades"){
                                                                            echo "Perangkat Desa Dengan Kepala Desa";
                                                                        }else{
                                                                            echo "Kepala Desa Dengan Camat";
                                                                        }
                                                                    ?>
                                                                </code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Tanggal</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish"><?php echo "$TanggalFormat"; ?></code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Pihak Pertama</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish"><?php echo "$nama_1 ($jabatan_1)"; ?></code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Pihak Kedua</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish"><?php echo "$nama_2 ($jabatan_2)"; ?></code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Dokumen</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <?php
                                                                    if(empty($dokumen)){
                                                                        echo '<code>None</code>';
                                                                    }else{
                                                                        echo '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalViewDokumen" data-id="'.$id_perjanjian_kinerja.'">';
                                                                        echo '  <code class="text-primary"><i class="bi bi-paperclip"></i> Lampiran Perjanjian Kinerja</code>';
                                                                        echo '</a>';
                                                                    }
                                                                ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Status</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish">
                                                                    <?php 
                                                                        if($status=="Edited"){
                                                                            $LabelStatus='<code class="text-success" title="Dokumen masih dalam perubahan">Edited</code>';
                                                                        }else{
                                                                            if($status=="Request"){
                                                                                $LabelStatus='<code class="text-info" title="Dokumen meminta validitas kecamatan">Request</code>';
                                                                            }else{
                                                                                if($status=="Valid"){
                                                                                    $LabelStatus='<code class="text-primary" title="Dokumen Sudah Valid">Valid</code>';
                                                                                }else{
                                                                                    if($status=="Revision"){
                                                                                        $LabelStatus='<code class="text-danger" title="Dokumen Meminta Perbaikan">Revision</code>';
                                                                                    }else{
                                                                                        $LabelStatus='<code class="text-danger" title="Status Tidak Diketahui">None</code>';
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        echo "$LabelStatus"; 
                                                                    ?>
                                                                </code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">Updatetime</div>
                                                        <div class="col-md-9">
                                                            <small class="credit">
                                                                <code class="text text-grayish"><?php echo "$UpdatetimeFormat"; ?></code>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <b>Sasaran, Indikator & Target</b>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="table table-responsive">
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="center"><b>No</b></td>
                                                                    <td align="center"><b>Sasaran</b></td>
                                                                    <td align="center"><b>Indikator</b></td>
                                                                    <td align="center"><b>Target</b></td>
                                                                    <td align="center"><b>Opt</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    //Jumlah Sasaran & Target
                                                                    $JumlahSasaran=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM perjanjian_sasaran WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'"));
                                                                    if(empty($JumlahSasaran)){
                                                                        echo '<tr>';
                                                                        echo '  <td colspan="5" class="text-center text-danger">Sasaran & Target Perjanjian Kinerja Belum Ada</td>';
                                                                        echo '</tr>';
                                                                    }else{
                                                                        $no=1;
                                                                        $QrySasaran = mysqli_query($Conn, "SELECT*FROM perjanjian_sasaran WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja' ORDER BY id_perjanjian_sasaran ASC");
                                                                        while ($DataSasaran = mysqli_fetch_array($QrySasaran)) {
                                                                            $id_perjanjian_sasaran= $DataSasaran['id_perjanjian_sasaran'];
                                                                            $sasaran= $DataSasaran['sasaran'];
                                                                            $indikator= $DataSasaran['indikator'];
                                                                            $target= $DataSasaran['target'];
                                                                            $satuan_target= $DataSasaran['satuan_target'];
                                                                            echo '<tr>';
                                                                            echo '  <td align="center">'.$no.'</td>';
                                                                            echo '  <td align="left">'.$sasaran.'</td>';
                                                                            echo '  <td align="left">';
                                                                            $dataArray = json_decode($indikator, true);

                                                                            if (json_last_error() === JSON_ERROR_NONE) {
                                                                                echo '<code class="text-grayish">';
                                                                                // Memulai daftar berurut (ordered list)
                                                                                echo '<ol>';
                                                                                
                                                                                // Melakukan looping melalui setiap item dalam array
                                                                                foreach ($dataArray as $item) {
                                                                                    echo '<li class="mb-3">' . htmlspecialchars($item['indikator']) . '</li>';
                                                                                }
                                                                                
                                                                                // Menutup daftar berurut
                                                                                echo '</ol>';
                                                                                echo '</code>';
                                                                            } else {
                                                                                echo 'Error decoding JSON: ' . json_last_error_msg();
                                                                            }
                                                                            echo '  </td>';
                                                                            echo '  <td align="center"><code class="text-dark">'.$target.' '.$satuan_target.'</code></td>';
                                                                            echo '  <td align="center">';
                                                                            echo '      <div class="btn-group">';
                                                                            if($TanggalSekarang>=$periode_awal&&$TanggalSekarang<=$periode_akhir){ 
                                                                                if($status=="Edited"||$status=="Revision"||$status==""){
                                                                                    echo '          <button type="button" class="btn btn-sm btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalEditSasaran" data-id="'.$id_perjanjian_sasaran.'" title="Update/Edit Sasaran Perjanjian Kinerja">';
                                                                                    echo '              <i class="bi bi-pencil"></i>';
                                                                                    echo '          </button>';
                                                                                    echo '          <button type="button" class="btn btn-sm btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalHapusSasaran" data-id="'.$id_perjanjian_sasaran.'" title="Hapus Sasaran Perjanjian Kinerja">';
                                                                                    echo '              <i class="bi bi-x"></i>';
                                                                                    echo '          </button>';
                                                                                }else{
                                                                                    echo '          <button type="button" disabled class="btn btn-sm btn-outline-grayish" title="Update/Edit Sasaran Perjanjian Kinerja">';
                                                                                    echo '              <i class="bi bi-pencil"></i>';
                                                                                    echo '          </button>';
                                                                                    echo '          <button type="button" disabled class="btn btn-sm btn-outline-grayish" title="Hapus Sasaran Perjanjian Kinerja">';
                                                                                    echo '              <i class="bi bi-x"></i>';
                                                                                    echo '          </button>';
                                                                                }
                                                                            }
                                                                            echo '      </div>';
                                                                            echo '  </td>';
                                                                            echo '</tr>';
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
                <?php 
                            $no++;
                        }
                    } 
                ?>
                <!-- Menampilkan List Perjanjian Kinerja/End -->
        <?php }}} ?>
    </section>
<?php
    }
?>