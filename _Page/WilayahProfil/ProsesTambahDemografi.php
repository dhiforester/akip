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
        $ValidasiDuplikat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah_demografi WHERE id_wilayah='$SessionIdWilayah' AND periode='$periode'"));
        if(!empty($ValidasiDuplikat)){
            echo '<small class="text-danger">Data periode tersebut sudah ada</small>';
        }else{
            if(empty($_POST['jumlah_penduduk'])){
                $jumlah_penduduk="0";
            }else{
                $jumlah_penduduk=$_POST['jumlah_penduduk'];
            }
            if(empty($_POST['penduduk_laki_laki'])){
                $penduduk_laki_laki="0";
            }else{
                $penduduk_laki_laki=$_POST['penduduk_laki_laki'];
            }
            if(empty($_POST['penduduk_perempuan'])){
                $penduduk_perempuan="0";
            }else{
                $penduduk_perempuan=$_POST['penduduk_perempuan'];
            }
            if(empty($_POST['usia_1'])){
                $usia_1="0";
            }else{
                $usia_1=$_POST['usia_1'];
            }
            if(empty($_POST['usia_2'])){
                $usia_2="0";
            }else{
                $usia_2=$_POST['usia_2'];
            }
            if(empty($_POST['usia_3'])){
                $usia_3="0";
            }else{
                $usia_3=$_POST['usia_3'];
            }
            if(empty($_POST['tidak_sekolah'])){
                $tidak_sekolah="0";
            }else{
                $tidak_sekolah=$_POST['tidak_sekolah'];
            }
            if(empty($_POST['tidak_selesai'])){
                $tidak_selesai="0";
            }else{
                $tidak_selesai=$_POST['tidak_selesai'];
            }
            if(empty($_POST['tk'])){
                $tk="0";
            }else{
                $tk=$_POST['tk'];
            }
            if(empty($_POST['sd'])){
                $sd="0";
            }else{
                $sd=$_POST['sd'];
            }
            if(empty($_POST['smp'])){
                $smp="0";
            }else{
                $smp=$_POST['smp'];
            }
            if(empty($_POST['sma'])){
                $sma="0";
            }else{
                $sma=$_POST['sma'];
            }
            if(empty($_POST['d1'])){
                $d1="0";
            }else{
                $d1=$_POST['d1'];
            }
            if(empty($_POST['d2'])){
                $d2="0";
            }else{
                $d2=$_POST['d2'];
            }
            if(empty($_POST['d3'])){
                $d3="0";
            }else{
                $d3=$_POST['d3'];
            }
            if(empty($_POST['s1'])){
                $s1="0";
            }else{
                $s1=$_POST['s1'];
            }
            if(empty($_POST['s2'])){
                $s2="0";
            }else{
                $s2=$_POST['s2'];
            }
            if(empty($_POST['s3'])){
                $s3="0";
            }else{
                $s3=$_POST['s3'];
            }
            if(!empty($_POST['nama_sarana'])){
                $nama_sarana=$_POST['nama_sarana'];
                $unit_sarana=$_POST['unit_sarana'];
                $jumlah_sarana=$_POST['jumlah_sarana'];
                $jumlah_data=count($nama_sarana);
                $json_list = array();
                for ($i = 0; $i < $jumlah_data; $i++) {
                    $json_list[] = array(
                        "Nama" => $nama_sarana[$i],
                        "Satuan" => $unit_sarana[$i],
                        "Jumlah" => $jumlah_sarana[$i]
                    );
                }
                $json_output = json_encode($json_list);
            }
            // Data
            $data = array(
                "Jumlah Penduduk" => $jumlah_penduduk,
                "gender" => array(
                    "laki-laki" => $penduduk_laki_laki,
                    "perempuan" => $penduduk_perempuan
                ),
                "usia" => array(
                    "0-17" => $usia_1,
                    "18-56" => $usia_2,
                    ">56" => $usia_3
                ),
                "pendidikan" => array(
                    "Tidak Sekolah" => $tidak_sekolah,
                    "Tidak Selesai" => $tidak_selesai,
                    "TK" => $tk,
                    "SD" => $sd,
                    "SMP" => $smp,
                    "SMA" => $sma,
                    "D1" => $d1,
                    "D2" => $d2,
                    "D3" => $d3,
                    "S1" => $s1,
                    "S2" => $s2,
                    "S3" => $s3,
                ),
                "sarana" => $json_list
            );
            // Mengkonversi data menjadi JSON
            $json = json_encode($data, JSON_PRETTY_PRINT);

            $entry="INSERT INTO wilayah_demografi (
                id_wilayah,
                periode,
                demografi,
                updatetime
            ) VALUES (
                '$SessionIdWilayah',
                '$periode',
                '$json',
                '$now'
            )";
            $Input=mysqli_query($Conn, $entry);
            if($Input){
                $kategori_log="Demografi";
                $deskripsi_log="Tambah Demografi Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Tambah Demografi Berhasil";
                    echo '<small class="text-success" id="NotifikasiTambahDemografiBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>