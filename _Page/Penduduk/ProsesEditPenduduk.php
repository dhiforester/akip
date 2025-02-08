<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_penduduk tidak boleh kosong
    if(empty($_POST['id_penduduk'])){
        echo '<small class="text-danger">ID Penduduk tidak boleh kosong</small>';
    }else{
        if(empty($_POST['nik'])){
            echo '<small class="text-danger">NIK tidak boleh kosong</small>';
        }else{
            //Validasi kk tidak boleh kosong
            if(empty($_POST['kk'])){
                echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
            }else{
                //Validasi nama tidak boleh kosong
                if(empty($_POST['nama'])){
                    echo '<small class="text-danger">Nama tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['alamat'])){
                        echo '<small class="text-danger">Alamat tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['tempat_lahir'])){
                            echo '<small class="text-danger">Tempat Lahir tidak boleh kosong</small>';
                        }else{
                            if(empty($_POST['tanggal_lahir'])){
                                echo '<small class="text-danger">Tanggal Lahir tidak boleh kosong</small>';
                            }else{
                                if(empty($_POST['gender'])){
                                    echo '<small class="text-danger">Gender tidak boleh kosong</small>';
                                }else{
                                    if(empty($_POST['pernikahan'])){
                                        echo '<small class="text-danger">Pernikahan tidak boleh kosong</small>';
                                    }else{
                                        if(empty($_POST['pekerjaan'])){
                                            echo '<small class="text-danger">Pekerjaan tidak boleh kosong</small>';
                                        }else{
                                            if(empty($_POST['hidup'])){
                                                echo '<small class="text-danger">Status hidup tidak boleh kosong</small>';
                                            }else{
                                                if(empty($_POST['keberadaan'])){
                                                    echo '<small class="text-danger">Status keberadaan penduduk tidak boleh kosong</small>';
                                                }else{
                                                    if(empty($_POST['kontak'])){
                                                        $kontak="";
                                                    }else{
                                                        $kontak=$_POST['kontak'];
                                                    }
                                                    $id_penduduk=$_POST['id_penduduk'];
                                                    $nik=$_POST['nik'];
                                                    $kk=$_POST['kk'];
                                                    $nama=$_POST['nama'];
                                                    $alamat=$_POST['alamat'];
                                                    $tempat_lahir=$_POST['tempat_lahir'];
                                                    $tanggal_lahir=$_POST['tanggal_lahir'];
                                                    $gender=$_POST['gender'];
                                                    $pernikahan=$_POST['pernikahan'];
                                                    $pekerjaan=$_POST['pekerjaan'];
                                                    $hidup=$_POST['hidup'];
                                                    $keberadaan=$_POST['keberadaan'];
                                                    //Buka Data Nik Lama
                                                    $NikLama=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'nik');
                                                    //Validasi NIK tidak boleh duplikat
                                                    if($NikLama==$nik){
                                                        $ValidasiDuplikatNik=0;
                                                    }else{
                                                        $ValidasiDuplikatNik=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE nik='$nik'"));
                                                    }
                                                    if(!empty($ValidasiDuplikatNik)){
                                                        echo '<small class="text-danger">NIK tersebut sudah terdaftar</small>';
                                                    }else{
                                                        //Validasi Jumlah Karakter
                                                        $JumlahKarakterNik=strlen($nik);
                                                        $JumlahKarakterKk=strlen($kk);
                                                        $JumlahKarakterKontak=strlen($kontak);
                                                        if($JumlahKarakterNik>20||!preg_match("/^[0-9]*$/", $nik)){
                                                            echo '<small class="text-danger">NIK tidak lebih dari 20 karakter angka</small>';
                                                        }else{
                                                            if($JumlahKarakterKk>20||!preg_match("/^[0-9]*$/", $kk)){
                                                                echo '<small class="text-danger">No KK tidak lebih dari 20 karakter angka</small>';
                                                            }else{
                                                                if($JumlahKarakterKontak>20||!preg_match("/^[0-9]*$/", $kontak)){
                                                                    echo '<small class="text-danger">No Kontak tidak lebih dari 20 karakter angka</small>';
                                                                }else{
                                                                    $UpdatePenduduk = mysqli_query($Conn,"UPDATE penduduk SET 
                                                                        nik='$nik',
                                                                        kk='$kk',
                                                                        nama='$nama',
                                                                        alamat='$alamat',
                                                                        tempat_lahir='$tempat_lahir',
                                                                        tanggal_lahir='$tanggal_lahir',
                                                                        gender='$gender',
                                                                        pernikahan='$pernikahan',
                                                                        pekerjaan='$pekerjaan',
                                                                        hidup='$hidup',
                                                                        updatetime='$now'
                                                                    WHERE id_penduduk='$id_penduduk'") or die(mysqli_error($Conn)); 
                                                                    if($UpdatePenduduk){
                                                                        $kategori_log="Penduduk";
                                                                        $deskripsi_log="Update Penduduk Baru Berhasil";
                                                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                        if($InputLog=="Success"){
                                                                            echo '<small class="text-success" id="NotifikasiEditPendudukBerhasil">Success</small>';
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