<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    date_default_timezone_set('Asia/Jakarta');
    $now=date('Y-m-d H:i:s');
    //Tangkap Tahun Anggaran
    $JumlahData=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kategori='Kecamatan'"));
    if(empty($JumlahData)){
        echo '<div class="card-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger">';
        echo '          Data Kecamatan Tidak Ditemukan';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
?>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <?php
                $no=1;
                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kategori='Kecamatan' ORDER BY kecamatan ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $ListWilayah= $data['id_wilayah'];
                    $kecamatan= $data['kecamatan'];
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne<?php echo "$ListWilayah"; ?>">
                        <button class="accordion-button collapsed TampilkanAnggaranKecamatan" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo "$ListWilayah"; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo "$ListWilayah"; ?>" value="<?php echo "$ListWilayah"; ?>">
                            <?php echo "$no. $kecamatan"; ?>
                        </button>
                    </h2>
                    <div id="collapseOne<?php echo "$ListWilayah"; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo "$ListWilayah"; ?>" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body" id="TabelAnggaranDesa<?php echo "$ListWilayah"; ?>">
                            <!-- Menampilkan Informasi Kecamatan Disini -->
                        </div>
                    </div>
                </div>
            <?php $no++;} ?>
        </div>
    </div>
<?php } ?>
<script>
    $(".TampilkanAnggaranKecamatan").click(function() {
        var id_wilayah = $(this).attr('value');
        $('#TabelAnggaranDesa'+id_wilayah+'').html('Loading...');
        $.ajax({
            type    : 'POST',
            url     : '_Page/WilayahProfilAdmin/TabelDesa.php',
            data    : {id_wilayah: id_wilayah},
            success: function(data) {
                $('#TabelAnggaranDesa'+id_wilayah+'').html(data);
            }
        });
    });
</script>