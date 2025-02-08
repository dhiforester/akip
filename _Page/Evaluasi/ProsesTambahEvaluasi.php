<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi periode tidak boleh kosong
    if(empty($_POST['periode'])){
        echo '<small class="text-danger">Periode tidak boleh kosong</small>';
    }else{
        //Validasi periode_awal tidak boleh kosong
        if(empty($_POST['periode_awal'])){
            echo '<small class="text-danger">Periode Awal tidak boleh kosong</small>';
        }else{
            //Validasi periode_akhir tidak boleh kosong
            if(empty($_POST['periode_akhir'])){
                echo '<small class="text-danger">Periode Akhir tidak boleh kosong</small>';
            }else{
                $periode=$_POST['periode'];
                $periode_awal=$_POST['periode_awal'];
                $periode_akhir=$_POST['periode_akhir'];
                if($periode_akhir<$periode_awal){
                    echo '<small class="text-danger">Periode awal tidak boleh lebih besar dari periode akhir</small>';
                }else{
                    if(strlen($periode)>20) {
                        echo '<small class="text-danger">Judul Periode Evaluasi Tidak Boleh Lebih Dari 20 Karakter</small>';
                    }else{
                        $entry="INSERT INTO evaluasi (
                            periode,
                            periode_awal,
                            periode_akhir,
                            updatetime
                        ) VALUES (
                            '$periode',
                            '$periode_awal',
                            '$periode_akhir',
                            '$now'
                        )";
                        $Input=mysqli_query($Conn, $entry);
                        if($Input){
                            $kategori_log="Evaluasi";
                            $deskripsi_log="Tambah Evaluasi Baru Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                echo '<small class="text-success" id="NotifikasiTambahEvaluasiBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>