<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_wilayah_demografi
    if(empty($_POST['id_wilayah_demografi'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Demografi Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_wilayah_demografi=$_POST['id_wilayah_demografi'];
        //Buka data
        $id_wilayah=getDataDetail($Conn,'wilayah_demografi','id_wilayah_demografi',$id_wilayah_demografi,'id_wilayah');
        $periode=getDataDetail($Conn,'wilayah_demografi','id_wilayah_demografi',$id_wilayah_demografi,'periode');
        $demografi=getDataDetail($Conn,'wilayah_demografi','id_wilayah_demografi',$id_wilayah_demografi,'demografi');
        $updatetime=getDataDetail($Conn,'wilayah_demografi','id_wilayah_demografi',$id_wilayah_demografi,'updatetime');
        //Json
        $data_array = json_decode($demografi, true);
        // Variabel untuk setiap bagian data
        $jumlah_penduduk = $data_array['Jumlah Penduduk'];
        $gender = $data_array['gender'];
        $usia = $data_array['usia'];
        $pendidikan = $data_array['pendidikan'];
        $sarana = $data_array['sarana'];
        //Gender
        $laki_laki = $gender['laki-laki'];
        $perempuan = $gender['perempuan'];
        //Usia
        $usia_1 = $usia['0-17'];
        $usia_2 = $usia['18-56'];
        $usia_3 = $usia['>56'];
        //Pendidikan
        $pendidikan_1 = $pendidikan['Tidak Sekolah'];
        $pendidikan_2 = $pendidikan['Tidak Selesai'];
        $pendidikan_3 = $pendidikan['TK'];
        $pendidikan_4 = $pendidikan['SD'];
        $pendidikan_5 = $pendidikan['SMP'];
        $pendidikan_6 = $pendidikan['SMA'];
        $pendidikan_7 = $pendidikan['D1'];
        $pendidikan_8 = $pendidikan['D2'];
        $pendidikan_9 = $pendidikan['D3'];
        $pendidikan_10 = $pendidikan['S1'];
        $pendidikan_11 = $pendidikan['S2'];
        $pendidikan_12 = $pendidikan['S3'];
?>
    <input type="hidden" name="id_wilayah_demografi" value="<?php echo "$id_wilayah_demografi"; ?>">
    <div class="row mb-3">
        <div class="col-md-4"><label for="periode">Periode Data</label></div>
        <div class="col-md-8">
            <input type="number" readonly min="<?php echo date('Y')-3; ?>" max="<?php echo date('Y'); ?>" name="periode" id="periode" class="form-control" value="<?php echo $periode; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>A. Jumlah Penduduk</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="jumlah_penduduk">A.1 Total Penduduk</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="jumlah_penduduk" id="jumlah_penduduk" class="form-control" value="<?php echo $jumlah_penduduk; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="penduduk_laki_laki">A.2 Laki-Laki</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="penduduk_laki_laki" id="penduduk_laki_laki" class="form-control" value="<?php echo $laki_laki; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="penduduk_perempuan">A.3 Perempuan</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="penduduk_perempuan" id="penduduk_perempuan" class="form-control" value="<?php echo $perempuan; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="usia_1">A.4 Usia 0-17</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="usia_1" id="usia_1" class="form-control" value="<?php echo $usia_1; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="usia_2">A.4 Usia 18-56</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="usia_2" id="usia_2" class="form-control" value="<?php echo $usia_2; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="usia_3">A.5 Usia >56</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="usia_3" id="usia_3" class="form-control" value="<?php echo $usia_3; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>B. Pendidikan</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="tidak_sekolah">B.1 Tidak Sekolah</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="tidak_sekolah" id="tidak_sekolah" class="form-control" value="<?php echo $pendidikan_1; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="tidak_selesai">B.2 Tidak Selesai</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="tidak_selesai" id="tidak_selesai" class="form-control" value="<?php echo $pendidikan_2; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="tk">B.3 TK</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="tk" id="tk" class="form-control" value="<?php echo $pendidikan_3; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="sd">B.4 SD</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="sd" id="sd" class="form-control" value="<?php echo $pendidikan_4; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="smp">B.5 SMP</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="smp" id="smp" class="form-control" value="<?php echo $pendidikan_5; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="sma">B.6 SMA</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="sma" id="sma" class="form-control" value="<?php echo $pendidikan_6; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="d1">B.7 D1</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="d1" id="d1" class="form-control" value="<?php echo $pendidikan_7; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="d2">B.8 D2</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="d2" id="d2" class="form-control" value="<?php echo $pendidikan_8; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="d3">B.9 D3</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="d3" id="d3" class="form-control" value="<?php echo $pendidikan_9; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="s1">B.10 S1</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="s1" id="s1" class="form-control" value="<?php echo $pendidikan_10; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="s2">B.11 S2</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="s2" id="s2" class="form-control" value="<?php echo $pendidikan_11; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="s3">B.10 S3</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="s3" id="s3" class="form-control" value="<?php echo $pendidikan_12; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>C. Sarana Prasarana</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <button type="button" class="btn btn-sm btn-success btn-block" id="add_form_sarana2"><i class="bi bi-plus"></i></button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12" id="FormContainerEdit">
            <?php
                foreach ($sarana as $item){
                    $Nama=$item['Nama'];
                    $Satuan=$item['Satuan'];
                    $Jumlah=$item['Jumlah'];
            ?>
                <div class="input-group mb-3">
                    <input type="text" name="nama_sarana[]" class="form-control" placeholder="Sarana" value="<?php echo "$Nama"; ?>">
                    <input type="text" name="unit_sarana[]" class="form-control" placeholder="Unit" value="<?php echo "$Satuan"; ?>">
                    <input type="number" min="0" name="jumlah_sarana[]" class="form-control" placeholder="Jumlah" value="<?php echo "$Jumlah"; ?>">
                    <button type="button" class="btn btn-sm btn-danger remove_sarana" id="remove_sarana"><i class="bi bi-x"></i></button>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<script>
    //Ketika Muncul Modal Tambah Demografi
    $("#add_form_sarana2").click(function() {
        $("#FormContainerEdit").append('<div class="input-group mb-3"><input type="text" name="nama_sarana[]" class="form-control" placeholder="Sarana"><input type="text" name="unit_sarana[]" class="form-control" placeholder="Unit"><input type="number" name="jumlah_sarana[]" class="form-control" placeholder="Jumlah"><button type="button" class="btn btn-sm btn-danger remove_sarana"><i class="bi bi-x"></i></button></div>');
    });
    $(document).on("click", ".remove_sarana", function() {
        $(this).parent().remove();
    });
</script>