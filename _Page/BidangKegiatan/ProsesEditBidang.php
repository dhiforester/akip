<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_bidang_kegiatan'])){
        echo '<small class="credit text-danger">';
        echo '  Id Bidang Kegiatan Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        if(empty($_POST['nama'])){
            echo '<small class="credit text-danger">';
            echo '  Nama Bidang/Kegiatan Tidak Boleh Kosong!';
            echo '</small>';
        }else{
            $id_bidang_kegiatan=$_POST['id_bidang_kegiatan'];
            $nama=$_POST['nama'];
            $UpdateBidangKegiatan = mysqli_query($Conn,"UPDATE bidang_kegiatan SET 
                    nama='$nama'
            WHERE id_bidang_kegiatan='$id_bidang_kegiatan'") or die(mysqli_error($Conn)); 
            if($UpdateBidangKegiatan){
                $kategori_log="Bidang Kegiatan";
                $deskripsi_log="Edit Bidang Kegiatan Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<small class="text-success" id="NotifikasiEditBidangBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>