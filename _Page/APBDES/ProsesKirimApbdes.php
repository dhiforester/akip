<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_apbdes tidak boleh kosong
    if(empty($_POST['id_apbdes'])){
        echo '<code class="text-danger">ID APBDES tidak boleh kosong</code>';
    }else{
        $id_apbdes=$_POST['id_apbdes'];
        //Validasi Id Evaluasi Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_apbdes)){
            echo '<code class="text-danger">ID APBDES Hanya Boleh Angka</code>';
        }else{
            $Update = mysqli_query($Conn,"UPDATE apbdes SET 
                status='Request',
                updatetime='$now'
            WHERE id_apbdes='$id_apbdes'") or die(mysqli_error($Conn)); 
            if($Update){
                $kategori_log="APBDES";
                $deskripsi_log="Update APBDES Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Update APBDES Berhasil";
                    echo '<small class="text-success" id="NotifikasiKirimApbdesBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>