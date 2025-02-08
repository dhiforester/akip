<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_evaluasi tidak boleh kosong
    if(empty($_POST['id_evaluasi'])){
        echo '<small class="text-danger">ID Evaluasi tidak boleh kosong</small>';
    }else{
        //Validasi id_wilayah tidak boleh kosong
        if(empty($_POST['id_wilayah'])){
            echo '<small class="text-danger">ID Wilayah tidak boleh kosong</small>';
        }else{
            //Validasi id_kriteria_indikator tidak boleh kosong
            if(empty($_POST['id_kriteria_indikator'])){
                echo '<small class="text-danger">ID Kriteria Indikator tidak boleh kosong</small>';
            }else{
                if(empty($_POST['jawaban'])){
                    echo '<small class="text-danger">Jawaban tidak boleh kosong</small>';
                }else{
                    $id_evaluasi=$_POST['id_evaluasi'];
                    $id_wilayah=$_POST['id_wilayah'];
                    $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
                    $jawaban=$_POST['jawaban'];
                    //Cek Duplikasi
                    $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                    $DataJawaban = mysqli_fetch_array($QryJawaban);
                    if(empty($DataJawaban['id_evaluasi_jawaban'])){
                        $id_evaluasi_jawaban="";
                    }else{
                        $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                    }
                    //Explode
                    $explode=explode(',',$jawaban);
                    $jawaban=$explode['0'];
                    $nilai=$explode['1'];
                    //Validasi File Berkas
                    if(!empty($_FILES['file_bukti']['name'])){
                        $nama_gambar=$_FILES['file_bukti']['name'];
                        $ukuran_gambar = $_FILES['file_bukti']['size']; 
                        $tipe_gambar = $_FILES['file_bukti']['type']; 
                        $tmp_gambar = $_FILES['file_bukti']['tmp_name'];
                        $fileError = $_FILES['file_bukti']['error'];
                        $fileExt = strtolower(pathinfo($nama_gambar, PATHINFO_EXTENSION));
                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                        $FileNameRand=$key;
                        $Pecah = explode("." , $nama_gambar);
                        $BiasanyaNama=$Pecah[0];
                        $Ext=$Pecah[1];
                        $namabaru = "$FileNameRand.$Ext";
                        $path = "../../assets/berkas/".$namabaru;
                        $allowedExtensions = array('pdf');
                        if($tipe_gambar == "application/pdf"){
                            if($ukuran_gambar<5000000){
                                if (in_array($fileExt, $allowedExtensions)) {
                                    if(move_uploaded_file($tmp_gambar, $path)){
                                        $ValidasiGambar="Valid";
                                    }else{
                                        $ValidasiGambar="Upload file gambar gagal";
                                    }
                                }else{
                                    $ValidasiGambar="tipe file hanya boleh PDF";
                                }
                            }else{
                                $ValidasiGambar="File gambar tidak boleh lebih dari 5 mb";
                            }
                        }else{
                            $ValidasiGambar="Tipe extension file hanya boleh PDF (Tipe: $tipe_gambar) (Ukuran: $ukuran_gambar) (Filename: $nama_gambar)";
                        }
                    }else{
                        $ValidasiGambar="Valid";
                        $namabaru="";
                    }
                    //Apabila validasi upload valid maka simpan di database
                    if($ValidasiGambar!=="Valid"){
                        echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                    }else{
                        if(empty($id_evaluasi_jawaban)){
                            $status="Dikirim";
                            $entry="INSERT INTO evaluasi_jawaban (
                                id_evaluasi,
                                id_wilayah,
                                id_kriteria_indikator,
                                jawaban,
                                bukti,
                                skor,
                                status,
                                keterangan,
                                updatetime
                            ) VALUES (
                                '$id_evaluasi',
                                '$id_wilayah',
                                '$id_kriteria_indikator',
                                '$jawaban',
                                '$namabaru',
                                '$nilai',
                                '$status',
                                '',
                                '$now'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                        }else{
                            if(empty($namabaru)){
                                $namabaru=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'bukti');
                            }
                            $Input = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                                jawaban='$jawaban',
                                bukti='$namabaru',
                                skor='$nilai',
                                updatetime='$now'
                            WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'") or die(mysqli_error($Conn)); 
                        }
                        if($Input){
                            $kategori_log="Akses";
                            $deskripsi_log="Tambah Akses Baru Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                echo '<small class="text-success" id="NotifikasiKirimJawabanBerhasil">Success</small>';
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
?>