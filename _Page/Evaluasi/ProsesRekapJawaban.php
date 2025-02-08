<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    $now=date('Y-m-d H:i:s');
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['id_evaluasi'])){
        echo '<small class="credit text-danger">ID Evaluasi Tidak Boleh Kosong</small>';
    }else{
        if(empty($_POST['id_wilayah'])){
            echo '<small class="credit text-danger">ID Wilayah Tidak Boleh Kosong</small>';
        }else{
            if(empty($_POST['skor'])){
                echo '<small class="credit text-danger">Skor Tidak Boleh Kosong</small>';
            }else{
                if(empty($_POST['status'])){
                    echo '<small class="credit text-danger">Status Tidak Boleh Kosong</small>';
                }else{
                    if(empty($_POST['rekomendasi'])){
                        echo '<small class="credit text-danger">Rekomendasi Tidak Boleh Kosong</small>';
                    }else{
                        $id_evaluasi=$_POST['id_evaluasi'];
                        $id_wilayah=$_POST['id_wilayah'];
                        $skor=$_POST['skor'];
                        $status=$_POST['status'];
                        $rekomendasi=$_POST['rekomendasi'];
                        //Cek Apakah Data Sudah Ada
                        $QryRekap = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah'")or die(mysqli_error($Conn));
                        $DataRekap = mysqli_fetch_array($QryRekap);
                        if(empty($DataRekap['id_evaluasi_rekap'])){
                            //Insert
                            $entry="INSERT INTO evaluasi_rekap (
                                id_evaluasi,
                                id_wilayah,
                                skor,
                                rekomendasi,
                                status
                            ) VALUES (
                                '$id_evaluasi',
                                '$id_wilayah',
                                '$skor',
                                '$rekomendasi',
                                '$status'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $kategori_log="Evaluasi";
                                $deskripsi_log="Tambah Rekap Evaluasi Berhasil";
                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                if($InputLog=="Success"){
                                    $ValidasiProses="Success";
                                }else{
                                    $ValidasiProses="Terjadi kesalahan pada saat menyimpan Log";
                                }
                            }
                        }else{
                            $id_evaluasi_rekap=$DataRekap['id_evaluasi_rekap'];
                            //Update
                            $Upadte = mysqli_query($Conn,"UPDATE evaluasi_rekap SET 
                                id_evaluasi='$id_evaluasi',
                                id_wilayah='$id_wilayah',
                                skor='$skor',
                                rekomendasi='$rekomendasi',
                                status='$status'
                            WHERE id_evaluasi_rekap='$id_evaluasi_rekap'") or die(mysqli_error($Conn)); 
                            if($Upadte){
                                $kategori_log="Evaluasi";
                                $deskripsi_log="Tambah Rekap Evaluasi Berhasil";
                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                if($InputLog=="Success"){
                                    $ValidasiProses="Success";
                                }else{
                                    $ValidasiProses="Terjadi kesalahan pada saat menyimpan Log";
                                }
                            }
                        }
                        if($ValidasiProses=="Success"){
                            $_SESSION['NotifikasiSwal']="Update Rekapitulasi Berhasil";
                            echo '<small class="text-success" id="NotifikasiRekapJawabanBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">'.$ValidasiProses.'</small>';
                        }
                    }
                }
            }
        }
    }
?>