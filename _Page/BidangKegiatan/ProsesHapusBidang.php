<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_bidang_kegiatan'])){
        echo '<small class="credit text-danger">';
        echo '  Id Bidang Kegiatan Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        $id_bidang_kegiatan=$_POST['id_bidang_kegiatan'];
        $kode=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'kode');
        $level=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'level');
        //Kondisi Masing-masing Level
        if($level=="Bidang"){
            $Hapus = mysqli_query($Conn, "DELETE FROM bidang_kegiatan WHERE kode_bidang='$kode'") or die(mysqli_error($Conn));
        }else{
            if($level=="Sub Bidang"){
                $Hapus = mysqli_query($Conn, "DELETE FROM bidang_kegiatan WHERE kode_sub_bidang='$kode'") or die(mysqli_error($Conn));
            }else{
                if($level=="Kegiatan"){
                    $Hapus = mysqli_query($Conn, "DELETE FROM bidang_kegiatan WHERE id_bidang_kegiatan='$id_bidang_kegiatan'") or die(mysqli_error($Conn));
                }else{
                    $Hapus = "";
                }
            }
        }
        if($Hapus){
            $kategori_log="Bidang Kegiatan";
            $deskripsi_log="Hapus Bidang Kegiatan Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                echo '<small class="text-success" id="NotifikasiHapusBidangBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
            }
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
        }
    }
?>