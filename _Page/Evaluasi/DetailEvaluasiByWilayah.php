<?php
    if(empty($_GET['id_evaluasi'])){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '  ID Evaluasi tidak boleh kosong!';
        echo '</div>';
    }else{
        if(empty($_GET['id_wilayah'])){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '  ID Wilayah tidak boleh kosong!';
            echo '</div>';
        }else{
            $id_evaluasi=$_GET['id_evaluasi'];
            $id_wilayah=$_GET['id_wilayah'];
            if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '  ID Evaluasi Hanya boleh angka!';
                echo '</div>';
            }else{
                if(!preg_match("/^[0-9]*$/", $id_wilayah)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo '  ID Wilayah Hanya boleh angka!';
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
                    //Wilayah
                    $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kategori');
                    $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                    $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                    $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                    $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
                    //Jika Sudah Ada Buka Data Rekap
                    $QryRekap = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'")or die(mysqli_error($Conn));
                    $DataRekap = mysqli_fetch_array($QryRekap);
                    if(!empty($DataRekap['id_evaluasi_rekap'])){
                        $SkorRekapitulasi=$DataRekap['skor'];
                        $RekomendasiRekapitulasi=$DataRekap['rekomendasi'];
                        $StatusRekapitulasi=$DataRekap['status'];
                    }else{
                        $SkorRekapitulasi='<span class="text-danger">None</span>';
                        $RekomendasiRekapitulasi='<span class="text-danger">None</span>';
                        $StatusRekapitulasi='<span class="text-danger">None</span>';
                    }
?>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Berikut ini adalah rincian respon pihak otoritas dalam menjawab instrumen evaluasi.
                        Silahkan lakukan validasi pada jawaban tersebut. 
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <a href="index.php?Page=Evaluasi&Sub=DetailEvaluasi&id=<?php echo "$id_evaluasi"; ?>" class="btn btn-md btn-rounded btn-dark btn-block">
                        <i class="bi bi-chevron-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">
                                <i class="bi bi-info-circle"></i> Penilaian Evaluasi
                            </b>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 border-1 border-bottom">
                                <div class="col-md-4">
                                    <small class="credit"><b>Info Evaluasi</b></small>
                                    <ul>
                                        <li>
                                            <small class="credit">
                                                Periode : <code><?php echo $periode; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Pelaksanaan : <code><?php echo "$periode_awal s/d $periode_akhir"; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Update : <code><?php echo $updatetime; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Status : <code><?php echo $status; ?></code>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <small class="credit"><b>Wilayah Otoritas</b></small>
                                    <ul>
                                        <li>
                                            <small class="credit">
                                                Provinsi : <code><?php echo $ProvinsiWilayah; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Kabupaten/Kota : <code><?php echo $KabupatenWilayah; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Kecamatan : <code><?php echo $KecamatanWilayah; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Desa/Kelurahan : <code><?php echo $DesaWilayah; ?></code>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <small class="credit"><b>Hasil Evaluasi</b></small>
                                    <ul>
                                        <li>
                                            <small class="credit">
                                                Skor : <code><?php echo $SkorRekapitulasi; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Status : <code><?php echo $StatusRekapitulasi; ?></code>
                                            </small>
                                        </li>
                                        <li>
                                            <small class="credit">
                                                Rekomendasi : <code><?php echo $RekomendasiRekapitulasi; ?></code>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 table table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg bg-black">
                                            <tr>
                                                <th><b class="text-light">Kode</b></th>
                                                <th><b class="text-light">Komponen Penilaian</b></th>
                                                <th><b class="text-light">Bobot</b></th>
                                                <th><b class="text-light">Skor</b></th>
                                                <th><b class="text-light">Status</b></th>
                                                <th><b class="text-light">Option</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 4'"));
                                                if(empty($jml_data)){
                                                    echo '<tr>';
                                                    echo '  <td colspan="6" class="text-center">';
                                                    echo '      Tidak Ada Komponen Penilaian Yang Ditemukan';
                                                    echo '  </td>';
                                                    echo '</tr>';
                                                }else{
                                                    $no = 1;
                                                    //KONDISI PENGATURAN MASING FILTER
                                                    $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator ORDER BY kode ASC");
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        $id_kriteria_indikator= $data['id_kriteria_indikator'];
                                                        $kode= $data['kode'];
                                                        $level= $data['level'];
                                                        $level_1= $data['level_1'];
                                                        $level_2= $data['level_2'];
                                                        $level_3= $data['level_3'];
                                                        $level_4= $data['level_4'];
                                                        $teks= $data['teks'];
                                                        //Cek Apakah Sudah Terjawab ATau Belum
                                                        $CekTerjawab = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'"));
                                                        //Cek Skor
                                                        $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                                                        $DataJawaban = mysqli_fetch_array($QryJawaban);
                                                        if(empty($DataJawaban['id_evaluasi_jawaban'])){
                                                            $id_evaluasi_jawaban="";
                                                            $jawaban="";
                                                            $skor="None";
                                                            $status="None";
                                                        }else{
                                                            $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                                                            $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
                                                            $skor=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'skor');
                                                            $status=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'status');
                                                            if(empty($skor)){
                                                                $skor="0";
                                                            }
                                                        }
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                    if($level=="Level 1"){
                                                                        echo '<b>'.$kode.'</b>';
                                                                    }else{
                                                                        if($level=="Level 2"){
                                                                            echo ''.$kode.'';
                                                                        }else{
                                                                            if($level=="Level 3"){
                                                                                echo '<code class="text text-dark">'.$kode.'</code>';
                                                                            }else{
                                                                                echo '<code class="text"><small class="credit text-grayish">'.$kode.'</small></code>';
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($level=="Level 1"){
                                                                        echo '<b>'.$teks.'</b>';
                                                                    }else{
                                                                        if($level=="Level 2"){
                                                                            echo ''.$teks.'';
                                                                        }else{
                                                                            if($level=="Level 3"){
                                                                                echo '<code class="text text-dark">'.$teks.'</code>';
                                                                            }else{
                                                                                echo '<code class="text"><small class="credit text-grayish">'.$teks.'</small></code>';
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                    if($level=="Level 1"){
                                                                        $level_1= $data['level_1'];
                                                                        $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_1='$level_1'";
                                                                        $result = $Conn->query($sql);
                                                                        $row = $result->fetch_assoc();
                                                                        $JumlahBobot=$row['total'];
                                                                        echo '<b>'.$JumlahBobot.' %</b>';
                                                                    }else{
                                                                        if($level=="Level 2"){
                                                                            //Menghitung Count
                                                                            $level_2= $data['level_2'];
                                                                            $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'";
                                                                            $result = $Conn->query($sql);
                                                                            $row = $result->fetch_assoc();
                                                                            $JumlahBobot=$row['total'];
                                                                            echo ''.$JumlahBobot.' %';
                                                                        }else{
                                                                            if($level=="Level 3"){
                                                                                $bobot= $data['bobot'];
                                                                                echo '<code class="text text-dark">'.$bobot.' %</code>';
                                                                            }else{
                                                                                echo '<code class="text"><small class="credit text-grayish">-</small></code>';
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    if($level=="Level 4"){
                                                                        echo '<code class="text"><small class="credit text-grayish">'.$skor.'</small></code>';
                                                                    }else{
                                                                        if($level=="Level 3"){
                                                                            //Arraykan semua level 4 berdasarkan level 3
                                                                            $TotalSkor=0;
                                                                            $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_3='$level_3' AND level_2='$level_2' AND level_1='$level_1'");
                                                                            while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                                $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                                //Jumlahkan
                                                                                $sql = "SELECT SUM(skor) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$id_wilayah'";
                                                                                $result = $Conn->query($sql);
                                                                                $row = $result->fetch_assoc();
                                                                                $JumlahSkor=$row['total'];
                                                                                $TotalSkor=$TotalSkor+$JumlahSkor;
                                                                            }
                                                                            echo '<code class="text text-dark">'.$TotalSkor.'</code>';
                                                                        }else{
                                                                            if($level=="Level 2"){
                                                                                //Arraykan semua level 4 berdasarkan level 3
                                                                                $TotalSkor=0;
                                                                                $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'");
                                                                                while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                                    $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                                    //Jumlahkan
                                                                                    $sql = "SELECT SUM(skor) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$id_wilayah'";
                                                                                    $result = $Conn->query($sql);
                                                                                    $row = $result->fetch_assoc();
                                                                                    $JumlahSkor=$row['total'];
                                                                                    $TotalSkor=$TotalSkor+$JumlahSkor;
                                                                                }
                                                                                echo ''.$TotalSkor.'';
                                                                            }else{
                                                                                if($level=="Level 1"){
                                                                                    //Arraykan semua level 4 berdasarkan level 3.2.
                                                                                    $TotalSkor=0;
                                                                                    $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1'");
                                                                                    while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                                        $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                                        //Jumlahkan
                                                                                        $sql = "SELECT SUM(skor) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$id_wilayah'";
                                                                                        $result = $Conn->query($sql);
                                                                                        $row = $result->fetch_assoc();
                                                                                        $JumlahSkor=$row['total'];
                                                                                        $TotalSkor=$TotalSkor+$JumlahSkor;
                                                                                    }
                                                                                    echo '<b>'.$TotalSkor.'</b>';
                                                                                }else{
                                    
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php 
                                                                    if($level=="Level 4"){
                                                                        if($status=="Dikirim"){
                                                                            $StatusLabel='<small class="credit text-info" title="Dikirim">Dikirim</small>';
                                                                        }else{
                                                                            if($status=="Revisi"){
                                                                                $StatusLabel='<small class="credit text-danger" title="Revisi">Revisi</small>';
                                                                            }else{
                                                                                if($status=="Selesai"){
                                                                                    $StatusLabel='<small class="credit text-success" title="dikirim">Selesai</small>';
                                                                                }else{
                                                                                    $StatusLabel="";
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        $StatusLabel="";
                                                                    }
                                                                    echo "$StatusLabel";
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if($level=="Level 4"){ ?>
                                                                    <?php 
                                                                        if(!empty($id_evaluasi_jawaban)){ 
                                                                    ?>
                                                                        <button type="button" class="btn btn-sm btn-info" title="Lihat Response" data-bs-toggle="modal" data-bs-target="#ModalUbahResponse" data-id="<?php echo "$id_evaluasi_jawaban"; ?>">
                                                                            <i class="bi bi-file-earmark"></i>
                                                                        </button>
                                                                    <?php } ?>
                                                                <?php } ?>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-md btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalRekapJawaban" data-id="<?php echo "$id_evaluasi,$id_wilayah"; ?>">
                                        Rekap Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
                    }
                }
        }
    }
?>