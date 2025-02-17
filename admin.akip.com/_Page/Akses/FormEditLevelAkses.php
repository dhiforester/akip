<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '
            <div class="alert alert-danger text-center">ID Akses Tidak Boleh Kosong!</div>
        ';
    }else{
        if(empty($SessionIdAkses)){
            echo '
                <div class="alert alert-danger text-center">Sesi Akses Sudah Berakhir! Silahkan Login Ulang!</div>
            ';
        }else{
            $id_akses=$_POST['id_akses'];
            //Buka Data Akses
            $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses= ?");
            $Qry->bind_param("s", $id_akses);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data Akses.<br>Error : '.$error.'</div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_akses'])){
                    echo '
                        <div class="alert alert-danger text-center">Data Akses Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                    ';
                }else{
                    //Buka Data
                    $nama=$Data['nama'];
                    $email=$Data['email'];
                    $kontak=$Data['kontak'];
                    $akses=$Data['akses'];
                    echo '
                        <div class="row mb-3">
                            <div class="col-4"><small>Nama User</small></div>
                            <div class="col-8 text-end"><small class="text-grayish">'.$nama.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Alamat Email</small></div>
                            <div class="col-8 text-end"><small class="text-grayish">'.$email.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Nomor Kontak</small></div>
                            <div class="col-8 text-end"><small class="text-grayish">'.$kontak.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Level Akses</small></div>
                            <div class="col-8 text-end"><small class="text-grayish">'.$akses.'</small></div>
                        </div>
                    ';
                    //Buka Informasi Akses Berdasarkan Level Akses
                    if($akses=="Provinsi"){
                        // Query untuk mengambil data provinsi dan nama provinsi sekaligus
                        $QryProvinsi = $Conn->prepare("
                        SELECT ap.id_provinsi, wp.provinsi 
                        FROM akses_provinsi ap
                        JOIN wilayah_provinsi wp ON ap.id_provinsi = wp.id_provinsi
                        WHERE ap.id_akses = ?
                        ");
                        $QryProvinsi->bind_param("i", $id_akses);

                        if (!$QryProvinsi->execute()) {
                            echo '
                                <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data Provinsi.<br>Error : '.$Conn->error.'</div>
                            ';
                        } else {
                            $ResultProvinsi = $QryProvinsi->get_result();
                            $DataProvinsi = $ResultProvinsi->fetch_assoc();
                            $QryProvinsi->close();

                            if (empty($DataProvinsi)) {
                                echo '
                                    <div class="alert alert-danger text-center">Data Provinsi Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                                ';
                            } else {
                                $provinsi = $DataProvinsi['provinsi'];
                                echo '
                                    <div class="row mb-3 border-1 border-top">
                                        <div class="col-4 mt-3"><small>Level Akses</small></div>
                                        <div class="col-8 mt-3 text-end"><small class="text-grayish">'.$akses.'</small></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4"><small>Provinsi</small></div>
                                        <div class="col-8 text-end"><small class="text-grayish">'.$provinsi.'</small></div>
                                    </div>
                                ';
                            }
                        }
                    }else{
                        if($akses=="Kabupaten"){
                            // Query untuk mengambil data kabupaten/kota, id_provinsi, dan nama provinsi sekaligus
                            $QryProvinsi = $Conn->prepare("
                            SELECT ak.id_provinsi, ak.id_kabkot, wk.kabkot, wp.provinsi 
                            FROM akses_kabupaten ak
                            JOIN wilayah_kabkot wk ON ak.id_kabkot = wk.id_kabkot
                            JOIN wilayah_provinsi wp ON ak.id_provinsi = wp.id_provinsi
                            WHERE ak.id_akses = ?
                            ");
                            $QryProvinsi->bind_param("i", $id_akses);

                            if (!$QryProvinsi->execute()) {
                                echo '
                                    <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data Kabupaten/Kota.<br>Error : '.$Conn->error.'</div>
                                ';
                            } else {
                                $ResultProvinsi = $QryProvinsi->get_result();
                                $DataProvinsi = $ResultProvinsi->fetch_assoc();
                                $QryProvinsi->close();

                                if (empty($DataProvinsi)) {
                                    echo '
                                        <div class="alert alert-danger text-center">Data Kabupaten/Kota Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                                    ';
                                } else {
                                    $kabupaten = $DataProvinsi['kabkot'];
                                    $id_provinsi = $DataProvinsi['id_provinsi'];
                                    $provinsi = $DataProvinsi['provinsi']; // Ambil nama provinsi dari hasil query
                                    echo '
                                        <div class="row mb-3 border-1 border-top">
                                            <div class="col-4 mt-3"><small>Level Akses</small></div>
                                            <div class="col-8 mt-3 text-end"><small class="text-grayish">'.$akses.'</small></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4"><small>Provinsi</small></div>
                                            <div class="col-8 text-end"><small class="text-grayish">'.$provinsi.'</small></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4"><small>Kabupaten/Kota</small></div>
                                            <div class="col-8 text-end"><small class="text-grayish">'.$kabupaten.'</small></div>
                                        </div>
                                    ';
                                }
                            }
                        }else{
                            if($akses=="Inspektorat"){
                                // Query untuk mengambil data provinsi, kabupaten/kota, dan nama inspektorat
                                $QryInspektorat = $Conn->prepare("
                                SELECT ai.id_akses, i.nama_inspektorat, wp.provinsi, wk.kabkot 
                                FROM akses_inspektorat ai
                                JOIN inspektorat i ON ai.id_inspektorat = i.id_inspektorat
                                JOIN wilayah_provinsi wp ON i.id_provinsi = wp.id_provinsi
                                JOIN wilayah_kabkot wk ON i.id_kabkot = wk.id_kabkot
                                WHERE ai.id_akses = ?
                                ");
                                $QryInspektorat->bind_param("i", $id_akses);

                                if (!$QryInspektorat->execute()) {
                                echo '
                                    <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data Inspektorat.<br>Error : '.$Conn->error.'</div>
                                ';
                                } else {
                                $ResultInspektorat = $QryInspektorat->get_result();
                                $DataInspektorat = $ResultInspektorat->fetch_assoc();
                                $QryInspektorat->close();

                                if (empty($DataInspektorat)) {
                                    echo '
                                        <div class="alert alert-danger text-center">Data Inspektorat Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                                    ';
                                } else {
                                    $nama_inspektorat = $DataInspektorat['nama_inspektorat'];
                                    $provinsi = $DataInspektorat['provinsi'];
                                    $kabkot = $DataInspektorat['kabkot'];
                                    echo '
                                        <div class="row mb-3 border-1 border-top">
                                            <div class="col-4 mt-3"><small>Level Akses</small></div>
                                            <div class="col-8 mt-3 text-end"><small class="text-grayish">'.$akses.'</small></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4"><small>Provinsi</small></div>
                                            <div class="col-8 text-end"><small class="text-grayish">'.$provinsi.'</small></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4"><small>Kabupaten/Kota</small></div>
                                            <div class="col-8 text-end"><small class="text-grayish">'.$kabkot.'</small></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4"><small>Nama Inspektorat</small></div>
                                            <div class="col-8 text-end"><small class="text-grayish">'.$nama_inspektorat.'</small></div>
                                        </div>
                                    ';
                                }
                                }
                            }else{
                                if($akses=="OPD"){
                                    // Query untuk mengambil data provinsi, kabupaten/kota, inspektorat, dan OPD
                                    $QryOPD = $Conn->prepare("
                                    SELECT 
                                        ao.id_akses, 
                                        o.nama_opd, 
                                        wp.provinsi, 
                                        wk.kabkot
                                    FROM akses_opd ao
                                    JOIN opd o ON ao.id_opd = o.id_opd
                                    JOIN wilayah_provinsi wp ON o.id_provinsi = wp.id_provinsi
                                    JOIN wilayah_kabkot wk ON o.id_kabkot = wk.id_kabkot
                                    WHERE ao.id_akses = ?
                                    ");
                                    $QryOPD->bind_param("i", $id_akses);

                                    if (!$QryOPD->execute()) {
                                        echo '
                                            <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data OPD.<br>Error : '.$Conn->error.'</div>
                                        ';
                                    } else {
                                        $ResultOPD = $QryOPD->get_result();
                                        $DataOPD = $ResultOPD->fetch_assoc();
                                        $QryOPD->close();

                                        if (empty($DataOPD)) {
                                            echo '
                                                <div class="alert alert-danger text-center">Data OPD Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                                            ';
                                        } else {
                                            $nama_opd = $DataOPD['nama_opd'];
                                            $provinsi = $DataOPD['provinsi'];
                                            $kabkot = $DataOPD['kabkot'];
                                            echo '
                                                <div class="row mb-3 border-1 border-top">
                                                    <div class="col-4 mt-3"><small>Level Akses</small></div>
                                                    <div class="col-8 mt-3 text-end"><small class="text-grayish">'.$akses.'</small></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4"><small>Provinsi</small></div>
                                                    <div class="col-8 text-end"><small class="text-grayish">'.$provinsi.'</small></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4"><small>Kabupaten/Kota</small></div>
                                                    <div class="col-8 text-end"><small class="text-grayish">'.$kabkot.'</small></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4"><small>OPD</small></div>
                                                    <div class="col-8 text-end"><small class="text-grayish">'.$nama_opd.'</small></div>
                                                </div>
                                            ';
                                        }
                                    }
                                }
                            }
                        }
                    }
?>
                    <input type="hidden" name="id_akses" value="<?php echo $id_akses; ?>">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="akses_edit">Akses Baru</label>
                        </div>
                        <div class="col-8">
                            <select name="akses" id="akses_edit" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Admin">Admin</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kabupaten">Kabupaten/Kota</option>
                                <option value="Inspektorat">Inspektorat</option>
                                <option value="OPD">OPD</option>
                            </select>
                        </div>
                    </div>
                    <div id="FormPilihWilayahEdit">
                        <!-- Menampilkan Form Wilayah -->
                    </div>
<?php
                }
            }
        }
    }
?>
<script>
    //Ketika Akses Diubah, Tampilkan Wilayah
    $('#akses_edit').change(function(){
        var akses = $('#akses_edit').val();
        $('#FormPilihWilayahEdit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/FormPilihWilayah.php',
            data 	    :  {akses: akses},
            success     : function(data){
                $('#FormPilihWilayahEdit').html(data);
            }
        });
    });
</script>