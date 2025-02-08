<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_struktur_organisasi'])){
        echo '<code class="text-danger">ID tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_struktur_organisasi=$_POST['id_struktur_organisasi'];
        $foto=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'foto');
        //Proses hapus data
        $HapusStrukturOrganisasi = mysqli_query($Conn, "DELETE FROM struktur_organisasi WHERE id_struktur_organisasi='$id_struktur_organisasi'") or die(mysqli_error($Conn));
        if ($HapusStrukturOrganisasi) {
            if(empty($foto)){
                $HapusFoto="Berhasil";
            }else{
                $url_foto='../../assets/img/so/'.$foto.'';
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
                $kategori_log="Struktur Organisasi";
                $deskripsi_log="Hapus Struktur Organisasi Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Hapus Struktur Organisasi Berhasil";
                    echo '<code class="text-success" id="NotifikasiHapusStrukturOrganisasiBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                }
            }
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>