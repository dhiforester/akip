<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'ezqzXIbCCR');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman informasi anggaran yang ditampilkan berdasarkan tingkat kecamatan';
                    echo '  Anda bisa melihat uraian anggaran masing-masing kecamatan beserta dengan data anggaran pada tingkat desa/kecamatan di bawahnya';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="javascript:void(0);" id="ProsesFilter">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <b class="card-title">Rekapitulasi Anggaran</b>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tahun_anggaran">Pilih Tahun Anggaran</label>
                                            <div class="input-group">
                                                <select name="tahun_anggaran" id="tahun_anggaran" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <?php
                                                        //Menampilkan Tahun Anggaran
                                                        $QryTahunAnggaran = mysqli_query($Conn, "SELECT DISTINCT tahun FROM anggaran_rincian");
                                                        while ($DataTahunAnggaran = mysqli_fetch_array($QryTahunAnggaran)) {
                                                            $tahun= $DataTahunAnggaran['tahun'];
                                                            echo '<option value="'.$tahun.'">'.$tahun.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Tampilkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body" id="TabelAnggaranByKecamatan">
                                <!-- Daftar Kecamatan By Kabupaten -->
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        Pilih Tahun Anggaran Kemudian Tampilkan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>