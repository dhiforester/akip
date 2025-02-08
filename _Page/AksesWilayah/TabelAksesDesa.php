<?php
include "../../_Config/Connection.php";
include "../../_Config/Session.php";
include "../../_Config/Function.php";
include "../../_Config/SettingGeneral.php";
//Time Zone
date_default_timezone_set('Asia/Jakarta');
//Time Now Tmp
$now=date('Y-m-d H:i:s');
if(empty($_POST['id_wilayah'])){
    echo '<div class="row">';
    echo '  <div class="col-md-12 text-center text-danger">';
    echo '      ID Wilayah Tidak Boleh Kosong!';
    echo '  </div>';
    echo '</div>';
}else{
    $id_wilayah=$_POST['id_wilayah'];
    //Buka Nama Kecamatan
    $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
    $JumlahAkses=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akses WHERE id_wilayah='$id_wilayah' AND akses='Desa'"));
    if(empty($JumlahAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Desa Ini Belum Memiliki Akses Pengguna';
        echo '  </div>';
        echo '</div>';
    }else{
        $no=1;
        $QryAkses = mysqli_query($Conn, "SELECT * FROM akses WHERE id_wilayah='$id_wilayah' AND akses='Desa'");
        while ($data = mysqli_fetch_array($QryAkses)) {
            $id_akses= $data['id_akses'];
            $id_akses_entitas= $data['id_akses_entitas'];
            $nama_akses= $data['nama'];
            $kontak_akses= $data['kontak'];
            $email_akses= $data['email'];
            $akses= $data['akses'];
            if(empty( $data['foto'])){
                $url_foto='assets/img/User/No-Image.png';
            }else{
                $foto= $data['foto'];
                $url_foto='assets/img/User/'.$foto.'';
            }
            $datetime_update= $data['updatetime'];
            $strtotime=strtotime($datetime_update);
            $datetime_update=date('d/m/Y H:i',$strtotime);
            $NamaEntitas=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
            //Menghitung Jumlah Izin Akses
            $JumlahFitur = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_ijin WHERE id_akses='$id_akses'"));
            if(!empty($data['id_wilayah'])){
                $id_wilayah= $data['id_wilayah'];
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
        <div class="row mb-3 mt-3 border-1 border-bottom">
            <div class="col-md-1 text-center mb-2">
                <img src="<?php echo "$url_foto";?>" alt="Profile" class="rounded-circle" width="50%">
            </div>
            <div class="col-md-4">
                <code class="text-dark" title="Alamat Email">
                    <i class='bi bi-envelope'></i> <?php echo "$email_akses"; ?>
                </code><br>
                <code class="text-dark" title="Kontak/HP">
                    <i class='bi bi-phone'></i> <?php echo "$kontak_akses"; ?>
                </code>
            </div>
            <div class="col-md-4">
                <code class="text-dark" title="Entitas Akses">
                    <i class='bi bi-tag'></i> <?php echo "$NamaEntitas"; ?>
                </code><br>
                <code class="text-dark" title="Otoritas Wilayah">
                    <i class="bi bi-key"></i> <?php echo "$JumlahFitur Fitur";?>
                </code>
            </div>
            <div class="col-md-3 mb-3">
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-black" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="<?php echo "$id_akses"; ?>">
                        <i class="bi bi-key"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-black" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahIjinAkses" data-id="<?php echo "$id_akses"; ?>">
                        <i class="bi bi-clipboard2-check"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-black" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="<?php echo "$id_akses"; ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-black" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="<?php echo "$id_akses"; ?>">
                        <i class="bi bi-x"></i>
                    </a>
                </div>
            </div>
        </div>
<?php 
                $no++;
            }
        }
    } 
?>