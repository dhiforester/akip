<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<code class="text-danger">ID Pengajuan Akses tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        //Proses hapus data
        $HapusAkses = mysqli_query($Conn, "DELETE FROM akses_pengajuan WHERE id_akses_pengajuan='$id_akses_pengajuan'") or die(mysqli_error($Conn));
        if ($HapusAkses) {
            echo '<code class="text-success" id="NotifikasiHapusPengajuanAksesBerhasil">Success</code>';
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>