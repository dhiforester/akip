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
            if(empty($_FILES['dokumen_rpjmdes2']['name'])){
                echo '<code class="text-danger">Lampiran File RPJMDES tidak boleh kosong</code>';
            }else{
                //File Dokumen
                $NamaFile=$_FILES['dokumen_rpjmdes2']['name'];
                $UkuranFile = $_FILES['dokumen_rpjmdes2']['size']; 
                $TipeFile = $_FILES['dokumen_rpjmdes2']['type']; 
                $TmpFile = $_FILES['dokumen_rpjmdes2']['tmp_name'];
                //File Baru
                $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                $FileNameRand=$key;
                $Pecah = explode("." , $NamaFile);
                $BiasanyaNama=$Pecah[0];
                $Ext=$Pecah[1];
                $namabaru = "$FileNameRand.$Ext";
                $path = "../../assets/img/RPJMDES/".$namabaru;
                $allowedTypes = ['application/pdf'];
                //Buka Nama File Lama
                $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
                if(empty($DataRpjmdes['id_rpjmdes'])){
                    echo '<code class="text-danger">ID RPJMDES yang anda gunakan tidak valid</code>';
                }else{
                    $dokumen_lama=$DataRpjmdes['dokumen'];
                    if (!in_array($TipeFile, $allowedTypes)) {
                        echo '<code class="text-danger">File dokumen hanya boleh PDF</code>';
                    }else{
                        // Melakukan validasi ukuran file (maksimum 5MB)
                        $maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
                        if ($UkuranFile > $maxSize) {
                            echo '<code class="text-danger">File dokumen hanya boleh maksimal 5 mb</code>';
                        }else{
                            if(!move_uploaded_file($TmpFile, $path)){
                                echo '<code class="text-danger">Terjadi Kesalahan Pada Saat Upload File Dokumen</code>';
                            }else{
                                $UpdateRpjmdes = mysqli_query($Conn,"UPDATE rpjmdes SET 
                                    dokumen='$namabaru'
                                WHERE id_rpjmdes='$id_rpjmdes'") or die(mysqli_error($Conn)); 
                                if($UpdateRpjmdes){
                                    //Hapus Dokumen Lama
                                    $url='../../assets/img/RPJMDES/'.$dokumen_lama.'';
                                    if(file_exists($url)) {
                                        if (unlink($url)) {
                                            $ProsesHapus="Berhasil";
                                        } else {
                                            $ProsesHapus="Hapus File Gagal";
                                        }
                                    }else{
                                        $ProsesHapus="Berhasil";
                                    }
                                    if($ProsesHapus=="Berhasil"){
                                        $kategori_log="RPJMDES";
                                        $deskripsi_log="Update RPJMDES Berhasil";
                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                        if($InputLog=="Success"){
                                            $_SESSION['NotifikasiSwal']="Update RPJMDES Berhasil";
                                            echo '<small class="text-success" id="NotifikasiUploadUlangRpjmdesBerhasil">Success</small>';
                                        }else{
                                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                        }
                                    }else{
                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menghapus file lama</small>';
                                    }
                                }else{
                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>