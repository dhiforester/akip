<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_anggaran tidak boleh kosong
    if(empty($_POST['id_anggaran'])){
        echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
    }else{
        //Validasi Kepala Desa tidak boleh kosong
        if(empty($_POST['kepala_desa'])){
            echo '<small class="text-danger">Kepala desa tidak boleh kosong</small>';
        }else{
            //Validasi sekretaris_desa tidak boleh kosong
            if(empty($_POST['sekretaris_desa'])){
                echo '<small class="text-danger">Sekretaris Desa tidak boleh kosong</small>';
            }else{
                $id_anggaran=$_POST['id_anggaran'];
                $kepala_desa=$_POST['kepala_desa'];
                $sekretaris_desa=$_POST['sekretaris_desa'];
                $UpdateAnggaran = mysqli_query($Conn,"UPDATE anggaran SET 
                    kepala_desa='$kepala_desa',
                    sekretaris_desa='$sekretaris_desa'
                WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn)); 
                if($UpdateAnggaran){
                    $kategori_log="Anggaran";
                    $deskripsi_log="Edit Anggaran Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        echo '<small class="text-success" id="NotifikasiEditAnggaranBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                    }
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data ke dalam database</small>';
                }
            }
        }
    }
?>