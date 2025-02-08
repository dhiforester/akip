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
        //Validasi periode_awal tidak boleh kosong
        if(empty($_POST['periode_awal'])){
            echo '<code class="text-danger">Periode Awal tidak boleh kosong</code>';
        }else{
            //Validasi periode_akhir tidak boleh kosong
            if(empty($_POST['periode_akhir'])){
                echo '<code class="text-danger">Periode Akhir tidak boleh kosong</code>';
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
                            if(empty($_FILES['dokumen_rpjmdes']['name'])){
                                echo '<code class="text-danger">Lampiran File RPJMDES tidak boleh kosong</code>';
                            }else{
                                $id_evaluasi=$_POST['id_evaluasi'];
                                $periode_awal=$_POST['periode_awal'];
                                $periode_akhir=$_POST['periode_akhir'];
                                $kepala_desa=$_POST['kepala_desa'];
                                $sekretaris_desa=$_POST['sekretaris_desa'];
                                $jumlah_anggaran=$_POST['jumlah_anggaran'];
                                $jumlah_anggaran = str_replace(".", "", $jumlah_anggaran);
                                //File Dokumen
                                $NamaFile=$_FILES['dokumen_rpjmdes']['name'];
                                $UkuranFile = $_FILES['dokumen_rpjmdes']['size']; 
                                $TipeFile = $_FILES['dokumen_rpjmdes']['type']; 
                                $TmpFile = $_FILES['dokumen_rpjmdes']['tmp_name'];
                                //Mencari ID wilayah Kabupaten
                                $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                                $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                                $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                                $desa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
                                $periode="$periode_awal-$periode_akhir";
                                //Validasi Id Evaluasi Hanya Boleh Angka
                                if(!preg_match("/^[0-9]*$/", $id_evaluasi)){
                                    echo '<code class="text-danger">ID Evaluasi Hanya Boleh Angka</code>';
                                }else{
                                    if(!preg_match("/^[0-9]*$/", $periode_awal)){
                                        echo '<code class="text-danger">Periode Awal Hanya Boleh Angka</code>';
                                    }else{
                                        if(!preg_match("/^[0-9]*$/", $periode_akhir)){
                                            echo '<code class="text-danger">Periode Akhir Hanya Boleh Angka</code>';
                                        }else{
                                            if($periode_akhir<=$periode_awal){
                                                echo '<code class="text-danger">Periode Akhir Tidak Boleh Lebih Kecil atau Sama Dengan Periode Awal</code>';
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
                                                                    $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                                    $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                                    $FileNameRand=$key;
                                                                    $Pecah = explode("." , $NamaFile);
                                                                    $BiasanyaNama=$Pecah[0];
                                                                    $Ext=$Pecah[1];
                                                                    $namabaru = "$FileNameRand.$Ext";
                                                                    $path = "../../assets/img/RPJMDES/".$namabaru;
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
                                                                                $entry="INSERT INTO rpjmdes (
                                                                                    id_evaluasi,
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
                                                                                    $kategori_log="RPJMDES";
                                                                                    $deskripsi_log="Tambah RPJMDES Berhasil";
                                                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                                    if($InputLog=="Success"){
                                                                                        $_SESSION['NotifikasiSwal']="Tambah RPJMDES Berhasil";
                                                                                        echo '<small class="text-success" id="NotifikasiTambahRpjmdesBerhasil">Success</small>';
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
    }
?>