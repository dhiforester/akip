<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_penduduk'])){
        echo '<code class="text-danger">ID Penduduk tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_penduduk=$_POST['id_penduduk'];
        //Proses hapus data
        $HapusPenduduk = mysqli_query($Conn, "DELETE FROM penduduk WHERE id_penduduk='$id_penduduk'") or die(mysqli_error($Conn));
        if($HapusPenduduk) {
            $kategori_log="Penduduk";
            $deskripsi_log="Hapus Penduduk Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                echo '<code class="text-success" id="NotifikasiHapusPendudukBerhasil">Success</code>';
            }else{
                echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Penduduk Gagal</code>';
        }
    }
?>