<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1'"));
?>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="table table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg bg-black">
                    <tr>
                        <th><b class="text-light">Kode</b></th>
                        <th colspan="4"><b class="text-light">Komponen Penilaian</b></th>
                        <th class="text-center" align="center"><b class="text-light">Bobot (%)</b></th>
                        <th><b class="text-light">Option</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($jml_data)){
                            echo '<tr>';
                            echo '  <td colspan="4" class="text-center">';
                            echo '      Tidak Ada Data Bidang Yang Ditemukan';
                            echo '  </td>';
                            echo '</tr>';
                        }else{
                            $no = 1;
                            $JumlahTotalBobot=0;
                            //KONDISI PENGATURAN MASING FILTER
                            $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator ORDER BY kode ASC");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_kriteria_indikator= $data['id_kriteria_indikator'];
                                $kode= $data['kode'];
                                $level= $data['level'];
                                $teks= $data['teks'];
                                if($level=="Level 4"){
                                    $teks='<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailPernyataan" data-id="'.$id_kriteria_indikator.'">'.$teks.'</a>';
                                }
                                //Cek apakah ada lampiran bukti yang terhubung?
                                $LampiranYangTerhubung = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator_ref WHERE id_kriteria_indikator='$id_kriteria_indikator'"));
                    ?>
                                <tr>
                                    
                                    <?php
                                        if($level=="Level 1"){
                                            $level_1= $data['level_1'];
                                            $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_1='$level_1'";
                                            $result = $Conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $JumlahBobot=$row['total'];
                                            $JumlahTotalBobot=$JumlahTotalBobot+$JumlahBobot;
                                            echo '<td><b>'.$kode.'</b></td>';
                                            echo '<td colspan="4"><b>'.$teks.' ('.$JumlahBobot.' %)</b></td>';
                                        }else{
                                            if($level=="Level 2"){
                                                //Menghitung Count
                                                $level_2= $data['level_2'];
                                                $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'";
                                                $result = $Conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $JumlahBobot=$row['total'];
                                                echo '<td></td>';
                                                echo '<td>'.$kode.'</td><td colspan="3">'.$teks.' ('.$JumlahBobot.' %)</td>';
                                            }else{
                                                if($level=="Level 3"){
                                                    $bobot_note= $data['bobot'];
                                                    echo '<td></td>';
                                                    echo '<td></td><td><code class="text text-dark">'.$kode.'</code></td><td colspan="2"><code class="text text-dark">'.$teks.' ('.$bobot_note.')</code></td>';
                                                }else{
                                                    if(!empty($LampiranYangTerhubung)){
                                                        echo '<td></td>';
                                                        echo '<td></td><td></td><td><code class="text"><small class="credit text-grayish">'.$kode.'</small></code></td><td><code class="text"><small class="credit text-grayish">'.$teks.'</small></code> <badge class="badge badge-success">'.$LampiranYangTerhubung.'</badge></td>';
                                                    }else{
                                                        echo '<td></td>';
                                                        echo '<td></td><td></td><td><code class="text"><small class="credit text-grayish">'.$kode.'</small></code></td><td><code class="text"><small class="credit text-grayish">'.$teks.'</small></code></td>';
                                                    }
                                                    
                                                }
                                            }
                                        }
                                    ?>
                                    <td class="text-center">
                                        <?php
                                            if($level=="Level 1"){
                                                $level_1= $data['level_1'];
                                                //Hitung Bobot Dari Level 4
                                                $JumlahBobot=0;
                                                $QryBobotBawah = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 4' AND level_1='$level_1'");
                                                while ($DataBobotBawah = mysqli_fetch_array($QryBobotBawah)) {
                                                    $alternatif_bawah= $DataBobotBawah['alternatif'];
                                                    $array = json_decode($alternatif_bawah, true);
                                                    $maxValue = null;
                                                    $maxItem = null;
                                                    // Iterasi melalui array untuk menemukan nilai terbesar
                                                    foreach ($array as $item) {
                                                        $nilai = floatval($item['nilai']); // Konversi nilai ke float
                                                        if ($maxValue === null || $nilai > $maxValue) {
                                                            $maxValue = $nilai;
                                                            $maxItem = $item;
                                                        }
                                                    }
                                                    // Tampilkan item dengan nilai terbesar
                                                    if ($maxItem !== null) {
                                                        $MaxAlternatif=$maxValue;
                                                    } else {
                                                        $MaxAlternatif=0;
                                                    }
                                                    $JumlahBobot=$JumlahBobot+$MaxAlternatif;
                                                }
                                                $JumlahBobot=number_format($JumlahBobot, 2, '.', '');
                                                echo '<b>'.$JumlahBobot.'</b>';
                                            }else{
                                                if($level=="Level 2"){
                                                    //Menghitung Count
                                                    $level_1= $data['level_1'];
                                                    $level_2= $data['level_2'];
                                                    //Hitung Bobot Dari Level 4
                                                    $JumlahBobot=0;
                                                    $QryBobotBawah = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 4' AND level_2='$level_2' AND level_1='$level_1'");
                                                    while ($DataBobotBawah = mysqli_fetch_array($QryBobotBawah)) {
                                                        $alternatif_bawah= $DataBobotBawah['alternatif'];
                                                        $array = json_decode($alternatif_bawah, true);
                                                        $maxValue = null;
                                                        $maxItem = null;
                                                        // Iterasi melalui array untuk menemukan nilai terbesar
                                                        foreach ($array as $item) {
                                                            $nilai = floatval($item['nilai']); // Konversi nilai ke float
                                                            if ($maxValue === null || $nilai > $maxValue) {
                                                                $maxValue = $nilai;
                                                                $maxItem = $item;
                                                            }
                                                        }
                                                        // Tampilkan item dengan nilai terbesar
                                                        if ($maxItem !== null) {
                                                            $MaxAlternatif=$maxValue;
                                                        } else {
                                                            $MaxAlternatif=0;
                                                        }
                                                        $JumlahBobot=$JumlahBobot+$MaxAlternatif;
                                                    }
                                                    $JumlahBobot=number_format($JumlahBobot, 2, '.', '');
                                                    echo ''.$JumlahBobot.'';
                                                }else{
                                                    if($level=="Level 3"){
                                                        $level_1= $data['level_1'];
                                                        $level_2= $data['level_2'];
                                                        $level_3= $data['level_3'];
                                                        //Hitung Bobot Dari Level 4
                                                        $JumlahBobot=0;
                                                        $QryBobotBawah = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 4' AND level_3='$level_3' AND level_2='$level_2' AND level_1='$level_1'");
                                                        while ($DataBobotBawah = mysqli_fetch_array($QryBobotBawah)) {
                                                            $alternatif_bawah= $DataBobotBawah['alternatif'];
                                                            $array = json_decode($alternatif_bawah, true);
                                                            $maxValue = null;
                                                            $maxItem = null;
                                                            // Iterasi melalui array untuk menemukan nilai terbesar
                                                            foreach ($array as $item) {
                                                                $nilai = floatval($item['nilai']); // Konversi nilai ke float
                                                                if ($maxValue === null || $nilai > $maxValue) {
                                                                    $maxValue = $nilai;
                                                                    $maxItem = $item;
                                                                }
                                                            }
                                                            // Tampilkan item dengan nilai terbesar
                                                            if ($maxItem !== null) {
                                                                $MaxAlternatif=$maxValue;
                                                            } else {
                                                                $MaxAlternatif=0;
                                                            }
                                                            $JumlahBobot=$JumlahBobot+$MaxAlternatif;
                                                        }
                                                        $JumlahBobot=number_format($JumlahBobot, 2, '.', '');
                                                        echo '<code class="text text-dark">'.$JumlahBobot.'</code>';
                                                    }else{
                                                        $alternatif= $data['alternatif'];
                                                        $array = json_decode($alternatif, true);
                                                        $maxValue = null;
                                                        $maxItem = null;
                                                        // Iterasi melalui array untuk menemukan nilai terbesar
                                                        foreach ($array as $item) {
                                                            $nilai = floatval($item['nilai']); // Konversi nilai ke float
                                                            if ($maxValue === null || $nilai > $maxValue) {
                                                                $maxValue = $nilai;
                                                                $maxItem = $item;
                                                            }
                                                        }
                                                        // Tampilkan item dengan nilai terbesar
                                                        if ($maxItem !== null) {
                                                            $MaxAlternatif=$maxValue;
                                                        } else {
                                                            $MaxAlternatif=0;
                                                        }
                                                        echo '<code class="text"><small class="credit text-grayish">'.$MaxAlternatif.'</small></code>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td class="text">
                                        <div class="btn-group">
                                            <?php
                                                if($level!=="Level 4"){
                                                    echo '<button type="button" class="btn btn-sm btn-outline-dark" title="Tambah Indikator" data-bs-toggle="modal" data-bs-target="#ModalAddFormIndikator" data-id="'.$id_kriteria_indikator.'">';
                                                    echo '  <i class="bi bi-plus"></i>';
                                                    echo '</button>';
                                                }
                                                if($level=="Level 4"){
                                                    echo '<button type="button" class="btn btn-sm btn-outline-dark" title="Tambah Parameter Lampiran Yang Terhubung" data-bs-toggle="modal" data-bs-target="#ModalReferensiParameter" data-id="'.$id_kriteria_indikator.'">';
                                                    echo '  <i class="bi bi-journal-plus"></i>';
                                                    echo '</button>';
                                                }
                                            ?>
                                            <button type="button" class="btn btn-sm btn-outline-dark" title="Edit Parameter" data-bs-toggle="modal" data-bs-target="#ModalEditKriteria" data-id="<?php echo $id_kriteria_indikator; ?>">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-dark" title="Hapus Parameter" data-bs-toggle="modal" data-bs-target="#ModalHapusKriteria" data-id="<?php echo $id_kriteria_indikator; ?>">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                    <?php
                                $no++; 
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="5"><b>BOBOT TOTAL</b></td>
                        <td align="center"><b><?php echo "$JumlahTotalBobot"; ?></b></td>
                        <td align="center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>