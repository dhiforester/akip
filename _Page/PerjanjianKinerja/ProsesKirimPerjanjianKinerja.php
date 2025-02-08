<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_perjanjian_kinerja tidak boleh kosong
    if(empty($_POST['id_perjanjian_kinerja'])){
        echo '<code class="text-danger">ID Perjanjian Kinerja tidak boleh kosong</code>';
    }else{
        $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
        //Validasi Id Evaluasi Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_perjanjian_kinerja)){
            echo '<code class="text-danger">ID Perjanjian Kinerja Hanya Boleh Angka</code>';
        }else{
            $Update = mysqli_query($Conn,"UPDATE perjanjian_kinerja SET 
                status='Request',
                updatetime='$now'
            WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'") or die(mysqli_error($Conn)); 
            if($Update){
                $kategori_log="Perjanjian Kinerja";
                $deskripsi_log="Update Perjanjian Kinerja Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Update Perjanjian Kinerja Berhasil";
                    echo '<small class="text-success" id="NotifikasiKirimPerjanjianKinerjaBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>