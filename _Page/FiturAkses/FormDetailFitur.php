<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_akses_fitur'])){
        echo '<code>Data tidak diketahui, mungkin proses akan gagal!</code>';
    }else{
        $id_akses_fitur=$_POST['id_akses_fitur'];
        $NamaFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'nama');
        $KategoriFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'kategori');
        $KodeFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'kode');
        $KeteranganFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'keterangan');
        $JumlahPengguna = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_ijin WHERE id_akses_fitur='$id_akses_fitur'"));
?>
        <div class="row mb-3">
            <div class="col-md-4">Nama Fitur</div>
            <div class="col-md-8"><code class="text-dark"><?php echo "$NamaFitur"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Kategori Fitur</div>
            <div class="col-md-8"><code class="text-dark"><?php echo "$KategoriFitur"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Kode Fitur</div>
            <div class="col-md-8"><code class="text-dark"><?php echo "$KodeFitur"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Keterangan</div>
            <div class="col-md-8"><code class="text-dark"><?php echo "$KeteranganFitur"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Pengguna</div>
            <div class="col-md-8"><code class="text-dark"><?php echo "$JumlahPengguna Orang"; ?></code></div>
        </div>
<?php
    }
?>