<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_rkpdes tidak boleh kosong
    if(empty($_POST['id_rkpdes'])){
        echo '<code class="text-danger">ID RKPDES tidak boleh kosong</code>';
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
                        $id_rkpdes=$_POST['id_rkpdes'];
                        $kepala_desa=$_POST['kepala_desa'];
                        $sekretaris_desa=$_POST['sekretaris_desa'];
                        $jumlah_anggaran=$_POST['jumlah_anggaran'];
                        $jumlah_anggaran = str_replace(".", "", $jumlah_anggaran);
                        //Validasi Id Evaluasi Hanya Boleh Angka
                        if(!preg_match("/^[0-9]*$/", $id_rkpdes)){
                            echo '<code class="text-danger">ID RKPDES Hanya Boleh Angka</code>';
                        }else{
                            $JumlahKarakterKepalaDesa=strlen($kepala_desa);
                            $JumlahKarakterSekretarisDesa=strlen($sekretaris_desa);
                            if($JumlahKarakterKepalaDesa>200){
                                echo '<code class="text-danger">Nama Kepala Desa Terlalu Panjang, Maksimal 200 Karakter</code>';
                            }else{
                                if($JumlahKarakterSekretarisDesa>200){
                                    echo '<code class="text-danger">Nama Sekretaris Desa Terlalu Panjang, Maksimal 200 Karakter</code>';
                                }else{
                                    if(!preg_match('/^[a-zA-Z.,\s]+$/', $kepala_desa)) {
                                        echo '<code class="text-danger">Nama Kepala Desa Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                    }else{
                                        if (!preg_match('/^[a-zA-Z.,\s]+$/', $sekretaris_desa)) {
                                            echo '<code class="text-danger">Nama Sekretaris Desa Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                        }else{
                                            if (!preg_match("/^[0-9]*$/", $jumlah_anggaran)) {
                                                echo '<code class="text-danger">Jumlah Anggaran Hanya Boleh Terdiri Dari Angka</code>';
                                            }else{
                                                $UpdateRkpdes = mysqli_query($Conn,"UPDATE rkpdes SET 
                                                    kepala_desa='$kepala_desa',
                                                    sekretaris_desa='$sekretaris_desa',
                                                    jumlah_anggaran='$jumlah_anggaran',
                                                    updatetime='$now'
                                                WHERE id_rkpdes='$id_rkpdes'") or die(mysqli_error($Conn)); 
                                                if($UpdateRkpdes){
                                                    $kategori_log="RKPDES";
                                                    $deskripsi_log="Update RKPDES Berhasil";
                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                    if($InputLog=="Success"){
                                                        $_SESSION['NotifikasiSwal']="Update RKPDES Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiEditRkpdesBerhasil">Success</small>';
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