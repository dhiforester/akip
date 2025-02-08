<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_evaluasi tidak boleh kosong
    if(empty($_POST['id_evaluasi'])){
        echo '<code class="text-danger">ID Evaluasi tidak boleh kosong</code>';
    }else{
        //Validasi id_rpjmdes tidak boleh kosong
        if(empty($_POST['id_rpjmdes'])){
            echo '<code class="text-danger">ID RPJMDES tidak boleh kosong</code>';
        }else{
            //Validasi periode_rkpdes tidak boleh kosong
            if(empty($_POST['periode_rkpdes'])){
                echo '<code class="text-danger">Periode RKPDES tidak boleh kosong</code>';
            }else{
                if(empty($_POST['kepala_desa'])){
                    echo '<code class="text-danger">Kepala Desa tidak boleh kosong</code>';
                }else{
                    if(empty($_POST['sekretaris_desa'])){
                        echo '<code class="text-danger">Sekretaris Desa tidak boleh kosong</code>';
                    }else{
                        if(empty($_POST['jumlah_anggaran'])){
                            echo '<code class="text-danger">Jumlah Anggaran tidak boleh kosong</code>';
                        }else{
                            if(empty($_FILES['dokumen']['name'])){
                                echo '<code class="text-danger">Lampiran File RKPDES tidak boleh kosong</code>';
                            }else{
                                $id_evaluasi=$_POST['id_evaluasi'];
                                $id_rpjmdes=$_POST['id_rpjmdes'];
                                $periode_rkpdes=$_POST['periode_rkpdes'];
                                $kepala_desa=$_POST['kepala_desa'];
                                $sekretaris_desa=$_POST['sekretaris_desa'];
                                $jumlah_anggaran=$_POST['jumlah_anggaran'];
                                $jumlah_anggaran = str_replace(".", "", $jumlah_anggaran);
                                //File Dokumen
                                $NamaFile=$_FILES['dokumen']['name'];
                                $UkuranFile = $_FILES['dokumen']['size']; 
                                $TipeFile = $_FILES['dokumen']['type']; 
                                $TmpFile = $_FILES['dokumen']['tmp_name'];
                                //Mencari ID wilayah Kabupaten
                                $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                                $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                                $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                                $desa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
                                $periode="$periode_rkpdes";
                                //Validasi Id Evaluasi Hanya Boleh Angka
                                if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                                    echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
                                }else{
                                    if(!preg_match("/^[0-9]*$/", $periode_rkpdes)){
                                        echo '<code class="text-danger">Periode Hanya Boleh Angka</code>';
                                    }else{
                                        if(!preg_match("/^[0-9]*$/", $id_rpjmdes)){
                                            echo '<code class="text-danger">ID RPJMDES Hanya Boleh Angka</code>';
                                        }else{
                                            $JumlahKarakterKepalaDesa=strlen($kepala_desa);
                                            $JumlahKarakterSekretarisDesa=strlen($sekretaris_desa);
                                            if($JumlahKarakterKepalaDesa>200){
                                                echo '<code class="text-danger">Nama Kepala Desa Terlalu Panjang, Maksimal 200 Karakter</code>';
                                            }else{
                                                if($JumlahKarakterSekretarisDesa>200){
                                                    echo '<code class="text-danger">Nama Sekretaris Desa Terlalu Panjang, Maksimal 200 Karakter</code>';
                                                }else{
                                                    if (!preg_match('/^[a-zA-Z.,\s]+$/', $kepala_desa)) {
                                                        echo '<code class="text-danger">Nama Kepala Desa Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                                    }else{
                                                        if (!preg_match('/^[a-zA-Z.,\s]+$/', $sekretaris_desa)) {
                                                            echo '<code class="text-danger">Nama Sekretaris Desa Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                                        }else{
                                                            if (!preg_match("/^[0-9]*$/", $jumlah_anggaran)) {
                                                                echo '<code class="text-danger">Jumlah Anggaran Hanya Boleh Terdiri Dari Angka</code>';
                                                            }else{
                                                                //Membuat File
                                                                $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                                $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                                $FileNameRand=$key;
                                                                $Pecah = explode("." , $NamaFile);
                                                                $BiasanyaNama=$Pecah[0];
                                                                $Ext=$Pecah[1];
                                                                $namabaru = "$FileNameRand.$Ext";
                                                                $path = "../../assets/img/RKPDES/".$namabaru;
                                                                $allowedTypes = ['application/pdf'];
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
                                                                            $entry="INSERT INTO rkpdes (
                                                                                id_evaluasi,
                                                                                id_rpjmdes,
                                                                                id_wilayah,
                                                                                propinsi,
                                                                                kabupaten,
                                                                                kecamatan,
                                                                                desa,
                                                                                periode,
                                                                                kepala_desa,
                                                                                sekretaris_desa,
                                                                                jumlah_anggaran,
                                                                                dokumen,
                                                                                catatan,
                                                                                status,
                                                                                updatetime
                                                                            ) VALUES (
                                                                                '$id_evaluasi',
                                                                                '$id_rpjmdes',
                                                                                '$SessionIdWilayah',
                                                                                '$propinsi',
                                                                                '$kabupaten',
                                                                                '$kecamatan',
                                                                                '$desa',
                                                                                '$periode',
                                                                                '$kepala_desa',
                                                                                '$sekretaris_desa',
                                                                                '$jumlah_anggaran',
                                                                                '$namabaru',
                                                                                '',
                                                                                'Edited',
                                                                                '$now'
                                                                            )";
                                                                            $Input=mysqli_query($Conn, $entry);
                                                                            if($Input){
                                                                                $kategori_log="RKPDES";
                                                                                $deskripsi_log="Tambah RKPDES Berhasil";
                                                                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                                if($InputLog=="Success"){
                                                                                    $_SESSION['NotifikasiSwal']="Tambah RKPDES Berhasil";
                                                                                    echo '<small class="text-success" id="NotifikasiTambahRkpdesBerhasil">Success</small>';
                                                                                }else{
                                                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
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
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>