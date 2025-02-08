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
                //Validasi id_jawaban tidak boleh kosong
                if(empty($_POST['id_evaluasi_jawaban'])){
                    echo '<small class="text-danger">ID Jawaban tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['label_file'])){
                        echo '<small class="text-danger">Label File tidak boleh kosong</small>';
                    }else{
                        if(empty($_FILES['file_name']['name'])){
                            echo '<small class="text-danger">File Tidak Boleh Kosong</small>';
                        }else{
                            $id_evaluasi=$_POST['id_evaluasi'];
                            $id_wilayah=$_POST['id_wilayah'];
                            $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
                            $id_evaluasi_jawaban=$_POST['id_evaluasi_jawaban'];
                            $label_file=$_POST['label_file'];
                            //Validasi File Berkas
                            $nama_gambar=$_FILES['file_name']['name'];
                            $ukuran_gambar = $_FILES['file_name']['size']; 
                            $tipe_gambar = $_FILES['file_name']['type']; 
                            $tmp_gambar = $_FILES['file_name']['tmp_name'];
                            $fileError = $_FILES['file_name']['error'];
                            $fileExt = strtolower(pathinfo($nama_gambar, PATHINFO_EXTENSION));
                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                            $FileNameRand=$key;
                            $Pecah = explode("." , $nama_gambar);
                            $BiasanyaNama=$Pecah[0];
                            $Ext=$Pecah[1];
                            $namabaru = "$FileNameRand.$Ext";
                            $path = "../../assets/img/Bukti/".$namabaru;
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
                            //Apabila validasi upload valid maka simpan di database
                            if($ValidasiGambar!=="Valid"){
                                echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                            }else{
                                //Buka Data Sebelumnya
                                $bukti=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'bukti');
                                if(empty($bukti)){
                                    $dataArray = [
                                        [
                                            "label_file" => $label_file,
                                            "file_name" => $namabaru
                                        ]
                                    ];
                                }else{
                                    $dataArray = json_decode($bukti, true);
                                    $newData = [
                                        "label_file" => $label_file,
                                        "file_name" => $namabaru
                                    ];
                                    $dataArray[] = $newData;
                                }
                                $updatedJson = json_encode($dataArray);
                                $Input = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                                    bukti='$updatedJson',
                                    updatetime='$now'
                                WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'") or die(mysqli_error($Conn));
                                if($Input){
                                    $kategori_log="Evaluasi Desa";
                                    $deskripsi_log="Tambah File Bukti Baru Berhasil";
                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                    if($InputLog=="Success"){
                                        $_SESSION['NotifikasiSwal']="Kirim Jawaban Berhasil";
                                        echo '<small class="text-success" id="NotifikasiUploadLampiranBerhasil">Success</small>';
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
?>