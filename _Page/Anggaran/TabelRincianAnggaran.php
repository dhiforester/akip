<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    if(empty($_POST['id_anggaran'])){
        echo '<div class="row mb-3">';
        echo '   <div class="col col-md-12 text-center text-danger">';
        echo '      ID Anggaran Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['tahun_anggaran'])){
            echo '<div class="row mb-3">';
            echo '   <div class="col col-md-12 text-center text-danger">';
            echo '      Tahun Anggaran Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggaran=$_POST['id_anggaran'];
            $tahun_anggaran=$_POST['tahun_anggaran'];
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran'"));
?>
    <div class="row mb-4">
        <div class="col-md-3">
            Tahun Anggaran
        </div>
        <div class="col md-9">
            <code class="text-grayish"><?php echo "$tahun_anggaran"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg bg-black">
                        <tr>
                            <th><b class="text-light">Kode</b></th>
                            <th><b class="text-light">Bidang/Kegiatan</b></th>
                            <th><b class="text-light">Anggaran</b></th>
                            <th><b class="text-light">Progress</b></th>
                            <th><b class="text-light">Opt</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="5" class="text-center">';
                                echo '      Tidak Ada Data Anggaran Yang Ditemukan';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1;
                                $query = mysqli_query($Conn, "SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' ORDER BY kode ASC");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_anggaran_rincian= $data['id_anggaran_rincian'];
                                    $kode= $data['kode'];
                                    $kode_bidang= $data['kode_bidang'];
                                    $kode_sub_bidang= $data['kode_sub_bidang'];
                                    $kode_kegiatan= $data['kode_kegiatan'];
                                    $nama= $data['nama'];
                                    $level= $data['level'];
                                    $sasaran= $data['sasaran'];
                                    $volume= $data['volume'];
                                    $satuan= $data['satuan'];
                                    $anggaran= $data['anggaran'];
                                    $durasi= $data['durasi'];
                        ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if($level=="Bidang"){
                                                    echo '<b>'.$kode.'</b>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        echo ''.$kode.'';
                                                    }else{
                                                        echo '<code class="text text-grayish">'.$kode.'</code>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($level=="Bidang"){
                                                    echo '<b>'.$nama.'</b>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        echo ''.$nama.'';
                                                    }else{
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailRincianAnggaran" data-id="'.$id_anggaran_rincian.'" class="text-dark"><code class="text text-grayish">'.$nama.'</code></a>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td align="right">
                                            <?php 
                                                if($level=="Kegiatan"){
                                                    $rupiahAnggaran = "Rp " . number_format($anggaran, 2, ',', '.');
                                                    echo '<small class="credit">';
                                                    echo '  <code class="text text-grayish">';
                                                    echo '      '.$rupiahAnggaran.'';
                                                    echo '  </code>';
                                                    echo '</small>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        $SqlJumlah = "SELECT SUM(anggaran) AS total FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' AND kode_sub_bidang='$kode_sub_bidang'";
                                                        $result = $Conn->query($SqlJumlah);
                                                        // Periksa apakah hasil kueri tersedia
                                                        if ($result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            $anggaran=$row['total'];
                                                        } else {
                                                            $anggaran ="0";
                                                        }
                                                        $rupiahAnggaran = "Rp " . number_format($anggaran, 2, ',', '.');
                                                        echo '      '.$rupiahAnggaran.'';
                                                    }else{
                                                        if($level=="Bidang"){
                                                            $SqlJumlah = "SELECT SUM(anggaran) AS total FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' AND kode_bidang='$kode_bidang'";
                                                            $result = $Conn->query($SqlJumlah);
                                                            // Periksa apakah hasil kueri tersedia
                                                            if ($result->num_rows > 0) {
                                                                $row = $result->fetch_assoc();
                                                                $anggaran=$row['total'];
                                                            } else {
                                                                $anggaran =0;
                                                            }
                                                            $rupiahAnggaran = "Rp " . number_format($anggaran, 2, ',', '.');
                                                            echo '<b>';
                                                            echo '  '.$rupiahAnggaran.'';
                                                            echo '</b>';
                                                        }else{
                                                            echo '<span class="text-danger">';
                                                            echo '  None';
                                                            echo '</span>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td align="right">
                                            <?php 
                                                //PROGRESS ANGGARAN
                                                if($level=="Kegiatan"){
                                                    //Membuka Data Progress
                                                    $alokasi_anggaran=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'alokasi_anggaran');
                                                    if(empty($alokasi_anggaran)){
                                                        $alokasi_anggaran="0";
                                                        $PersentaseAnggaran="0";
                                                    }else{
                                                        $PersentaseAnggaran=($alokasi_anggaran/$anggaran)*100;
                                                    }
                                                    $PersentaseAnggaran=round($PersentaseAnggaran);
                                                    //Persentase Progress
                                                    $RupiahAlokasiAnggaran = "Rp " . number_format($alokasi_anggaran, 2, ',', '.');
                                                    echo '<small class="credit">';
                                                    echo '  <code class="text text-grayish">';
                                                    echo '      '.$PersentaseAnggaran.' %';
                                                    echo '  </code>';
                                                    echo '</small>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        
                                                    }else{
                                                        if($level=="Bidang"){

                                                        }else{
                                                            echo '<span class="text-danger">Rp 0</span>';
                                                            echo '  0';
                                                            echo '';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                                if($level=="Kegiatan"){
                                                    echo '<button type="button" class="btn btn-sm btn-outline-dark" title="Edit Parameter" data-bs-toggle="modal" data-bs-target="#ModalEditRincianAnggaran" data-id="'.$id_anggaran_rincian.'">';
                                                    echo '  <i class="bi bi-pencil"></i>';
                                                    echo '</button>';
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
<?php 
        }
    } 
?>