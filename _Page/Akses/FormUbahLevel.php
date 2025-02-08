<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $id_mitra = $DataDetailAkses['id_mitra'];
        $nama_akses= $DataDetailAkses['nama_akses'];
        $kontak_akses= $DataDetailAkses['kontak_akses'];
        $email_akses = $DataDetailAkses['email_akses'];
        $password= $DataDetailAkses['password'];
        $Akses= $DataDetailAkses['akses'];
        $gambar= $DataDetailAkses['image_akses'];
        if(empty($gambar)){
            $gambar="No-Image.png";
        }else{
            $gambar="$gambar";
        }
        $akses= $DataDetailAkses['akses'];
        $status= $DataDetailAkses['status'];
        $datetime_daftar= $DataDetailAkses['datetime_daftar'];
        $datetime_update= $DataDetailAkses['datetime_update'];
        $registration=$datetime_daftar;
        $updatetime=$datetime_update;
?>
    <input type="hidden" name="id_akses" id="id_akses_edit" value="<?php echo "$id_akses"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="akses_edit">Grup Akses</label>
            <select name="akses_edit" id="akses_edit" class="form-control">
                <?php
                    //Menampilkan Entitas
                    $query = mysqli_query($Conn, "SELECT DISTINCT akses FROM akses_entitas WHERE mitra='Tidak'");
                    while ($data = mysqli_fetch_array($query)) {
                        if(!empty($data['akses'])){
                            $akses_list= $data['akses'];
                            if($akses_list==$akses){
                                echo '  <option selected value="'.$akses_list.'">'.$akses_list.'</option>';
                            }else{
                                echo '  <option value="'.$akses_list.'">'.$akses_list.'</option>';
                            }
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiUbahLevel">
            <small class="text-primary">Pastikan data yang anda input sudah sesuai</small>
        </div>
    </div>
<?php } ?>