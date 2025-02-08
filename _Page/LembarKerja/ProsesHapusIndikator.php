<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_capaian tidak boleh kosong
    if(empty($_POST['id_capaian'])){
        echo '<code class="text-danger">ID Capaian Perjanjian Kinerja tidak boleh kosong</code>';
    }else{
        $id_capaian=$_POST['id_capaian'];
        //Validasi Id perjanjian_kinerja Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_capaian)){
            echo '<code class="text-danger">ID Perjanjian Kinerja Hanya Boleh Angka</code>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM capaian WHERE id_capaian='$id_capaian'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_capaian'])){
                echo '<code class="text-danger">ID Capaian Perjanjian Kinerja Tidak Ditemukan Pada Database</code>';
            }else{
                if(!empty($Data['dokumen'])){
                    $dokumen=$Data['dokumen'];
                    $url='../../assets/img/Bukti/'.$dokumen.'';
                    if(file_exists($url)) {
                        if (unlink($url)) {
                            $ProsesHapus="Berhasil";
                        } else {
                            $ProsesHapus="Hapus File Gagal";
                        }
                    }else{
                        $ProsesHapus="Berhasil";
                    }
                }else{
                    $ProsesHapus="Berhasil";
                }
                if($ProsesHapus=="Berhasil"){
                    $HapusCapaian = mysqli_query($Conn, "DELETE FROM capaian WHERE id_capaian='$id_capaian'") or die(mysqli_error($Conn));
                    if($HapusCapaian){
                        $kategori_log="Capaian Perjanjian Kinerja";
                        $deskripsi_log="Hapus Capaian Berhasil";
                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                        if($InputLog=="Success"){
                            $_SESSION['NotifikasiSwal']="Hapus Capaian Kinerja Berhasil";
                            echo '<small class="text-success" id="NotifikasiHapusIndikatorBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                        }
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data perjanjian kinerja </code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menghapus file</code>';
                }
            }
        }
    }
?>