<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_file_store tidak boleh kosong
    if(empty($_POST['id_file_store'])){
        echo '<span class="text-danger">ID File Store Bukti tidak boleh kosong</span>';
    }else{
        $id_file_store=$_POST['id_file_store'];
        //Update
        $Update = mysqli_query($Conn,"UPDATE file_store SET 
            kunci='Tidak'
        WHERE id_file_store='$id_file_store'") or die(mysqli_error($Conn)); 
        if($Update){
            $kategori_log="Evaluasi Desa";
            $deskripsi_log="Buka Kunci File Berhasil";
            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
            if($InputLog=="Success"){
                $_SESSION['NotifikasiSwal']="Buka Kunci Berhasil";
                echo '<small class="text-success" id="NotifikasiBukaKunciBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
            }
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
        }
    }
?>