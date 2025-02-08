<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_rpjmdes tidak boleh kosong
    if(empty($_POST['id_rpjmdes'])){
        echo '<code class="text-danger">ID RPJMDES tidak boleh kosong</code>';
    }else{
        $id_rpjmdes=$_POST['id_rpjmdes'];
        //Validasi Id Evaluasi Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_rpjmdes)){
            echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
        }else{
            $UpdateRpjmdes = mysqli_query($Conn,"UPDATE rpjmdes SET 
                status='Request',
                updatetime='$now'
            WHERE id_rpjmdes='$id_rpjmdes'") or die(mysqli_error($Conn)); 
            if($UpdateRpjmdes){
                $kategori_log="RPJMDES";
                $deskripsi_log="Update RPJMDES Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Update RPJMDES Berhasil";
                    echo '<small class="text-success" id="NotifikasiKirimRpjmdesBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>