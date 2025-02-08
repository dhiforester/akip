<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['kode'])){
        echo '<small class="credit text-danger">';
        echo '  Kode Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        if(empty($_POST['level'])){
            echo '<small class="credit text-danger">';
            echo '  Level Tidak Boleh Kosong!';
            echo '</small>';
        }else{
            if(empty($_POST['teks'])){
                echo '<small class="credit text-danger">';
                echo '  Text Kriteria/Indikator Tidak Boleh Kosong!';
                echo '</small>';
            }else{
                $kode=$_POST['kode'];
                $level=$_POST['level'];
                $teks=$_POST['teks'];
                if($level=="Level 1"){
                    $kode=$kode;
                    $level_1=$kode;
                    $level_2="";
                    $level_3="";
                    $level_4="";
                    $teks=$teks;
                    $alternatif="";
                    $keterangan="";
                    $bobot="0";
                    $ValidasiKelengkapan="Success";
                }else{
                    if($level=="Level 2"){
                        if(empty($_POST['level_1'])){
                            $ValidasiKelengkapan="Indikator Tidak Boleh Kosong";
                        }else{
                            $level_1=$_POST['level_1'];
                            $level_2=$kode;
                            $level_3="";
                            $level_4="";
                            $teks=$teks;
                            $alternatif="";
                            $keterangan="";
                            $bobot="0";
                            $kode="$level_1.$level_2";
                            $ValidasiKelengkapan="Success";
                        }
                    }else{
                        if($level=="Level 3"){
                            if(empty($_POST['level_1'])){
                                $ValidasiKelengkapan="Indikator Tidak Boleh Kosong";
                            }else{
                                if(empty($_POST['level_2'])){
                                    $ValidasiKelengkapan="Sub Indikator Tidak Boleh Kosong";
                                }else{
                                    if(empty($_POST['bobot'])){
                                        $ValidasiKelengkapan="Bobot Kriteria Tidak Boleh Kosong";
                                    }else{
                                        $level_1=$_POST['level_1'];
                                        $level_2=$_POST['level_2'];
                                        $level_3=$kode;
                                        $level_4="";
                                        $teks=$teks;
                                        $alternatif="";
                                        $keterangan="";
                                        $bobot=$_POST['bobot'];
                                        $kode="$level_1.$level_2.$level_3";
                                        $ValidasiKelengkapan="Success";
                                    }
                                }
                            }
                        }else{
                            if($level=="Level 4"){
                                if(empty($_POST['level_1'])){
                                    $ValidasiKelengkapan="Indikator Tidak Boleh Kosong";
                                }else{
                                    if(empty($_POST['level_2'])){
                                        $ValidasiKelengkapan="Sub Indikator Tidak Boleh Kosong";
                                    }else{
                                        if(empty($_POST['level_3'])){
                                            $ValidasiKelengkapan="Kriteria Tidak Boleh Kosong";
                                        }else{
                                            if(empty($_POST['alt_char'])){
                                                $ValidasiKelengkapan="Alternatif Jawaban Tidak Boleh Kosong";
                                            }else{
                                                if(empty($_POST['alt_label'])){
                                                    $ValidasiKelengkapan="Label Alternatif Jawaban Tidak Boleh Kosong";
                                                }else{
                                                    if(empty($_POST['alt_nilai'])){
                                                        $ValidasiKelengkapan="Nilai Alternatif Jawaban Tidak Boleh Kosong";
                                                    }else{
                                                        //Membuat JSON
                                                        $alt_char=$_POST['alt_char'];
                                                        $alt_label=$_POST['alt_label'];
                                                        $alt_nilai=$_POST['alt_nilai'];
                                                        if(empty($_POST['keterangan'])){
                                                            $keterangan="";
                                                        }else{
                                                            $keterangan=$_POST['keterangan'];
                                                        }
                                                        //Validasi nilai
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
                                                            $level_1=$_POST['level_1'];
                                                            $level_2=$_POST['level_2'];
                                                            $level_3=$_POST['level_3'];
                                                            $level_4=$kode;
                                                            $teks=$teks;
                                                            $alternatif=$json_output;
                                                            $bobot="0";
                                                            $kode="$level_1.$level_2.$level_3.$level_4";
                                                            $ValidasiKelengkapan="Success";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                $ValidasiKelengkapan="Level Data Tidak Diketahui";
                            }
                        }
                    }
                }
                if($ValidasiKelengkapan!=="Success"){
                    echo '<small class="credit text-danger">';
                    echo '  '.$ValidasiKelengkapan.'';
                    echo '</small>';
                }else{
                    $entry="INSERT INTO kriteria_indikator (
                        kode,
                        level,
                        level_1,
                        level_2,
                        level_3,
                        level_4,
                        teks,
                        alternatif,
                        keterangan,
                        bobot
                    ) VALUES (
                        '$kode',
                        '$level',
                        '$level_1',
                        '$level_2',
                        '$level_3',
                        '$level_4',
                        '$teks',
                        '$alternatif',
                        '$keterangan',
                        '$bobot'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                    if($Input){
                        $kategori_log="Kriteria Indikator";
                        $deskripsi_log="Tambah Kriteria Indikator Berhasil";
                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                        if($InputLog=="Success"){
                            echo '<small class="text-success" id="NotifikasiTambahKriteriaIndikatorBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                        }
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>