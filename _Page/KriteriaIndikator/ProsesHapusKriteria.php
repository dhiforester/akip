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
        echo '  Id Bidang Kegiatan Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
        $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
        //Kondisi Masing-masing Level
        if($level=="Level 1"){
            $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
            $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator WHERE level_1='$level_1'") or die(mysqli_error($Conn));
        }else{
            if($level=="Level 2"){
                $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                $level_2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'") or die(mysqli_error($Conn));
            }else{
                if($level=="Level 3"){
                    $level_1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                    $level_2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                    $level_3=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_3');
                    $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator WHERE level_3='$level_3' AND level_2='$level_2' AND level_1='$level_1'") or die(mysqli_error($Conn));
                }else{
                    if($level=="Level 4"){
                        $level_4=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_4');
                        $Hapus = mysqli_query($Conn, "DELETE FROM kriteria_indikator WHERE id_kriteria_indikator='$id_kriteria_indikator'") or die(mysqli_error($Conn));
                    }else{
                        $Hapus = "";
                    }
                }
            }
        }
        if($Hapus){
            $kategori_log="Kriteria Indikator";
            $deskripsi_log="Hapus Kriteria Indikator Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                echo '<small class="text-success" id="NotifikasiHapusKriteriaBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
            }
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
        }
    }
?>