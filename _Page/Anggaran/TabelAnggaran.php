<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM anggaran WHERE id_wilayah='$SessionIdWilayah'"));
?>
<div class="row mb-3">
    <?php
        if(empty($jml_data)){
            echo '<div class="col-md-12">';
            echo '  <div class="card">';
            echo '      <div class="card-body text-center">';
            echo '          Tidak Ada Informasi Anggaran Yang Ditemukan';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT*FROM anggaran WHERE id_wilayah='$SessionIdWilayah' ORDER BY periode_awal  ASC");
            while ($data = mysqli_fetch_array($query)) {
                $id_anggaran= $data['id_anggaran'];
                $id_wilayah= $data['id_wilayah'];
                $periode_awal= $data['periode_awal'];
                $periode_akhir= $data['periode_akhir'];
                if(empty($data['kepala_desa'])){
                    $kepala_desa='<span class="text-danger">None</span>';
                }else{
                    $kepala_desa= $data['kepala_desa'];
                    $kepala_desa='<span class="text-info">'.$kepala_desa.'</span>';
                }
                if(empty($data['sekretaris_desa'])){
                    $sekretaris_desa='<span class="text-danger">None</span>';
                }else{
                    $sekretaris_desa= $data['sekretaris_desa'];
                    $sekretaris_desa='<span class="text-info">'.$sekretaris_desa.'</span>';
                }
                $status= $data['status'];
                if($status=="Edited"){
                    $status='<span class="text-success">'.$status.'</span>';
                }else{
                    if($status=="Valid"){
                        $status='<span class="text-primary">'.$status.'</span>';
                    }else{
                        $status='<span class="text-danger">'.$status.'</span>';
                    }
                }
                //Hitung Total Anggaran
                $SqlJumlah = "SELECT SUM(anggaran) AS total FROM anggaran_rincian WHERE id_anggaran='$id_anggaran'";
                $result = $Conn->query($SqlJumlah);
                // Periksa apakah hasil kueri tersedia
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $anggaran=$row['total'];
                } else {
                    $anggaran ="0";
                }
                //Update
                $UpdateAnggaran = mysqli_query($Conn,"UPDATE anggaran SET 
                    jumlah='$anggaran'
                WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn)); 
                $rupiahAnggaran = "Rp " . number_format($anggaran, 0, ',', '.');
                $TotalAnggaran='<span class="text-info">'.$rupiahAnggaran.'</span>';
                //Hitung Total Progress
                $SqlProgress = "SELECT SUM(alokasi_anggaran) AS total_alokasi FROM anggaran_progress WHERE id_anggaran='$id_anggaran'";
                $ResultProgress = $Conn->query($SqlProgress);
                // Periksa apakah hasil kueri tersedia
                if ($ResultProgress->num_rows > 0) {
                    $Baris = $ResultProgress->fetch_assoc();
                    if(!empty($Baris['total_alokasi'])){
                        $total_alokasi=$Baris['total_alokasi'];
                        $TotalAlokasi = "Rp " . number_format($total_alokasi, 0, ',', '.');
                        //Persentase
                        $Persentase=($total_alokasi/$anggaran)*100;
                        $Persentase=round($Persentase,2);
                    }else{
                        $total_alokasi="0";
                        $TotalAlokasi ="0";
                        //Persentase
                        $Persentase="0";
                        $Persentase="0";
                    }
                    
                } else {
                    $total_alokasi ="0";
                    $TotalAlokasi = "Rp " . number_format("0", 0, ',', '.');
                    $Persentase ="0";
                }
    ?>
    </div>
        <div class="col-md-12">
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?Page=Anggaran&Sub=AnggaranRincian&id=<?php echo "$id_anggaran"; ?>">
                                <i class="bi bi-info-circle"></i> Lihat Detail
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAnggaran" data-id="<?php echo "$id_anggaran"; ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAnggaran" data-id="<?php echo "$id_anggaran"; ?>">
                                <i class="bi bi-x"></i> Hapus
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                    <a href="index.php?Page=Anggaran&Sub=AnggaranRincian&id=<?php echo "$id_anggaran"; ?>" title="Lihat Detail">
                        <b><?php echo "$no. Anggaran Thn $periode_awal s/d $periode_akhir";?></b>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="credit">
                                <code class="text-dark">
                                    <ul>
                                        <li>
                                            ID : <?php echo "$id_anggaran"; ?>
                                        </li>
                                        <li>
                                            Status : <?php echo "$status"; ?>
                                        </li>
                                    </ul>
                                </code>
                            </small>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">
                                <code class="text-dark">
                                    <ul>
                                        <li>
                                            Kades/Lurah : <?php echo "$kepala_desa"; ?>
                                        </li>
                                        <li>
                                            Sekretaris : <?php echo "$sekretaris_desa"; ?>
                                        </li>
                                    </ul>
                                </code>
                            </small>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">
                                <code class="text-dark">
                                    <ul>
                                        <li>
                                            Total Anggaran : <?php echo "$TotalAnggaran"; ?>
                                        </li>
                                        <li>
                                            Realisasi : <span class="text-info"><?php echo "$TotalAlokasi ($Persentase %)"; ?></span>
                                        </li>
                                    </ul>
                                </code>
                            </small>
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
</div>