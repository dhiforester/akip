<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi periode tidak boleh kosong
    if(empty($_POST['periode'])){
        echo '<small class="text-danger">Periode data tidak boleh kosong</small>';
    }else{
        $periode=$_POST['periode'];
        $ValidasiDuplikat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$SessionIdWilayah' AND periode='$periode'"));
        if(!empty($ValidasiDuplikat)){
            echo '<small class="text-danger">Data periode tersebut sudah ada</small>';
        }else{
            if(empty($_POST['target_miskin'])){
                $target_miskin="0";
            }else{
                $target_miskin=$_POST['target_miskin'];
            }
            if(empty($_POST['capaian_miskin'])){
                $capaian_miskin="0";
            }else{
                $capaian_miskin=$_POST['capaian_miskin'];
            }
            if(empty($_POST['target_stunting'])){
                $target_stunting="0";
            }else{
                $target_stunting=$_POST['target_stunting'];
            }
            if(empty($_POST['capaian_stunting'])){
                $capaian_stunting="0";
            }else{
                $capaian_stunting=$_POST['capaian_stunting'];
            }
            if(empty($_POST['target_ikm'])){
                $target_ikm="0";
            }else{
                $target_ikm=$_POST['target_ikm'];
            }
            if(empty($_POST['capaian_ikm'])){
                $capaian_ikm="0";
            }else{
                $capaian_ikm=$_POST['capaian_ikm'];
            }
            if(empty($_POST['target_idm'])){
                $target_idm="0";
            }else{
                $target_idm=$_POST['target_idm'];
            }
            if(empty($_POST['capaian_idm'])){
                $capaian_idm="0";
            }else{
                $capaian_idm=$_POST['capaian_idm'];
            }
            $persen_miskin=($capaian_miskin/$target_miskin)*100;
            $persen_stunting=($capaian_stunting/$target_stunting)*100;
            $persen_ikm=($capaian_ikm/$target_ikm)*100;
            $persen_idm=($capaian_idm/$target_idm)*100;
            //Hitung
            $entry="INSERT INTO target_capaian (
                id_wilayah,
                periode,
                target_miskin,
                capaian_miskin,
                persen_miskin,
                target_stunting,
                capaian_stunting,
                persen_stunting,
                target_ikm,
                capaian_ikm,
                persen_ikm,
                target_idm,
                capaian_idm,
                persen_idm,
                updatetime
            ) VALUES (
                '$SessionIdWilayah',
                '$periode',
                '$target_miskin',
                '$capaian_miskin',
                '$persen_miskin',
                '$target_stunting',
                '$capaian_stunting',
                '$persen_stunting',
                '$target_ikm',
                '$capaian_ikm',
                '$persen_ikm',
                '$target_idm',
                '$capaian_idm',
                '$persen_idm',
                '$now'
            )";
            $Input=mysqli_query($Conn, $entry);
            if($Input){
                $kategori_log="Capaian Target";
                $deskripsi_log="Tambah Capaian Target Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Tambah Capaian Target Berhasil";
                    echo '<small class="text-success" id="NotifikasiTambahCapaianTargetBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>