<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_anggaran_rincian tidak boleh kosong
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
    }else{
        if(empty($_POST['id_anggaran'])){
            echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
        }else{
            //Validasi Kode RAB tidak boleh kosong
            if(empty($_POST['id_wilayah'])){
                echo '<small class="text-danger">ID Wilayah tidak boleh kosong</small>';
            }else{
                //Validasi status_pekerjaan tidak boleh kosong
                if(empty($_POST['status_pekerjaan'])){
                    echo '<small class="text-danger">Status Anggaran tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['alokasi_anggaran'])){
                        $alokasi_anggaran="0";
                    }else{
                        $alokasi_anggaran=$_POST['alokasi_anggaran'];
                    }
                    if(empty($_POST['keterangan'])){
                        $keterangan="0";
                    }else{
                        $keterangan=$_POST['keterangan'];
                    }
                    $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
                    $id_anggaran=$_POST['id_anggaran'];
                    $id_wilayah=$_POST['id_wilayah'];
                    $status_pekerjaan=$_POST['status_pekerjaan'];
                    $alokasi_anggaran = str_replace(".", "", $alokasi_anggaran);
                    //Cek Apakah Data Progress Sudah Ada Atau Belum
                    $id_anggaran_progress=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'id_anggaran_progress');
                    if(empty($id_anggaran_progress)){
                        //Insert
                        $entry="INSERT INTO anggaran_progress (
                            id_wilayah,
                            id_anggaran,
                            id_anggaran_rincian,
                            status_pekerjaan,
                            alokasi_anggaran,
                            keterangan,
                            updatetime
                        ) VALUES (
                            '$id_wilayah',
                            '$id_anggaran',
                            '$id_anggaran_rincian',
                            '$status_pekerjaan',
                            '$alokasi_anggaran',
                            '$keterangan',
                            '$now'
                        )";
                        $Input=mysqli_query($Conn, $entry);
                        if($Input){
                            $kategori_log="Anggaran";
                            $deskripsi_log="Update Progress Anggaran Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Update Progress Berhasil";
                                echo '<small class="text-success" id="NotifikasiUpdateProgressBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat insert data ke database</small>';
                        }
                    }else{
                        $UpdateProgressAnggaran = mysqli_query($Conn,"UPDATE anggaran_progress SET 
                            status_pekerjaan='$status_pekerjaan',
                            alokasi_anggaran='$alokasi_anggaran',
                            keterangan='$keterangan',
                            updatetime='$now'
                        WHERE id_anggaran_progress='$id_anggaran_progress'") or die(mysqli_error($Conn)); 
                        if($UpdateProgressAnggaran){
                            $kategori_log="Anggaran";
                            $deskripsi_log="Update Progress Anggaran Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Update Progress Berhasil";
                                echo '<small class="text-success" id="NotifikasiUpdateProgressBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data rincian anggaran</small>';
                        }
                    }
                }
            }
        }
    }
?>