<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Menangkap data wilayah
    if(empty($_POST['kategori'])){
        echo "<span class='text-danger'>Kategori Tidak Boleh Kosong!!</span>";
    }else{
        if(empty($_POST['propinsi'])){
            echo "<span class='text-danger'>Provinsi Tidak Boleh Kosong!!</span>";
        }else{
            $kategori=$_POST['kategori'];
            $propinsi=$_POST['propinsi'];
            if(empty($_POST['kabupaten'])){
                $kabupaten="";
            }else{
                $kabupaten=$_POST['kabupaten'];
            }
            if(empty($_POST['kecamatan'])){
                $kecamatan="";
            }else{
                $kecamatan=$_POST['kecamatan'];
            }
            if(empty($_POST['desa'])){
                $desa="";
            }else{
                $desa=$_POST['desa'];
            }
            //Validasi Duplikasi Data
            if($kategori=="Propinsi"){
                $ValidasiDataDuplikat= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='$kategori' AND propinsi='$propinsi'"));
            }else{
                if($kategori=="Kabupaten"){
                    $ValidasiDataDuplikat= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='$kategori' AND propinsi='$propinsi' AND kabupaten='$kabupaten'"));
                }else{
                    if($kategori=="Kecamatan"){
                        $ValidasiDataDuplikat= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='$kategori' AND propinsi='$propinsi' AND kabupaten='$kabupaten' AND kecamatan='$kecamatan'"));
                    }else{
                        if($kategori=="Desa"){
                            $ValidasiDataDuplikat= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='$kategori' AND propinsi='$propinsi' AND kabupaten='$kabupaten' AND kecamatan='$kecamatan' AND desa='$desa'"));
                        }
                    }
                }
            }
            if(!empty($ValidasiDataDuplikat)){
                echo "<div class='text-danger'>Data Tersebut Sudah Ada!!</div>";
            }else{
                $QryIdWilayah=mysqli_query($Conn, "SELECT max(id_wilayah) as id_wilayah FROM wilayah")or die(mysqli_error($Conn));
                while($HasilNilai=mysqli_fetch_array($QryIdWilayah)){
                    $id_wilayah_max=$HasilNilai['id_wilayah'];
                }
                $id_wilayah=$id_wilayah_max+1;
                //Melakukan input data
                $entry="INSERT INTO wilayah (
                    id_wilayah,
                    kategori,
                    propinsi,
                    kabupaten,
                    kecamatan,
                    desa
                ) VALUES (
                    '$id_wilayah',
                    '$kategori',
                    '$propinsi',
                    '$kabupaten',
                    '$kecamatan',
                    '$desa'
                )";
                $Input=mysqli_query($Conn, $entry);
                if($Input){
                    $_SESSION ["NotifikasiSwal"]="Tambah Wilayah Berhasil";
                    echo '<div class="text-success" id="NotifikasiTambahRegionalDataBerhasil">Success</div>';
                }else{
                    echo "<div class='text-danger'>Terjadi kesalahan pada saat menyimpan data!!</div>";
                }
            }
        }
    }
?>