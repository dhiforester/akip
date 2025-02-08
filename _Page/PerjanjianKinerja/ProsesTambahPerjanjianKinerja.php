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
        //Validasi tanggal tidak boleh kosong
        if(empty($_POST['tanggal'])){
            echo '<code class="text-danger">Tanggal perjanjian tidak boleh kosong</code>';
        }else{
            if(empty($_POST['kategori'])){
                echo '<code class="text-danger">Kategori tidak boleh kosong</code>';
            }else{
                if(empty($_POST['nama_1'])){
                    echo '<code class="text-danger">Nama pihak pertama tidak boleh kosong</code>';
                }else{
                    if(empty($_POST['jabatan_1'])){
                        echo '<code class="text-danger">Jabatan pihak pertama tidak boleh kosong</code>';
                    }else{
                        if(empty($_POST['nama_2'])){
                            echo '<code class="text-danger">Nama pihak ke dua tidak boleh kosong</code>';
                        }else{
                            if(empty($_POST['jabatan_2'])){
                                echo '<code class="text-danger">Jabatan pihak ke dua tidak boleh kosong</code>';
                            }else{
                                if(empty($_FILES['dokumen']['name'])){
                                    echo '<code class="text-danger">Lampiran File RKPDES tidak boleh kosong</code>';
                                }else{
                                    $id_evaluasi=$_POST['id_evaluasi'];
                                    $tanggal=$_POST['tanggal'];
                                    $kategori=$_POST['kategori'];
                                    $nama_1=$_POST['nama_1'];
                                    $jabatan_1=$_POST['jabatan_1'];
                                    $nama_2=$_POST['nama_2'];
                                    $jabatan_2=$_POST['jabatan_2'];
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
                                    //Validasi Id Evaluasi Hanya Boleh Angka
                                    if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                                        echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
                                    }else{
                                        if (!preg_match('/^[a-zA-Z.,\s]+$/', $nama_1)) {
                                            echo '<code class="text-danger">Nama Pihak Pertama Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                        }else{
                                            if (!preg_match('/^[a-zA-Z.,\s]+$/', $jabatan_1)) {
                                                echo '<code class="text-danger">Jabatan Pihak Pertama Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                            }else{
                                                if (!preg_match('/^[a-zA-Z.,\s]+$/', $nama_2)) {
                                                    echo '<code class="text-danger">Nama Pihak ke Dua Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                                }else{
                                                    if (!preg_match('/^[a-zA-Z.,\s]+$/', $jabatan_2)) {
                                                        echo '<code class="text-danger">Jabatan Pihak ke Dua Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                                    }else{
                                                        //Membuat File
                                                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                        $FileNameRand=$key;
                                                        $Pecah = explode("." , $NamaFile);
                                                        $BiasanyaNama=$Pecah[0];
                                                        $Ext=$Pecah[1];
                                                        $namabaru = "$FileNameRand.$Ext";
                                                        $path = "../../assets/img/PerjanjianKinerja/".$namabaru;
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
                                                                    $entry="INSERT INTO perjanjian_kinerja (
                                                                        id_evaluasi,
                                                                        id_wilayah,
                                                                        propinsi,
                                                                        kabupaten,
                                                                        kecamatan,
                                                                        desa,
                                                                        kategori,
                                                                        nama_1,
                                                                        jabatan_1,
                                                                        nama_2,
                                                                        jabatan_2,
                                                                        tanggal,
                                                                        dokumen,
                                                                        catatan,
                                                                        status,
                                                                        updatetime
                                                                    ) VALUES (
                                                                        '$id_evaluasi',
                                                                        '$SessionIdWilayah',
                                                                        '$propinsi',
                                                                        '$kabupaten',
                                                                        '$kecamatan',
                                                                        '$desa',
                                                                        '$kategori',
                                                                        '$nama_1',
                                                                        '$jabatan_1',
                                                                        '$nama_2',
                                                                        '$jabatan_2',
                                                                        '$tanggal',
                                                                        '$namabaru',
                                                                        '',
                                                                        'Edited',
                                                                        '$now'
                                                                    )";
                                                                    $Input=mysqli_query($Conn, $entry);
                                                                    if($Input){
                                                                        $kategori_log="Perjanjian Kinerja";
                                                                        $deskripsi_log="Tambah Perjanjian Kinerja Berhasil";
                                                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                        if($InputLog=="Success"){
                                                                            $_SESSION['NotifikasiSwal']="Tambah Perjanjian Kinerja Berhasil";
                                                                            echo '<small class="text-success" id="NotifikasiTambahPerjanjianKinerjaBerhasil">Success</small>';
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
?>