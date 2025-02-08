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
        //Validasi id_wilayah tidak boleh kosong
        if(empty($_POST['id_wilayah'])){
            echo '<code class="text-danger">ID Wilayah tidak boleh kosong</code>';
        }else{
            //Validasi indikator tidak boleh kosong
            if(empty($_POST['indikator'])){
                echo '<code class="text-danger">Indikator tidak boleh kosong</code>';
            }else{
                if(empty($_FILES['dokumen']['name'])){
                    echo '<code class="text-danger">Lampiran File RKPDES tidak boleh kosong</code>';
                }else{
                    $indikator=$_POST['indikator'];
                    $id_evaluasi=$_POST['id_evaluasi'];
                    $id_wilayah=$_POST['id_wilayah'];
                    if(empty($_POST['jumlah'])){
                        $jumlah=0;
                    }else{
                        $jumlah=$_POST['jumlah'];
                    }
                    if(empty($_POST['target'])){
                        $target=0;
                    }else{
                        $target=$_POST['target'];
                    }
                    if(empty($_POST['capaian'])){
                        $capaian=0;
                    }else{
                        $capaian=$_POST['capaian'];
                    }
                    //File Dokumen
                    $NamaFile=$_FILES['dokumen']['name'];
                    $UkuranFile = $_FILES['dokumen']['size']; 
                    $TipeFile = $_FILES['dokumen']['type']; 
                    $TmpFile = $_FILES['dokumen']['tmp_name'];
                    //Mencari ID wilayah Kabupaten
                    $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                    $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                    $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                    $desa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
                    //Validasi Id Evaluasi Hanya Boleh Angka
                    if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                        echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
                    }else{
                        $pattern = "/^[0-9.]*$/";
                        if (!preg_match($pattern, $jumlah)) {
                            echo '<code class="text-danger">Jumlah hanya boleh angka dan desimal</code>';
                        }else{
                            if (!preg_match($pattern, $target)) {
                                echo '<code class="text-danger">Target hanya boleh angka dan desimal</code>';
                            }else{
                                if (!preg_match($pattern, $capaian)) {
                                    echo '<code class="text-danger">Capaian hanya boleh angka dan desimal</code>';
                                }else{
                                    //Menghitung Persentase
                                    $persentase=HitungPersentase($indikator,$jumlah,$target,$capaian);
                                    //Membuat File
                                    $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                    $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                    $FileNameRand=$key;
                                    $Pecah = explode("." , $NamaFile);
                                    $BiasanyaNama=$Pecah[0];
                                    $Ext=$Pecah[1];
                                    $namabaru = "$FileNameRand.$Ext";
                                    $path = "../../assets/img/Bukti/".$namabaru;
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
                                                $entry="INSERT INTO capaian (
                                                    id_evaluasi,
                                                    id_wilayah,
                                                    propinsi,
                                                    kabupaten,
                                                    kecamatan,
                                                    desa,
                                                    indikator,
                                                    jumlah,
                                                    target,
                                                    capaian,
                                                    persentase,
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
                                                    '$indikator',
                                                    '$jumlah',
                                                    '$target',
                                                    '$capaian',
                                                    '$persentase',
                                                    '$namabaru',
                                                    '',
                                                    'Dikirim',
                                                    '$now'
                                                )";
                                                $Input=mysqli_query($Conn, $entry);
                                                if($Input){
                                                    $kategori_log="Capaian";
                                                    $deskripsi_log="Tambah Menurunnya Keluarga Miskin Berhasil";
                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                    if($InputLog=="Success"){
                                                        $_SESSION['NotifikasiSwal']="Tambah Capaian Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiTambahKkMiskinBerhasil">Success</small>';
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
?>