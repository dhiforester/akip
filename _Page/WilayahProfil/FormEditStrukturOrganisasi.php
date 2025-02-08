<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_struktur_organisasi'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Struktur Organisasi Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_struktur_organisasi=$_POST['id_struktur_organisasi'];
        //Buka data askes
        $nama=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'nama');
        $jabatan=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'jabatan');
        $NIP=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'NIP');
        $part_of=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'part_of');
?>
    <input type="hidden" name="id_struktur_organisasi" value="<?php echo "$id_struktur_organisasi"; ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="jabatan">Jabatan</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo "$jabatan"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="NIP">NIP</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="NIP" id="NIP" class="form-control" value="<?php echo "$jabatan"; ?>"> 
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="part_of">Atasan</label>
        </div>
        <div class="col-md-8">
            <select name="part_of" id="part_of" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $QrySo = "SELECT * FROM struktur_organisasi WHERE id_wilayah='$SessionIdWilayah'";
                    $DataSo  =mysqli_query($Conn, $QrySo);
                    while($x = mysqli_fetch_array($DataSo)){
                        $IdStrukturOrganisasi= $x["id_struktur_organisasi"];
                        $NamaList= $x["nama"];
                        $JabatanList= $x["jabatan"];
                        if($IdStrukturOrganisasi==$part_of){
                            echo '<option selected value="'.$IdStrukturOrganisasi.'">'.$NamaList.' ('.$JabatanList.')</option>';
                        }else{
                            echo '<option value="'.$IdStrukturOrganisasi.'">'.$NamaList.' ('.$JabatanList.')</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="foto">Foto</label>
        </div>
        <div class="col-md-8">
            <input type="file" name="foto" id="foto" class="form-control">
            <small class="credit">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</small>
        </div>
    </div>
<?php } ?>