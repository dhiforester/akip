<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="card-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger">';
        echo '          ID Evaluasi Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_evaluasi=$_POST['id_evaluasi'];
        $JumlahKecamatan=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kategori='Kecamatan' ORDER BY kecamatan ASC"));
        if(empty($JumlahKecamatan)){
            echo '<div class="card-body">';
            echo '  <div class="row">';
            echo '      <div class="col-md-12 text-center text-danger">';
            echo '          Tidak Ada Data Kecamatan Pada Otoritas Yang Anda Gunakan, Periksa Pengaturan Untuk Masalah Ini';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
?>
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <?php
                    $no=1;
                    $QryKecamatan = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kategori='Kecamatan' ORDER BY kecamatan ASC");
                    while ($DataKecamatan = mysqli_fetch_array($QryKecamatan)) {
                        $id_wilayah= $DataKecamatan['id_wilayah'];
                        $propinsi= $DataKecamatan['propinsi'];
                        $kabupaten= $DataKecamatan['kabupaten'];
                        $kecamatan= $DataKecamatan['kecamatan'];
                        //Menghitung Jumlah 
                        $query = "SELECT COUNT(*) AS total FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kecamatan='$kecamatan' AND kategori='desa'";
                        $result = mysqli_query($Conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $JumlahDesa = $row['total'];
                ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne<?php echo "$id_wilayah"; ?>">
                            <button class="accordion-button collapsed TampilkanAnggaranKecamatan" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo "$id_wilayah"; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo "$id_wilayah"; ?>" value="<?php echo "$id_wilayah"; ?>">
                                <?php echo "$no. $kecamatan"; ?> 
                                <?php 
                                    if(empty($JumlahDesa)){
                                        echo '<span class="badge badge-danger">0</span>';
                                    }else{
                                        echo '<span class="badge badge-success">'.$JumlahDesa.'</span>';
                                    }
                                ?>
                            </button>
                        </h2>
                        <div id="collapseOne<?php echo "$id_wilayah"; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo "$id_wilayah"; ?>" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body" id="TabelAnggaranDesa<?php echo "$id_wilayah"; ?>">
                                <!-- Menampilkan Informasi Kecamatan Disini -->
                            </div>
                        </div>
                    </div>
                <?php $no++;} ?>
            </div>
        </div>
<?php 
        }
    }
?>
<script>
    $(".TampilkanAnggaranKecamatan").click(function() {
        var id_wilayah = $(this).attr('value');
        var id_evaluasi ="<?php echo "$id_evaluasi"; ?>";
        $('#TabelAnggaranDesa'+id_wilayah+'').html('Loading...');
        $.ajax({
            type    : 'POST',
            url     : '_Page/Evaluasi/TabelDesa.php',
            data    : {id_wilayah: id_wilayah, id_evaluasi: id_evaluasi},
            success: function(data) {
                $('#TabelAnggaranDesa'+id_wilayah+'').html(data);
            }
        });
    });
</script>