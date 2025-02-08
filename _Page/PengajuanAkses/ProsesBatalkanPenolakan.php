<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    $kategori_log="Akses";
    $deskripsi_log="Penolakan Pengajuan Akses Berhasil";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<code class="text-danger">ID Pengajuan Akses tidak boleh kosong</code>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        //Update Pada Database
        $UpdateAkses = mysqli_query($Conn,"UPDATE akses_pengajuan SET 
            status='Pengajuan'
        WHERE id_akses_pengajuan='$id_akses_pengajuan'") or die(mysqli_error($Conn)); 
        if($UpdateAkses){
            if(!empty($kirim_email)){
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<code class="text-success" id="NotifikasiBatalkanPenolakanBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                }
            }else{
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<code class="text-success" id="NotifikasiBatalkanPenolakanBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                }
            }
            
        }else{
            echo '<code class="text-danger">Update Status Penolakan Gagal!</code>';
        }
    }
?>