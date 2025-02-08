<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_file_store tidak boleh kosong
    if(empty($_POST['id_file_store'])){
        echo '<small class="text-danger">ID File Store Bukti tidak boleh kosong</small>';
    }else{
        //Validasi id_file_store tidak boleh kosong
        if(empty($_FILES['file_draft']['name'])){
            echo '<small class="text-danger">File Draft tidak boleh kosong</small>';
        }else{
            $id_file_store=$_POST['id_file_store'];
            //Cek Ketersediaan Data
            $Qry= mysqli_query($Conn,"SELECT * FROM file_store WHERE id_file_store='$id_file_store'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_file_store'])){
                echo '<small class="text-danger">Data Tidak Tersedia</small>';
            }else{
                $id_evaluasi=$Data['id_evaluasi'];
                $id_referensi_bukti=$Data['id_referensi_bukti'];
                $nama_file=$Data['nama_file'];
                //Buka Referensi Bukti
                $type_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'type_file');
                $max_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'max_file');
                //URL File
                $UrlFile='../../assets/img/Bukti/'.$nama_file.'';
                //Hapus File Lama
                if(file_exists($UrlFile)) {
                    if (unlink($UrlFile)) {
                        //Validasi File Berkas
                        $NamaFile=$_FILES['file_draft']['name'];
                        $UkuranFile = $_FILES['file_draft']['size']; 
                        $TipeFile = $_FILES['file_draft']['type']; 
                        $tmp_file = $_FILES['file_draft']['tmp_name'];
                        $fileError = $_FILES['file_draft']['error'];
                        $fileExt = strtolower(pathinfo($NamaFile, PATHINFO_EXTENSION));
                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                        $FileNameRand=$key;
                        $Pecah = explode("." , $NamaFile);
                        $BiasanyaNama=$Pecah[0];
                        $Ext=$Pecah[1];
                        $namabaru = "$FileNameRand.$Ext";
                        $path = "../../assets/img/Bukti/".$namabaru;
                        // Initialize validation flag
                        $Mim=MimeTiTipe($TipeFile); 
                        //Validasi Tipe File
                        $allowedTypes  = json_decode($type_file, true);
                        $allowedMimeTypes = array_column($allowedTypes, 'type');
                        if (!in_array($TipeFile, $allowedMimeTypes)) {
                            echo '<code class="text-danger">';
                            echo '  Tipe File Yang Anda Gunakan Tidak Valid! ';
                            echo '  Tipe File yang diperbolehkan :<br>';
                            echo '  - ' . implode(', ', $allowedMimeTypes).'<br>';
                            echo '</code>';
                        } else {
                            $MaxFile=$max_file*1000000;
                            if($UkuranFile>$MaxFile){
                                echo '<small class="text-danger">Ukuran file melebihi batas dari yang ditentukan '.$max_file.' MB</small>';
                            }else{
                                if(move_uploaded_file($tmp_file, $path)){
                                    //Update
                                    $Update = mysqli_query($Conn,"UPDATE file_store SET 
                                        nama_file='$namabaru',
                                        type_file='$Mim'
                                    WHERE id_file_store='$id_file_store'") or die(mysqli_error($Conn)); 
                                    if($Update){
                                        $kategori_log="Evaluasi Desa";
                                        $deskripsi_log="Update File Bukti Baru Berhasil";
                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                        if($InputLog=="Success"){
                                            $_SESSION['NotifikasiSwal']="Upload File Berhasil";
                                            echo '<small class="text-success" id="NotifikasiEditDraftBerhasil">Success</small>';
                                        }else{
                                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                        }
                                    }else{
                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                    }
                                }else{
                                    echo '<small class="text-danger">Terjadi kesalahan pada saat upload file</small>';
                                }
                            }
                        }
                    } else {
                        echo '<small class="text-danger">File Gagal Di Hapus Dari Directory</small>';
                    }
                }
            }
        }
    }
?>