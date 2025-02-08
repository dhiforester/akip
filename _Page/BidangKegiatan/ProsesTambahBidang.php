<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_wilayah'])){
        echo '<small class="credit text-danger">';
        echo '  Id Wilayah Tidak Boleh Kosong!';
        echo '</small>';
    }else{
        if(empty($_POST['kode'])){
            echo '<small class="credit text-danger">';
            echo '  Kode Bidang/Kegiatan Tidak Boleh Kosong!';
            echo '</small>';
        }else{
            if(empty($_POST['level'])){
                echo '<small class="credit text-danger">';
                echo '  Level Bidang/Kegiatan Tidak Boleh Kosong!';
                echo '</small>';
            }else{
                if(empty($_POST['nama'])){
                    echo '<small class="credit text-danger">';
                    echo '  Nama Bidang/Kegiatan Tidak Boleh Kosong!';
                    echo '</small>';
                }else{
                    $id_wilayah=$_POST['id_wilayah'];
                    $nama_daerah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                    $KodeDasar=$_POST['kode'];
                    $level=$_POST['level'];
                    $nama=$_POST['nama'];
                    //Rout By Level
                    if($level=="Bidang"){
                        $kode_bidang=$KodeDasar;
                        $kode_sub_bidang="";
                        $kode_kegiatan="";
                        $kode=$kode_bidang;
                        $ValidasiKelengkapanLanjutan="Valid";
                    }else{
                        if($level=="Sub Bidang"){
                            if(empty($_POST['kode_bidang'])){
                                $kode_bidang="";
                                $ValidasiKelengkapanLanjutan="Kode Bidang Tidak Boleh Kosong!";
                            }else{
                                $kode_bidang=$_POST['kode_bidang'];
                                $kode_sub_bidang=$KodeDasar;
                                $kode_kegiatan="";
                                $kode="$kode_bidang.$kode_sub_bidang";
                                $ValidasiKelengkapanLanjutan="Valid";
                            }
                        }else{
                            if($level=="Kegiatan"){
                                if(empty($_POST['kode_bidang'])){
                                    $kode_bidang="";
                                    $ValidasiKelengkapanLanjutan="Kode Bidang Tidak Boleh Kosong!";
                                }else{
                                    if(empty($_POST['kode_sub_bidang'])){
                                        $kode_sub_bidang="";
                                        $ValidasiKelengkapanLanjutan="Kode Sub Bidang Tidak Boleh Kosong!";
                                    }else{
                                        $kode_bidang=$_POST['kode_bidang'];
                                        $kode_sub_bidang=$_POST['kode_sub_bidang'];
                                        $kode_kegiatan=$KodeDasar;
                                        $kode="$kode_bidang.$kode_sub_bidang.$kode_kegiatan";
                                        $ValidasiKelengkapanLanjutan="Valid";
                                    }
                                }
                            }
                        }
                    }
                    if($ValidasiKelengkapanLanjutan!=="Valid"){
                        echo '<small class="credit text-danger">'.$ValidasiKelengkapanLanjutan.'</small>';
                    }else{
                        //Validasi Kode Tidak Boleh Sama
                        $ValidasiKodeBuplikat = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE kode='$kode' AND id_wilayah='$id_wilayah'"));
                        if(!empty($ValidasiKodeBuplikat)){
                            echo '<small class="credit text-danger">';
                            echo '  Kode Yang Anda Gunakan Sudah Terdaftar!';
                            echo '</small>';
                        }else{
                            $entry="INSERT INTO bidang_kegiatan (
                                id_wilayah,
                                nama_daerah,
                                kode,
                                kode_bidang,
                                kode_sub_bidang,
                                kode_kegiatan,
                                level,
                                nama,
                                updatetime
                            ) VALUES (
                                '$id_wilayah',
                                '$nama_daerah',
                                '$kode',
                                '$kode_bidang',
                                '$kode_sub_bidang',
                                '$kode_kegiatan',
                                '$level',
                                '$nama',
                                '$now'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $kategori_log="Bidang Kegiatan";
                                $deskripsi_log="Tambah Bidang Kegiatan Berhasil";
                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                if($InputLog=="Success"){
                                    echo '<small class="text-success" id="NotifikasiTambahBidangBerhasil">Success</small>';
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
?>