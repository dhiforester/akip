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
        //Validasi Id RPJMDES Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_rpjmdes)){
            echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
        }else{
            //Validasi Keberadaan Data
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                echo '<code class="text-danger">ID RPJMDES Tidak Ditemukan Pada Database</code>';
            }else{
                if(!empty($DataRpjmdes['dokumen'])){
                    $dokumen=$DataRpjmdes['dokumen'];
                    $url='../../assets/img/RPJMDES/'.$dokumen.'';
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
                    $HapusRpjmdes = mysqli_query($Conn, "DELETE FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes'") or die(mysqli_error($Conn));
                    if($HapusRpjmdes){
                        $HapusRincianRpjmdes = mysqli_query($Conn, "DELETE FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes'") or die(mysqli_error($Conn));
                        if($HapusRincianRpjmdes){
                            $kategori_log="RPJMDES";
                            $deskripsi_log="Hapus RPJMDES Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Hapus RPJMDES Berhasil";
                                echo '<small class="text-success" id="NotifikasiHapusRpjmdesBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data Rincian RPJMDES </code>';
                        }
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data RPJMDES </code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menghapus file</code>';
                }
            }
        }
    }
?>