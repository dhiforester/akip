<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_referensi_bukti'])){
        echo '<code class="text-danger">ID Lampiran/Bukti tidak boleh kosong</code>';
    }else{
        //Validasi nama_bukti tidak boleh kosong
        if(empty($_POST['nama_bukti'])){
            echo '<code class="text-danger">Nama Lampiran/Bukti tidak boleh kosong</code>';
        }else{
            //Validasi single_multi tidak boleh kosong
            if(empty($_POST['single_multi'])){
                echo '<code class="text-danger">Kategori Parameter tidak boleh kosong</code>';
            }else{
                //Validasi type_bukti tidak boleh kosong
                if(empty($_POST['type_bukti'])){
                    echo '<code class="text-danger">Type File tidak boleh kosong</code>';
                }else{
                    if(empty($_POST['max_file'])){
                        echo '<code class="text-danger">Ukuran Maksimum File tidak boleh kosong</code>';
                    }else{
                        if(empty($_POST['deskripsi'])){
                            $deskripsi="";
                        }else{
                            $deskripsi=$_POST['deskripsi'];
                        }
                        $id_referensi_bukti=$_POST['id_referensi_bukti'];
                        $nama_bukti=$_POST['nama_bukti'];
                        $single_multi=$_POST['single_multi'];
                        $type_bukti=$_POST['type_bukti'];
                        $max_file=$_POST['max_file'];
                        //Validasi max_file Hanya Boleh Angka
                        if(!preg_match("/^[0-9]*$/", $max_file)){
                            echo '<code class="text-danger">Ukuran Maksimum File Hanya Boleh Angka</code>';
                        }else{
                            $JumlahType=count($type_bukti);
                            if(empty($JumlahType)){
                                echo '<code class="text-danger">Anda harus memilih type file yang diperbolehkan</code>';
                            }else{
                                //Buat JSON
                                $DataArray = [];
                                $no=1;
                                foreach ($type_bukti as $type_bukti_list) {
                                    // Menambahkan setiap item ke array data
                                    $DataArray[] = ['id' => $no, 'type' => $type_bukti_list];
                                    $no++;
                                }
                                $jsonData = json_encode($DataArray, JSON_PRETTY_PRINT);
                                $UpdateParameter = mysqli_query($Conn,"UPDATE referensi_bukti SET 
                                    nama_bukti='$nama_bukti',
                                    single_multi='$single_multi',
                                    type_file='$jsonData',
                                    max_file='$max_file',
                                    deskripsi='$deskripsi'
                                WHERE id_referensi_bukti='$id_referensi_bukti'") or die(mysqli_error($Conn)); 
                                if($UpdateParameter){
                                    $kategori_log="Lampiran Bukti";
                                    $deskripsi_log="Edit Lampiran Bukti Berhasil";
                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                    if($InputLog=="Success"){
                                        echo '<small class="text-success" id="NotifikasiEditLampiranBuktiBerhasil">Success</small>';
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