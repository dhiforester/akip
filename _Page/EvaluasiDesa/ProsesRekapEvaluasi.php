<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_evaluasi tidak boleh kosong
    if(empty($_POST['id_evaluasi'])){
        echo '<small class="text-danger">ID Evaluasi tidak boleh kosong</small>';
    }else{
        //Validasi id_wilayah tidak boleh kosong
        if(empty($_POST['id_wilayah'])){
            echo '<small class="text-danger">ID Wilayah tidak boleh kosong</small>';
        }else{
            $id_evaluasi=$_POST['id_evaluasi'];
            $id_wilayah=$_POST['id_wilayah'];
            $JumlahKriteriaIndikator = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1'"));
            if(empty($JumlahKriteriaIndikator)){
                echo '<small class="text-danger">Tidak Ada Kriteria Indikator Pada Periode Evaluasi Ini</small>';
            }else{
                $Total=0;
                $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_kriteria_indikator= $data['id_kriteria_indikator'];
                    $level_1= $data['level_1'];
                    $kode= $data['kode'];
                    $teks= $data['teks'];
                    $TotalSkor=0;
                    $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1'");
                    while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                        $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                        //Jumlahkan
                        $sql = "SELECT SUM(skor_desa) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$id_wilayah' AND id_evaluasi='$id_evaluasi'";
                        $result = $Conn->query($sql);
                        $row = $result->fetch_assoc();
                        $JumlahSkor=$row['total'];
                        $TotalSkor=$TotalSkor+$JumlahSkor;
                    }
                    $Total=$Total+$TotalSkor;
                }
                $JumlahSkor=round($Total,2);
                if($JumlahSkor>90){
                    $Rekomendasi="Sangat Memuaskan";
                }else{
                    if($JumlahSkor>80){
                        $Rekomendasi="Memuaskan, Memimpin perubahan, berkinerja tinggi, dan sangat akuntabel";
                    }else{
                        if($JumlahSkor>70){
                            $Rekomendasi="Sangat Baik, Akuntabel, berkinerja baik, memiliki sistem manajemen Kinerja yang andal.";
                        }else{
                            if($JumlahSkor>60){
                                $Rekomendasi="Baik, Akuntabilitas Kinerjanya sudah baik, memiliki sistem yang dapat digunakan untuk manajemen Kinerja, dan perlu sedikit perbaikan.";
                            }else{
                                if($JumlahSkor>50){
                                    $Rekomendasi="Cukup (Memadai), Akuntabilitas Kinerjanya cukup baik, taat kebijakan, memiliki sistem yang dapat digunakan untuk memproduksi informasi Kinerja untuk pertanggung jawaban, perlu banyak perbaikan tidak mendasar.";
                                }else{
                                    if($JumlahSkor>30){
                                        $Rekomendasi="Kurang, Sistem dan tatanan kurang dapat diandalkan, memiliki sistem untuk manajemen Kinerja tapi perlu banyak perbaikan minor dan perbaikan yang mendasar.";
                                    }else{
                                        if($JumlahSkor<=30){
                                            $Rekomendasi="Sangat Kurang, Sistem dan tatanan tidak dapat diandalkan untuk penerapan manajemen Kinerja, perlu banyak perbaikan, sebagian perubahan yang sangat mendasar.";
                                        }else{
                                            $Rekomendasi="Sangat Kurang, Sistem dan tatanan tidak dapat diandalkan untuk penerapan manajemen Kinerja, perlu banyak perbaikan, sebagian perubahan yang sangat mendasar.";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                //Cek Keberadaan Data Rekap
                $DataRekap = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'"));
                if(empty($DataRekap)){
                    //Creat
                    $entry="INSERT INTO evaluasi_rekap (
                        id_evaluasi,
                        id_wilayah,
                        skor,
                        rekomendasi,
                        status,
                        updatetime
                    ) VALUES (
                        '$id_evaluasi',
                        '$id_wilayah',
                        '$JumlahSkor',
                        '$Rekomendasi',
                        'Selesai',
                        '$now'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                }else{
                    //Update
                    $Input = mysqli_query($Conn,"UPDATE evaluasi_rekap SET 
                        skor='$JumlahSkor',
                        rekomendasi='$Rekomendasi',
                        status='Selesai',
                        updatetime='$now'
                    WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'") or die(mysqli_error($Conn)); 
                }
                if($Input){
                    //Lakukan Update Ke semua evaluasi_jawaban
                    $UpdateEvaluasiJawaban = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                        status='Selesai',
                        updatetime='$now'
                    WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND status='Verifikasi'") or die(mysqli_error($Conn)); 
                    if($UpdateEvaluasiJawaban){
                        $_SESSION['NotifikasiSwal']="Rekap Evaluasi Berhasil";
                        echo '<small class="text-success" id="NotifikasiRekapEvaluasiBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat update status jawaban</small>';
                    }
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat input data rekap</small>';
                }
            }
        }
    }
?>