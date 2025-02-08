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
        if(empty($_POST['id_anggaran_rab'])){
            echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
        }else{
            //Validasi Kode RAB tidak boleh kosong
            if(empty($_POST['id_anggaran'])){
                echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
            }else{
                //Validasi kode_rab tidak boleh kosong
                if(empty($_POST['kode_rab'])){
                    echo '<small class="text-danger">Kode RAB tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['kategori_program'])){
                        echo '<small class="text-danger">Kategori Program tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['uraian'])){
                            echo '<small class="text-danger">Uraian RAB tidak boleh kosong</small>';
                        }else{
                            if(empty($_POST['volume'])){
                                echo '<small class="text-danger">Volume tidak boleh kosong</small>';
                            }else{
                                if(empty($_POST['satuan'])){
                                    echo '<small class="text-danger">Satuan tidak boleh kosong</small>';
                                }else{
                                    if(empty($_POST['harga'])){
                                        echo '<small class="text-danger">Harga tidak boleh kosong</small>';
                                    }else{
                                        $id_anggaran_rab=$_POST['id_anggaran_rab'];
                                        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
                                        $id_anggaran=$_POST['id_anggaran'];
                                        $kode_rab=$_POST['kode_rab'];
                                        $kategori_program=$_POST['kategori_program'];
                                        $uraian=$_POST['uraian'];
                                        $volume=$_POST['volume'];
                                        $satuan=$_POST['satuan'];
                                        $harga=$_POST['harga'];
                                        //Validasi Karakter Angka
                                        if(!preg_match("/^[0-9]*$/", $volume)){
                                            echo '<small class="text-danger">Volume Hanya Boleh Berformat Angka</small>';
                                        }else{
                                            if(!preg_match("/^[0-9]*$/", $harga)){
                                                echo '<small class="text-danger">Harga Hanya Boleh Berformat Angka</small>';
                                            }else{
                                                $jumlah=$harga*$volume;
                                                $UpdateRab = mysqli_query($Conn,"UPDATE anggaran_rab SET 
                                                    kode_rab='$kode_rab',
                                                    kategori_program='$kategori_program',
                                                    uraian='$uraian',
                                                    volume='$volume',
                                                    satuan='$satuan',
                                                    harga='$harga',
                                                    jumlah='$jumlah'
                                                WHERE id_anggaran_rab='$id_anggaran_rab'") or die(mysqli_error($Conn)); 
                                                if($UpdateRab){
                                                    //Hitung Ulang jumlah rincian
                                                    $SqlJumlah = "SELECT SUM(jumlah) AS total FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian'";
                                                    $result = $Conn->query($SqlJumlah);
                                                    // Periksa apakah hasil kueri tersedia
                                                    if ($result->num_rows > 0) {
                                                        $row = $result->fetch_assoc();
                                                        $anggaran=$row['total'];
                                                    } else {
                                                        $anggaran =0;
                                                    }
                                                    //Update Anggaran
                                                    $UpdateAnggaran = mysqli_query($Conn,"UPDATE anggaran_rincian SET 
                                                        volume='',
                                                        satuan='',
                                                        anggaran='$anggaran'
                                                    WHERE id_anggaran_rincian='$id_anggaran_rincian'") or die(mysqli_error($Conn)); 
                                                    if($UpdateAnggaran){
                                                        $kategori_log="Anggaran";
                                                        $deskripsi_log="Edit RAB Anggaran Berhasil";
                                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                        if($InputLog=="Success"){
                                                            echo '<small class="text-success" id="NotifikasiEditRabBerhasil">Success</small>';
                                                        }else{
                                                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                                        }
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat update rincian anggaran</small>';
                                                    }
                                                }else{
                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data rincian anggaran</small>';
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