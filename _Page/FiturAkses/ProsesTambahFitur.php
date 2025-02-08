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
                    if(empty($_POST['akses'])){
                        echo '<small class="text-danger">Level akses tidak boleh kosong</small>';
                    }else{
                        //Validasi kode tidak boleh lebih dari 20 karakter
                        $JumlahKarakterKode=strlen($_POST['kode']);
                        if($JumlahKarakterKode>20||$JumlahKarakterKode<6){
                            echo '<small class="text-danger">Kode terdiri dari 6-20 karakter</small>';
                        }else{
                            //Validasi kode tidak boleh duplikat
                            $nama=$_POST['nama'];
                            $kategori=$_POST['kategori'];
                            $kode=$_POST['kode'];
                            $keterangan=$_POST['keterangan'];
                            $akses=$_POST['akses'];
                            $ValidasiKodeDuplikat=0;
                            $ValidasiNamaDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_fitur WHERE nama='$nama'"));
                            if(!empty($ValidasiKodeDuplikat)){
                                echo '<small class="text-danger">Kode tersebut sudah terdaftar</small>';
                            }else{
                                if(!empty($ValidasiNamaDuplikat)){
                                    echo '<small class="text-danger">Nama Fitur tersebut sudah terdaftar</small>';
                                }else{
                                    $entry="INSERT INTO akses_fitur (
                                        akses,
                                        kategori,
                                        nama,
                                        kode,
                                        keterangan
                                    ) VALUES (
                                        '$akses',
                                        '$kategori',
                                        '$nama',
                                        '$kode',
                                        '$keterangan'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        $kategori_log="Fitur Akses";
                                        $deskripsi_log="Input Fitur Akses Baru Berhasil";
                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                        if($InputLog=="Success"){
                                            echo '<small class="text-success" id="NotifikasiTambahAksesFiturBerhasil">Success</small>';
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
?>