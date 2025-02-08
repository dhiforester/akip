<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_target_capaian'])){
        echo '<code class="text-danger">ID tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_target_capaian=$_POST['id_target_capaian'];
        //Proses hapus data
        $HhapusCapaianTarget = mysqli_query($Conn, "DELETE FROM target_capaian WHERE id_target_capaian='$id_target_capaian'") or die(mysqli_error($Conn));
        if ($HhapusCapaianTarget) {
            $kategori_log="Capaian Target";
            $deskripsi_log="Hapus Capaian Target Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                $_SESSION['NotifikasiSwal']="Hapus Capaian Target Berhasil";
                echo '<code class="text-success" id="NotifikasiHapusCapaianTargetBerhasil">Success</code>';
            }else{
                echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>