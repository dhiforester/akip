<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_api_key'])){
        echo '<code class="credit text-danger">ID API Key Tidak Boleh Kosong</code>';
    }else{
        $id_api_key=$_POST['id_api_key'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM api_key WHERE id_api_key='$id_api_key'") or die(mysqli_error($Conn));
        if ($query) {
            $kategori_log="API Key";
            $deskripsi_log="Hapus Api Key Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                echo '<span class="text-success" id="NotifikasiHapusApiKeyBerhasil">Success</span>';
            }else{
                echo '<small class="credit text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
            }
            
        }else{
            echo '<span class="text-danger">Clear Data Fail</span>';
        }
    }
?>