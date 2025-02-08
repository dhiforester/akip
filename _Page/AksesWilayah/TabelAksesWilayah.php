<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //Nama Kecamatan
    $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'"));
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-center">';
        echo '              Tidak Ada Data Desa Yang Ditemukan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
?>
    <div class="card">
        <div class="card-header">
            <b class="card-title">Data Akses Pengguna </b>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <?php
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa' ORDER BY desa");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_wilayah= $data['id_wilayah'];
                        $desa= $data['desa'];
                        $JumlahPengguna = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$id_wilayah'"));
                        if(empty($JumlahPengguna)){
                            $LabelJumlahPengguna='<span class="badge badge-danger">'.$JumlahPengguna.'</span>';
                        }else{
                            $LabelJumlahPengguna='<span class="badge badge-success">'.$JumlahPengguna.'</span>';
                        }
                ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne<?php echo "$id_wilayah"; ?>">
                            <button class="accordion-button collapsed TampilkanAksesDesa" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo "$id_wilayah"; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo "$id_wilayah"; ?>" value="<?php echo "$id_wilayah"; ?>">
                                <?php echo "$no. $desa $LabelJumlahPengguna"; ?>
                            </button>
                        </h2>
                        <div id="collapseOne<?php echo "$id_wilayah"; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo "$id_wilayah"; ?>" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body" id="MenampilkanAksesDesa<?php echo "$id_wilayah"; ?>">
                                <!-- Menampilkan Informasi Kecamatan Disini -->
                            </div>
                        </div>
                    </div>
                <?php $no++;} ?>
            </div>
        </div>
    </div>
    <script>
        $(".TampilkanAksesDesa").click(function() {
            var id_wilayah = $(this).attr('value');
            $('#MenampilkanAksesDesa'+id_wilayah+'').html('Loading...');
            $.ajax({
                type    : 'POST',
                url     : '_Page/AksesWilayah/TabelAksesDesa.php',
                data    : {id_wilayah: id_wilayah},
                success: function(data) {
                    $('#MenampilkanAksesDesa'+id_wilayah+'').html(data);
                }
            });
        });
    </script>
<?php } ?>