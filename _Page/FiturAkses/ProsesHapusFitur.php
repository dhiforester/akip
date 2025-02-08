<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses_fitur'])){
        echo '<code class="text-danger">ID Akses fitur tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_akses_fitur=$_POST['id_akses_fitur'];
        //Proses hapus data akses_fitur
        $HapusAksesFitur = mysqli_query($Conn, "DELETE FROM akses_fitur WHERE id_akses_fitur='$id_akses_fitur'") or die(mysqli_error($Conn));
        if ($HapusAksesFitur) {
            $HapusAksesIjin = mysqli_query($Conn, "DELETE FROM akses_ijin WHERE id_akses_fitur='$id_akses_fitur'") or die(mysqli_error($Conn));
            if($HapusAksesIjin){
                $kategori_log="Fitur Akses";
                $deskripsi_log="Hapus Fitur Akses Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<span class="text-success" id="NotifikasiHapusFiturBerhasil">Success</span>';
                }else{
                    echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan Log</span>';
                }
                
            }else{
                echo '<span class="text-danger">Hapus Data Ijin Akses Gagal</span>';
            }
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>