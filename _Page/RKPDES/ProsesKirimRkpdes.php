<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_rkpdes tidak boleh kosong
    if(empty($_POST['id_rkpdes'])){
        echo '<code class="text-danger">ID RKPDES tidak boleh kosong</code>';
    }else{
        $id_rkpdes=$_POST['id_rkpdes'];
        //Validasi Id Evaluasi Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_rkpdes)){
            echo '<code class="text-danger">ID RKPDES Hanya Boleh Angka</code>';
        }else{
            $Update = mysqli_query($Conn,"UPDATE rkpdes SET 
                status='Request',
                updatetime='$now'
            WHERE id_rkpdes='$id_rkpdes'") or die(mysqli_error($Conn)); 
            if($Update){
                $kategori_log="RKPDES";
                $deskripsi_log="Update RKPDES Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Update RKPDES Berhasil";
                    echo '<small class="text-success" id="NotifikasiKirimRkpdesBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>