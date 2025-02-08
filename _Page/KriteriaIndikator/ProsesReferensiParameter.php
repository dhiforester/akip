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
        echo '<b class="text-danger">ID Kriteria Tidak Boleh Kosong!</b>';
    }else{
        $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
        if(empty($_POST['id_referensi_bukti'])){
            //Hapus Semua
            $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator_ref WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn));
            if($Hapus){
                echo '<b class="text-success" id="NotifikasiReferensiParameterBerhasil">Success</b>';
            }else{
                echo '<b class="text-danger">Terjadi kesalahan pada saat menghapus data!</b>';
            }
        }else{
            $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator_ref WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn));
            if($Hapus){
                $id_referensi_bukti=$_POST['id_referensi_bukti'];
                $JumlahDataSeharusnya=count($id_referensi_bukti);
                $JumlahDataBerhasil=0;
                foreach($id_referensi_bukti as $ListReferensiBukti){
                    //Input Data
                    $entry="INSERT INTO kriteria_indikator_ref (
                        id_kriteria_indikator,
                        id_referensi_bukti
                    ) VALUES (
                        '$id_kriteria_indikator',
                        '$ListReferensiBukti'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                    if($Input){
                        $JumlahDataBerhasil=$JumlahDataBerhasil+1;
                    }else{
                        $JumlahDataBerhasil=$JumlahDataBerhasil+0;
                    }
                }
                if($JumlahDataBerhasil==$JumlahDataSeharusnya){
                    echo '<b class="text-success" id="NotifikasiReferensiParameterBerhasil">Success</b>';
                }else{
                    echo '<b class="text-danger">Terjadi kesalahan pada saat menyimpan data!</b>';
                }
            }else{
                echo '<b class="text-danger">Terjadi kesalahan pada saat menghapus data!</b>';
            }
        }
    }
?>