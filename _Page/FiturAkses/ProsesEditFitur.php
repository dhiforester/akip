<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['nama'])){
        echo '<small class="text-danger">Nama fitur tidak boleh kosong</small>';
    }else{
        //Validasi kategori tidak boleh kosong
        if(empty($_POST['kategori'])){
            echo '<small class="text-danger">Kategori tidak boleh kosong</small>';
        }else{
            //Validasi kode tidak boleh kosong
            if(empty($_POST['kode'])){
                echo '<small class="text-danger">Kode tidak boleh kosong</small>';
            }else{
                //Validasi keterangan tidak boleh kosong
                if(empty($_POST['keterangan'])){
                    echo '<small class="text-danger">Setidaknya anda harus memberikan keterangan untuk fitur tersebut</small>';
                }else{
                    //Validasi id_akses_fitur tidak boleh kosong
                    if(empty($_POST['id_akses_fitur'])){
                        echo '<small class="text-danger">ID Fitur Tidak Boleh Kosong/small>';
                    }else{
                        //Validasi akses tidak boleh kosong
                        if(empty($_POST['akses'])){
                            echo '<small class="text-danger">Akses Tidak Boleh Kosong/small>';
                        }else{
                            //Validasi kode tidak boleh lebih dari 20 karakter
                            $JumlahKarakterKode=strlen($_POST['kode']);
                            if($JumlahKarakterKode>20||$JumlahKarakterKode<6){
                                echo '<small class="text-danger">Kode terdiri dari 6-20 karakter</small>';
                            }else{
                                //Validasi kode tidak boleh duplikat
                                $id_akses_fitur=$_POST['id_akses_fitur'];
                                $nama=$_POST['nama'];
                                $kategori=$_POST['kategori'];
                                $kode=$_POST['kode'];
                                $keterangan=$_POST['keterangan'];
                                $akses=$_POST['akses'];
                                //Buka Data Lama
                                $NamaFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'nama');
                                $KodeFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'kode');
                                if($nama==$NamaFitur){
                                    $ValidasiNamaDuplikat=0;
                                }else{
                                    $ValidasiNamaDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_fitur WHERE nama='$nama'"));
                                }
                                if($kode==$KodeFitur){
                                    $ValidasiKodeDuplikat=0;
                                }else{
                                    $ValidasiKodeDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_fitur WHERE kode='$kode'"));
                                }
                                if(!empty($ValidasiKodeDuplikat)){
                                    echo '<small class="text-danger">Kode tersebut sudah terdaftar</small>';
                                }else{
                                    if(!empty($ValidasiNamaDuplikat)){
                                        echo '<small class="text-danger">Nama Fitur tersebut sudah terdaftar</small>';
                                    }else{
                                        $UpdateFiturAkses = mysqli_query($Conn,"UPDATE akses_fitur SET 
                                            akses='$akses',
                                            kategori='$kategori',
                                            nama='$nama',
                                            kode='$kode',
                                            keterangan='$keterangan'
                                        WHERE id_akses_fitur='$id_akses_fitur'") or die(mysqli_error($Conn)); 
                                        if($UpdateFiturAkses){
                                            $kategori_log="Fitur Akses";
                                            $deskripsi_log="Edit Fitur Akses Baru Berhasil";
                                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                            if($InputLog=="Success"){
                                                echo '<small class="text-success" id="NotifikasiEditFiturBerhasil">Success</small>';
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
?>