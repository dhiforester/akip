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
                            $id_rpjmdes=$_POST['id_rpjmdes'];
                            $periode_awal=$_POST['periode_awal'];
                            $periode_akhir=$_POST['periode_akhir'];
                            $kepala_desa=$_POST['kepala_desa'];
                            $sekretaris_desa=$_POST['sekretaris_desa'];
                            $jumlah_anggaran=$_POST['jumlah_anggaran'];
                            $jumlah_anggaran = str_replace(".", "", $jumlah_anggaran);
                            $periode="$periode_awal-$periode_akhir";
                            //Validasi Id Evaluasi Hanya Boleh Angka
                            if(!preg_match("/^[0-9]*$/", $id_rpjmdes)){
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
                                                                $UpdateRpjmdes = mysqli_query($Conn,"UPDATE rpjmdes SET 
                                                                    periode='$periode',
                                                                    kepala_desa='$kepala_desa',
                                                                    sekretaris_desa='$sekretaris_desa',
                                                                    jumlah_anggaran='$jumlah_anggaran',
                                                                    updatetime='$now'
                                                                WHERE id_rpjmdes='$id_rpjmdes'") or die(mysqli_error($Conn)); 
                                                                if($UpdateRpjmdes){
                                                                    $kategori_log="RPJMDES";
                                                                    $deskripsi_log="Update RPJMDES Berhasil";
                                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                    if($InputLog=="Success"){
                                                                        $_SESSION['NotifikasiSwal']="Update RPJMDES Berhasil";
                                                                        echo '<small class="text-success" id="NotifikasiEditRpjmdesBerhasil">Success</small>';
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
?>