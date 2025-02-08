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
?>
    <table class="table">
        <tbody>
            <tr>
                <td>Jumlah Penduduk</td>
                <td><?php echo "$jumlah_penduduk Jiwa"; ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <?php foreach ($gender as $key => $value): ?>
                        - <?php echo $key . ": " . $value . " Jiwa <br>"; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Usia</td>
                <td>
                    <?php foreach ($usia as $key => $value): ?>
                        - <?php echo $key . " Tahun : " . $value . " Jiwa<br>"; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>
                    <?php foreach ($pendidikan as $key => $value): ?>
                        - <?php echo $key . " : " . $value . " Jiwa <br>"; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Sarana</td>
                <td>
                    <?php foreach ($sarana as $item): ?>
                        - <?php echo $item['Nama']; ?>, (<?php echo $item['Jumlah']; ?> <?php echo $item['Satuan']; ?>)<br>
                    <?php endforeach; ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>