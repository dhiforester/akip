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
        echo '<code class="text-danger">ID Capaian Kinerja tidak boleh kosong</code>';
    }else{
        $id_capaian=$_POST['id_capaian'];
        //Validasi Id Perjanjian Kinerja Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_capaian)){
            echo '<code class="text-danger">ID Capaian Kinerja Hanya Boleh Angka</code>';
        }else{
            if(empty($_FILES['dokumen']['name'])){
                echo '<code class="text-danger">Lampiran File RPJMDES tidak boleh kosong</code>';
            }else{
                //File Dokumen
                $NamaFile=$_FILES['dokumen']['name'];
                $UkuranFile = $_FILES['dokumen']['size']; 
                $TipeFile = $_FILES['dokumen']['type']; 
                $TmpFile = $_FILES['dokumen']['tmp_name'];
                //File Baru
                $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                $FileNameRand=$key;
                $Pecah = explode("." , $NamaFile);
                $BiasanyaNama=$Pecah[0];
                $Ext=$Pecah[1];
                $namabaru = "$FileNameRand.$Ext";
                $path = "../../assets/img/Bukti/".$namabaru;
                $allowedTypes = ['application/pdf'];
                //Buka Nama File Lama
                $Qry = mysqli_query($Conn,"SELECT * FROM capaian WHERE id_capaian='$id_capaian'")or die(mysqli_error($Conn));
                $Data = mysqli_fetch_array($Qry);
                if(empty($Data['id_capaian'])){
                    echo '<code class="text-danger">ID Perjanjian Kinerja yang anda gunakan tidak valid</code>';
                }else{
                    $dokumen_lama=$Data['dokumen'];
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
                                $update = mysqli_query($Conn,"UPDATE capaian SET 
                                    dokumen='$namabaru'
                                WHERE id_capaian='$id_capaian'") or die(mysqli_error($Conn)); 
                                if($update){
                                    //Hapus Dokumen Lama
                                    $url='../../assets/img/Bukti/'.$dokumen_lama.'';
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
                                        $kategori_log="Capaian Kinerja";
                                        $deskripsi_log="Update Capaian Kinerja Berhasil";
                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                        if($InputLog=="Success"){
                                            $_SESSION['NotifikasiSwal']="Update Perjanjian Kinerja Berhasil";
                                            echo '<small class="text-success" id="NotifikasiUploadUlangDokumenBerhasil">Success</small>';
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