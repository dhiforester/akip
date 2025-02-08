<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses'])){
        echo '<code class="text-danger">ID Akses tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_akses=$_POST['id_akses'];
        $foto=getDataDetail($Conn,'akses','id_akses',$id_akses,'foto');
        //Proses hapus data
        $HapusAkses = mysqli_query($Conn, "DELETE FROM akses WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
        if ($HapusAkses) {
            $HapusIjinAkses = mysqli_query($Conn, "DELETE FROM akses_ijin WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            if($HapusIjinAkses){
                if(empty($foto)){
                    $HapusFoto="Berhasil";
                }else{
                    $url_foto='../../assets/img/User/'.$foto.'';
                    if(file_exists($url_foto)) {
                        if (unlink($url_foto)) {
                            $HapusFoto="Berhasil";
                        } else {
                            $HapusFoto="Hapus File Foto Profil Gagal";
                        }
                    }else{
                        $HapusFoto="Berhasil";
                    }
                }
                if($HapusFoto!=="Berhasil"){
                    echo '<code class="text-danger">'.$HapusFoto.'</code>';
                }else{
                    $kategori_log="Akses";
                    $deskripsi_log="Hapus Akses Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        echo '<code class="text-success" id="NotifikasiHapusAksesBerhasil">Success</code>';
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                    }
                }
            }else{
                echo '<code class="text-danger">Hapus Data Ijin Akses Gagal</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>