<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Menangkap data wilayah
    if(empty($_POST['id_wilayah'])){
        echo "<span class='text-danger'>ID Wilayah Tidak Boleh Kosong!!</span>";
    }else{
        if(empty($_POST['kategori'])){
            echo "<span class='text-danger'>Kategori Tidak Boleh Kosong!!</span>";
        }else{
            if(empty($_POST['propinsi'])){
                echo "<span class='text-danger'>Provinsi Tidak Boleh Kosong!!</span>";
            }else{
                $id_wilayah=$_POST['id_wilayah'];
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
                //Melakukan input data
                $UpdateAkses = mysqli_query($Conn,"UPDATE wilayah SET 
                    kategori='$kategori',
                    propinsi='$propinsi',
                    kabupaten='$kabupaten',
                    kecamatan='$kecamatan',
                    desa='$desa'
                WHERE id_wilayah='$id_wilayah'") or die(mysqli_error($Conn)); 
                if($UpdateAkses){
                    echo '<div class="text-success" id="NotifikasiEditRegionalDataBerhasil">Success</div>';
                }else{
                    echo "<div class='text-danger'>Terjadi kesalahan pada saat melakukan update data!</div>";
                }
            }
        }
    }
?>