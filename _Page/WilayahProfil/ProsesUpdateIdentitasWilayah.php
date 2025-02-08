<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi tingkat tidak boleh kosong
    if(empty($_POST['tingkat'])){
        echo '<small class="text-danger">Tingkat Wilayah tidak boleh kosong</small>';
    }else{
        //Validasi jenis tidak boleh kosong
        if(empty($_POST['jenis'])){
            echo '<small class="text-danger">Jenis wilayah tidak boleh kosong</small>';
        }else{
            //Validasi nama tidak boleh kosong
            if(empty($_POST['nama'])){
                echo '<small class="text-danger">Nama wilayah tidak boleh kosong</small>';
            }else{
                if(empty($_POST['gelar_pimpinan'])){
                    echo '<small class="text-danger">Kategori pimpinan tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['nama_pimpinan'])){
                        echo '<small class="text-danger">Nama pimpinan tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['visi'])){
                            echo '<small class="text-danger">Visi tidak boleh kosong</small>';
                        }else{
                            if(empty($_POST['misi'])){
                                echo '<small class="text-danger">Misi tidak boleh kosong</small>';
                            }else{
                                if(empty($_POST['alamat'])){
                                    echo '<small class="text-danger">Alamat tidak boleh kosong</small>';
                                }else{
                                    if(empty($_POST['kontak'])){
                                        $kontak="0";
                                    }else{
                                        $kontak=$_POST['kontak'];
                                    }
                                    if(empty($_POST['tahun'])){
                                        $tahun="0";
                                    }else{
                                        $tahun=$_POST['tahun'];
                                    }
                                    if(empty($_POST['dasar_hukum'])){
                                        $dasar_hukum="";
                                    }else{
                                        $dasar_hukum=$_POST['dasar_hukum'];
                                    }
                                    $tingkat=$_POST['tingkat'];
                                    $jenis=$_POST['jenis'];
                                    $nama=$_POST['nama'];
                                    $gelar_pimpinan=$_POST['gelar_pimpinan'];
                                    $nama_pimpinan=$_POST['nama_pimpinan'];
                                    $visi=$_POST['visi'];
                                    $misi=$_POST['misi'];
                                    $alamat=$_POST['alamat'];
                                    //Cek Validitas Data
                                    $JumlahKarakterKontak=strlen($kontak);
                                    $JumlahKarakterTahun=strlen($tahun);
                                    if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $kontak)){
                                        echo '<small class="text-danger">Kontak terdiri dari 6-20 karakter numerik</small>';
                                    }else{
                                        if($JumlahKarakterTahun>4||$JumlahKarakterTahun<3||!preg_match("/^[0-9]*$/", $tahun)){
                                            echo '<small class="text-danger">Tahun terdiri dari 3-4 karakter numerik</small>';
                                        }else{
                                            //Keberadaan Data
                                            $id_wilayah_profile=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'id_wilayah_profile');
                                            if(empty($id_wilayah_profile)){
                                                $entry="INSERT INTO wilayah_profile (
                                                    id_wilayah,
                                                    tingkat,
                                                    jenis,
                                                    nama,
                                                    gelar_pimpinan,
                                                    nama_pimpinan,
                                                    visi,
                                                    misi,
                                                    alamat,
                                                    kontak,
                                                    tahun,
                                                    dasar_hukum,
                                                    updatetime
                                                ) VALUES (
                                                    '$SessionIdWilayah',
                                                    '$tingkat',
                                                    '$jenis',
                                                    '$nama',
                                                    '$gelar_pimpinan',
                                                    '$nama_pimpinan',
                                                    '$visi',
                                                    '$misi',
                                                    '$alamat',
                                                    '$kontak',
                                                    '$tahun',
                                                    '$dasar_hukum',
                                                    '$now'
                                                )";
                                                $UpdateIdentitasWilayah=mysqli_query($Conn, $entry);
                                            }else{
                                                $UpdateIdentitasWilayah = mysqli_query($Conn,"UPDATE wilayah_profile SET 
                                                    tingkat='$tingkat',
                                                    jenis='$jenis',
                                                    nama='$nama',
                                                    gelar_pimpinan='$gelar_pimpinan',
                                                    nama_pimpinan='$nama_pimpinan',
                                                    visi='$visi',
                                                    misi='$misi',
                                                    alamat='$alamat',
                                                    kontak='$kontak',
                                                    tahun='$tahun',
                                                    dasar_hukum='$dasar_hukum',
                                                    updatetime='$now'
                                                WHERE id_wilayah_profile='$id_wilayah_profile'") or die(mysqli_error($Conn)); 
                                            }
                                            if($UpdateIdentitasWilayah){
                                                $kategori_log="Profil Wilayah";
                                                $deskripsi_log="Update Identitas Wilayah Berhasil";
                                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                if($InputLog=="Success"){
                                                    echo '<small class="text-success" id="NotifikasiUpdateIdentitasWilayahBerhasil">Success</small>';
                                                }else{
                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
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