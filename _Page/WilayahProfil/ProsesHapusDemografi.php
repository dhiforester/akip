<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_wilayah_demografi'])){
        echo '<code class="text-danger">ID tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_wilayah_demografi=$_POST['id_wilayah_demografi'];
        //Proses hapus data
        $HapusDemografi = mysqli_query($Conn, "DELETE FROM wilayah_demografi WHERE id_wilayah_demografi='$id_wilayah_demografi'") or die(mysqli_error($Conn));
        if ($HapusDemografi) {
            $kategori_log="Demografi";
            $deskripsi_log="Hapus Demografi Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                $_SESSION['NotifikasiSwal']="Hapus Demografi Berhasil";
                echo '<code class="text-success" id="NotifikasiHapusDemografiBerhasil">Success</code>';
            }else{
                echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>