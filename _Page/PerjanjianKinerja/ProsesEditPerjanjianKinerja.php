<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_perjanjian_kinerja tidak boleh kosong
    if(empty($_POST['id_perjanjian_kinerja'])){
        echo '<code class="text-danger">ID Perjanjian Kinerja tidak boleh kosong</code>';
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
                                $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
                                $tanggal=$_POST['tanggal'];
                                $kategori=$_POST['kategori'];
                                $nama_1=$_POST['nama_1'];
                                $jabatan_1=$_POST['jabatan_1'];
                                $nama_2=$_POST['nama_2'];
                                $jabatan_2=$_POST['jabatan_2'];
                                //Validasi Id Perjanjian Kinerja Hanya Boleh Angka
                                if(!preg_match("/^[0-9]*$/", $id_perjanjian_kinerja)){
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
                                                    $UpdatePerjanjianKinerja = mysqli_query($Conn,"UPDATE perjanjian_kinerja SET 
                                                        kategori='$kategori',
                                                        nama_1='$nama_1',
                                                        jabatan_1='$jabatan_1',
                                                        nama_2='$nama_2',
                                                        jabatan_2='$jabatan_2',
                                                        tanggal='$tanggal',
                                                        updatetime='$now'
                                                    WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'") or die(mysqli_error($Conn)); 
                                                    if($UpdatePerjanjianKinerja){
                                                        $kategori_log="Perjanjian Kinerja";
                                                        $deskripsi_log="Update Perjanjian Kinerja Berhasil";
                                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                        if($InputLog=="Success"){
                                                            $_SESSION['NotifikasiSwal']="Update Perjanjian Kinerja Berhasil";
                                                            echo '<small class="text-success" id="NotifikasiEditPerjanjianKinerjaBerhasil">Success</small>';
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
?>