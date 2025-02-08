<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_capaian tidak boleh kosong
    if(empty($_POST['id_capaian'])){
        echo '<code class="text-danger">ID Capaian tidak boleh kosong</code>';
    }else{
        //Validasi indikator tidak boleh kosong
        if(empty($_POST['indikator'])){
            echo '<code class="text-danger">Indikator tidak boleh kosong</code>';
        }else{
            $id_capaian=$_POST['id_capaian'];
            $indikator=$_POST['indikator'];
            if(empty($_POST['jumlah'])){
                $jumlah=0;
            }else{
                $jumlah=$_POST['jumlah'];
            }
            if(empty($_POST['target'])){
                $target=0;
            }else{
                $target=$_POST['target'];
            }
            if(empty($_POST['capaian'])){
                $capaian=0;
            }else{
                $capaian=$_POST['capaian'];
            }
            if(!preg_match("/^[0-9]*$/", $id_capaian)){
                echo '<code class="text-danger">ID capaian Hanya Boleh Angka</code>';
            }else{
                $pattern = "/^[0-9.]*$/";
                if (!preg_match($pattern, $jumlah)) {
                    echo '<code class="text-danger">Jumlah hanya boleh angka dan desimal</code>';
                }else{
                    if (!preg_match($pattern, $target)) {
                        echo '<code class="text-danger">Target hanya boleh angka dan desimal</code>';
                    }else{
                        if (!preg_match($pattern, $capaian)) {
                            echo '<code class="text-danger">Capaian hanya boleh angka dan desimal</code>';
                        }else{
                            //Menghitung Persentase
                            $persentase=HitungPersentase($indikator,$jumlah,$target,$capaian);
                            $Update = mysqli_query($Conn,"UPDATE capaian SET 
                                indikator='$indikator',
                                jumlah='$jumlah',
                                target='$target',
                                capaian='$capaian',
                                persentase='$persentase',
                                status='Dikirim',
                                updatetime='$now'
                            WHERE id_capaian='$id_capaian'") or die(mysqli_error($Conn)); 
                            if($Update){
                                $kategori_log="Capaian";
                                $deskripsi_log="Edit Capaian Berhasil";
                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                if($InputLog=="Success"){
                                    $_SESSION['NotifikasiSwal']="Edit Capaian Berhasil";
                                    echo '<small class="text-success" id="NotifikasiEditCapaianBerhasil">Success</small>';
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