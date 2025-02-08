<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap aksses
    if(empty($_POST['id_akses_entitas'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '         Tidak ada informasi akses yang ditangkap sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses_entitas=$_POST['id_akses_entitas'];
        $akses=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'akses');
        $entitas=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
        $standar_fitur=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
        //Jumlah Akses
        $jumlah_akses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_akses_entitas='$id_akses_entitas'"));
        $data_array = json_decode($standar_fitur, true);
        //Menghitung Jumlah standar fitur
        $data_array = json_decode($standar_fitur, true);
        $JumlahDataArray=count($data_array);
?>
    <div class="row mb-3">
        <div class="col-md-4">
            ID Entitas
        </div>
        <div class="col-md-8 text-right">
            <code class="text-dark"><?php echo "$id_akses_entitas"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Level Akses
        </div>
        <div class="col-md-8 text-right">
            <code class="text-dark"><?php echo "$akses"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Entitas
        </div>
        <div class="col-md-8 text-right">
            <code class="text-dark"><?php echo "$entitas"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Jumlah Pengguna
        </div>
        <div class="col-md-8 text-right">
            <code class="text-dark"><?php echo "$jumlah_akses"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Jumlah Fitur
        </div>
        <div class="col-md-8 text-right">
            <code class="text-dark"><?php echo "$JumlahDataArray Fitur"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            List Fitur
        </div>
        <div class="col-md-12 text-right">
            <code class="text-dark">
                <?php
                    echo "<ul>";
                    foreach ($data_array as $item) {
                        $id_akses_fitur=$item['id_akses_fitur'];
                        $kode=$item['kode'];
                        $nama=$item['nama'];
                        echo "<li>$nama</li>";
                    }
                    echo "</ul>";
                ?>
            </code>
        </div>
    </div>
<?php } ?>