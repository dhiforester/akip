<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Akses Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_POST['id_akses'];
        $nama=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
        $kontak=getDataDetail($Conn,'akses','id_akses',$id_akses,'kontak');
        $email=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
        $akses=getDataDetail($Conn,'akses','id_akses',$id_akses,'akses');
        $foto=getDataDetail($Conn,'akses','id_akses',$id_akses,'foto');
        $updatetime=getDataDetail($Conn,'akses','id_akses',$id_akses,'updatetime');
        $id_akses_entitas=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_akses_entitas');
        $entitas=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
        $id_wilayah=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_wilayah');
        $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
        if(empty($foto)){
            $url_foto='assets/img/User/No-Image.png';
        }else{
            $url_foto='assets/img/User/'.$foto.'';
        }
        $strtotime=strtotime($updatetime);
        $datetime_update=date('d/m/Y H:i',$strtotime);
        //Menghitung Jumlah Izin Akses
        $JumlahFitur = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_ijin WHERE id_akses='$id_akses'"));
        if(!empty($id_wilayah)){
            if($akses=="Provinsi"){
                $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
            }else{
                if($akses=="Kabupaten"){
                    $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                }else{
                    if($akses=="Kecamatan"){
                        $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                    }else{
                        $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
                    }
                }
            }
            
        }else{
            $id_wilayah="";
            $LabelWilayah='<span class="text-danger">No Data</span>';
        }

?>
    <div class="row mb-3">
        <div class="col-md-4 text-center mb-3">
            <img src="<?php echo "$url_foto"; ?>" alt="" width="50%" class="rounded-circle">
        </div>
        <div class="col-md-8">
            <div class="row mb-3">
                <div class="col-md-12">
                    <table width="100%">
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo $nama; ?></code></td>
                        </tr>
                        <tr>
                            <td>Kontak/HP</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo $kontak; ?></code></td>
                        </tr>
                        <tr>
                            <td>Alamat Email</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo $email; ?></code></td>
                        </tr>
                        <tr>
                            <td>Level Akses</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo "$akses"; ?></code></td>
                        </tr>
                        <tr>
                            <td>Entitas</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo $entitas; ?></code></td>
                        </tr>
                        <tr>
                            <td>Updatetime</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo $datetime_update; ?></code></td>
                        </tr>
                        <tr>
                            <td>Wilayah</td>
                            <td>:</td>
                            <td align="right"><code class="text-dark"><?php echo "$LabelWilayah"; ?></code></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>