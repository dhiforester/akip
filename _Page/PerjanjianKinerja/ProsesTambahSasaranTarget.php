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
        echo '<code class="text-danger">ID Perjanjian Kinerjas tidak boleh kosong</code>';
    }else{
        //Validasi sasaran tidak boleh kosong
        if(empty($_POST['sasaran'])){
            echo '<code class="text-danger">Sasaran perjanjian tidak boleh kosong</code>';
        }else{
            if(empty($_POST['target'])){
                echo '<code class="text-danger">Target tidak boleh kosong</code>';
            }else{
                if(empty($_POST['satuan'])){
                    echo '<code class="text-danger">Satuan target tidak boleh kosong</code>';
                }else{
                    if(empty(count($_POST['indikator']))){
                        echo '<code class="text-danger">Indikator sasaran tidak boleh kosong</code>';
                    }else{
                        $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
                        $sasaran=$_POST['sasaran'];
                        $target=$_POST['target'];
                        $satuan=$_POST['satuan'];
                        $JumlahIndikator=count($_POST['indikator']);
                        if(empty($JumlahIndikator)){
                            echo '<code class="text-danger">Indikator sasaran tidak boleh kosong</code>';
                        }else{
                            //Validasi Id Evaluasi Hanya Boleh Angka
                            if(!preg_match("/^[0-9]*$/", $id_perjanjian_kinerja)){
                                echo '<code class="text-danger">ID Perjanjian Kinerja Hanya Boleh Angka</code>';
                            }else{
                                if (!preg_match('/^[a-zA-Z.,\s]+$/', $sasaran)) {
                                    echo '<code class="text-danger">Sasaran Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                }else{
                                    if (!preg_match('/^[a-zA-Z.,\s]+$/', $satuan)) {
                                        echo '<code class="text-danger">Satuan Hanya Boleh Terdiri Dari Huruf, Spasi, Titik dan Koma</code>';
                                    }else{
                                        //Membuat JSON
                                        $JumlahAdaData=0;
                                        $jsonList = [];
                                        for($i=0; $i<$JumlahIndikator; $i++){
                                            if(!empty($_POST["indikator"][$i])){
                                                $indikator=$_POST["indikator"][$i];
                                                $IdIndikator=generateRandomString("9");
                                                $jsonList[] = [
                                                    'id' => $IdIndikator,
                                                    'indikator' => $indikator
                                                ];
                                                $JumlahAdaData=$JumlahAdaData+1;
                                            }else{
                                                $JumlahAdaData=$JumlahAdaData+0;
                                            }
                                        }
                                        if(empty($JumlahAdaData)){
                                            echo '<code class="text-danger">Indikator sasaran tidak boleh kosong</code>';
                                        }else{
                                            $jsonOutput = json_encode($jsonList, JSON_PRETTY_PRINT);
                                            //Membuka id evaluasi
                                            $id_evaluasi=getDataDetail($Conn,'perjanjian_kinerja','id_perjanjian_kinerja',$id_perjanjian_kinerja,'id_evaluasi');
                                            $entry="INSERT INTO perjanjian_sasaran (
                                                id_evaluasi,
                                                id_perjanjian_kinerja,
                                                sasaran,
                                                indikator,
                                                target,
                                                satuan_target
                                            ) VALUES (
                                                '$id_evaluasi',
                                                '$id_perjanjian_kinerja',
                                                '$sasaran',
                                                '$jsonOutput',
                                                '$target',
                                                '$satuan'
                                            )";
                                            $Input=mysqli_query($Conn, $entry);
                                            if($Input){
                                                $kategori_log="Perjanjian Kinerja";
                                                $deskripsi_log="Tambah Sasaran Target Berhasil";
                                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                if($InputLog=="Success"){
                                                    $_SESSION['NotifikasiSwal']="Tambah Sasaran Target Perjanjian Kinerja Berhasil";
                                                    echo '<small class="text-success" id="NotifikasiTambahSasaranTargetBerhasil">Success</small>';
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
?>