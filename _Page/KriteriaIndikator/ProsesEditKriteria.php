<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_kriteria_indikator'])){
        echo '<small class="credit text-danger">';
        echo '  ID Kriteria Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        if(empty($_POST['kode'])){
            echo '<small class="credit text-danger">';
            echo '  Kode Tidak Boleh Kosong!';
            echo '</small>';
        }else{
            if(empty($_POST['teks'])){
                echo '<small class="credit text-danger">';
                echo '  Text Kriteria/Indikator Tidak Boleh Kosong!';
                echo '</small>';
            }else{
                if(empty($_POST['level'])){
                    echo '<small class="credit text-danger">';
                    echo '  Level Kriteria/Indikator Tidak Boleh Kosong!';
                    echo '</small>';
                }else{
                    $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
                    $kode=$_POST['kode'];
                    $teks=$_POST['teks'];
                    $level=$_POST['level'];
                    //Cari Level
                    if($level=="Level 1"){
                        $kode="$kode";
                        $level_1=$kode;
                        $teks=$teks;
                        $Update = mysqli_query($Conn,"UPDATE kriteria_indikator SET 
                                kode='$kode',
                                level_1='$kode',
                                teks='$teks'
                        WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn)); 
                        if($Update){
                            $ValidasiUpdate ="Success";
                        }else{
                            $ValidasiUpdate ="Terjadi Kesalahan Pada Saat Menyimpan Data";
                        }
                    }else{
                        if($level=="Level 2"){
                            $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                            $level_2=$kode;
                            $teks=$teks;
                            $alternatif="";
                            $bobot="0";
                            $kode="$level_1.$level_2";
                            $Update = mysqli_query($Conn,"UPDATE kriteria_indikator SET 
                                kode='$kode',
                                level_2='$level_2',
                                teks='$teks'
                            WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn)); 
                            if($Update){
                                $ValidasiUpdate ="Success";
                            }else{
                                $ValidasiUpdate ="Terjadi Kesalahan Pada Saat Menyimpan Data";
                            }
                        }else{
                            if($level=="Level 3"){
                                if(empty($_POST['bobot'])){
                                    $ValidasiUpdate ="Bobot Tidak Boleh Kosong";
                                }else{
                                    $bobot=$_POST['bobot'];
                                    $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                                    $level_2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                                    $level_3=$kode;
                                    $kode="$level_1.$level_2.$level_3";
                                    $Update = mysqli_query($Conn,"UPDATE kriteria_indikator SET 
                                        kode='$kode',
                                        level_3='$level_3',
                                        teks='$teks',
                                        bobot='$bobot'
                                    WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn)); 
                                    if($Update){
                                        $ValidasiUpdate ="Success";
                                    }else{
                                        $ValidasiUpdate ="Terjadi Kesalahan Pada Saat Menyimpan Data";
                                    }
                                }
                            }else{
                                if($level=="Level 4"){
                                    if(empty($_POST['alt_char'])){
                                        $ValidasiUpdate="Alternatif Jawaban Tidak Boleh Kosong";
                                    }else{
                                        if(empty($_POST['alt_label'])){
                                            $ValidasiUpdate="Label Alternatif Jawaban Tidak Boleh Kosong";
                                        }else{
                                            if(empty($_POST['alt_nilai'])){
                                                $ValidasiUpdate="Nilai Alternatif Jawaban Tidak Boleh Kosong";
                                            }else{
                                                if(empty($_POST['keterangan'])){
                                                    $keterangan="";
                                                }else{
                                                    $keterangan=$_POST['keterangan'];
                                                }
                                                //Membuat JSON
                                                $alt_char=$_POST['alt_char'];
                                                $alt_label=$_POST['alt_label'];
                                                $alt_nilai=$_POST['alt_nilai'];
                                                $jumlah_data=count($alt_char);
                                                //Mencari Nilai Yang Tidak Valid
                                                $JumlahNilaiTidakValid=0;
                                                for ($i = 0; $i < $jumlah_data; $i++) {
                                                    if(!preg_match('/^[0-9]+(\.[0-9]+)?$/', $alt_nilai[$i])){
                                                        $JumlahNilaiTidakValid=$JumlahNilaiTidakValid+1;
                                                    }else{
                                                        $JumlahNilaiTidakValid=$JumlahNilaiTidakValid+0;
                                                    }
                                                }
                                                if(!empty($JumlahNilaiTidakValid)){
                                                    $ValidasiKelengkapan="Nilai Alternatif Jawaban Hanya Boleh Angka Bilangan Bulat Atau Desimal";
                                                }else{
                                                    $json_list = array();
                                                    for ($i = 0; $i < $jumlah_data; $i++) {
                                                        $json_list[] = array(
                                                            "char" => $alt_char[$i],
                                                            "label" => $alt_label[$i],
                                                            "nilai" => $alt_nilai[$i]
                                                        );
                                                    }
                                                    $json_output = json_encode($json_list);
                                                    $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                                                    $level_2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                                                    $level_3=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_3');
                                                    $level_4=$kode;
                                                    $kode="$level_1.$level_2.$level_3.$level_4";
                                                    $alternatif=$json_output;
                                                    $Update = mysqli_query($Conn,"UPDATE kriteria_indikator SET 
                                                        kode='$kode',
                                                        level_4='$level_4',
                                                        teks='$teks',
                                                        alternatif='$alternatif',
                                                        keterangan='$keterangan'
                                                    WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn)); 
                                                    if($Update){
                                                        $ValidasiUpdate ="Success";
                                                    }else{
                                                        $ValidasiUpdate ="Terjadi Kesalahan Pada Saat Menyimpan Data";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }else{
                                    $ValidasiUpdate="Level Data Tidak Diketahui";
                                }
                            }
                        }
                    }
                    if($ValidasiUpdate!=="Success"){
                        echo '<small class="credit text-danger">';
                        echo '  '.$ValidasiKelengkapan.'';
                        echo '</small>';
                    }else{
                        $kategori_log="Kriteria Indikator";
                        $deskripsi_log="Edit Kriteria Indikator Berhasil";
                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                        if($InputLog=="Success"){
                            echo '<small class="text-success" id="NotifikasiEditKriteriaIndikatorBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                        }
                    }
                }
            }
        }
    }
?>