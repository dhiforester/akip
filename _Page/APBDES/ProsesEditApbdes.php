<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_apbdes tidak boleh kosong
    if(empty($_POST['id_apbdes'])){
        echo '<code class="text-danger">ID APBDES tidak boleh kosong</code>';
    }else{
        //Validasi periode tidak boleh kosong
        if(empty($_POST['periode'])){
            echo '<code class="text-danger">Periode APBDES tidak boleh kosong</code>';
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
                        $id_apbdes=$_POST['id_apbdes'];
                        $kepala_desa=$_POST['kepala_desa'];
                        $sekretaris_desa=$_POST['sekretaris_desa'];
                        $jumlah_anggaran=$_POST['jumlah_anggaran'];
                        $jumlah_anggaran = str_replace(".", "", $jumlah_anggaran);
                        //Validasi Id Evaluasi Hanya Boleh Angka
                        if(!preg_match("/^[0-9]*$/", $id_apbdes)){
                            echo '<code class="text-danger">ID APBDES Hanya Boleh Angka</code>';
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
                                                $UpdateAPBDES = mysqli_query($Conn,"UPDATE apbdes SET 
                                                    kepala_desa='$kepala_desa',
                                                    sekretaris_desa='$sekretaris_desa',
                                                    jumlah_anggaran='$jumlah_anggaran',
                                                    updatetime='$now'
                                                WHERE id_apbdes='$id_apbdes'") or die(mysqli_error($Conn)); 
                                                if($UpdateAPBDES){
                                                    $kategori_log="APBDES";
                                                    $deskripsi_log="Update APBDES Berhasil";
                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                    if($InputLog=="Success"){
                                                        $_SESSION['NotifikasiSwal']="Update APBDES Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiEditApbdesBerhasil">Success</small>';
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