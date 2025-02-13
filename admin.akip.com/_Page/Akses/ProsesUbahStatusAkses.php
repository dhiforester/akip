<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Id Akses
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Validasi Password tidak boleh kosong
        if(empty($_POST['status_edit'])){
            echo '<small class="text-danger">Status akses tidak boleh kosong</small>';
        }else{     
            $status_edit=$_POST['status_edit'];     
            $UpdateStatusAkses = mysqli_query($Conn,"UPDATE akses SET 
                status='$status_edit',
                datetime_update='$now'
            WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
            if($UpdateStatusAkses){
                $id_mitra=0;
                $KategoriLog="Akses";
                $KeteranganLog="Ubah Status Akses";
                include "../../_Config/InputLog.php";
                echo '<small class="text-success" id="NotifikasiUbahStatusAksesBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>