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
        //Validasi Id RKPDES Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_rkpdes)){
            echo '<code class="text-danger">ID RKPDES Hanya Boleh Angka</code>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_rkpdes'])){
                echo '<code class="text-danger">ID RKPDES Tidak Ditemukan Pada Database</code>';
            }else{
                if(!empty($Data['dokumen'])){
                    $dokumen=$Data['dokumen'];
                    $url='../../assets/img/RKPDES/'.$dokumen.'';
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
                    $HapusRkpdes = mysqli_query($Conn, "DELETE FROM rkpdes WHERE id_rkpdes='$id_rkpdes'") or die(mysqli_error($Conn));
                    if($HapusRkpdes){
                        $HapusRincian = mysqli_query($Conn, "DELETE FROM rkpdes_rincian WHERE id_rkpdes='$id_rkpdes'") or die(mysqli_error($Conn));
                        if($HapusRincian){
                            $kategori_log="RKPDES";
                            $deskripsi_log="Hapus RKPDES Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Hapus RKPDES Berhasil";
                                echo '<small class="text-success" id="NotifikasiHapusRkpdesBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data Rincian RKPDES </code>';
                        }
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data RKPDES </code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menghapus file</code>';
                }
            }
        }
    }
?>