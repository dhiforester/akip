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
        //Validasi Id APBDES Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_apbdes)){
            echo '<code class="text-danger">ID APBDES Hanya Boleh Angka</code>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_apbdes='$id_apbdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_apbdes'])){
                echo '<code class="text-danger">ID APBDES Tidak Ditemukan Pada Database</code>';
            }else{
                if(!empty($Data['dokumen'])){
                    $dokumen=$Data['dokumen'];
                    $url='../../assets/img/APBDES/'.$dokumen.'';
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
                    $HapusApbdes = mysqli_query($Conn, "DELETE FROM apbdes WHERE id_apbdes='$id_apbdes'") or die(mysqli_error($Conn));
                    if($HapusApbdes){
                        $HapusRincian = mysqli_query($Conn, "DELETE FROM apbdes_rincian WHERE id_apbdes='$id_apbdes'") or die(mysqli_error($Conn));
                        if($HapusRincian){
                            $kategori_log="APBDES";
                            $deskripsi_log="Hapus APBDES Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Hapus APBDES Berhasil";
                                echo '<small class="text-success" id="NotifikasiHapusApbdesBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data Rincian APBDES </code>';
                        }
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data APBDES </code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menghapus file</code>';
                }
            }
        }
    }
?>