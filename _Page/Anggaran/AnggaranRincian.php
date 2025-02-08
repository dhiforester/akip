<section class="section dashboard">
    <?php
        if(empty($_GET['id'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '          ID Periode Anggaran Tidak Boleh Kosong!';
            echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggaran=$_GET['id'];
            //Buka Infromasi Periode Anggaran
            $periode_awal=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_awal');
            $periode_akhir=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_akhir');
    ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Berikut ini adalah halaman untuk mengelola rincian anggaran yang di uraikan per tahun.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form action="javascript:void(0);" class="mt-3" id="ProsesFilterRincianAnggaran">
                            <input type="hidden" id="id_anggaran" name="id_anggaran" value="<?php echo "$id_anggaran"; ?>">
                            <input type="hidden" id="id_wilayah" name="id_wilayah" value="<?php echo "$SessionIdWilayah"; ?>">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <b class="card-title">Periode Anggaran <?php echo "$periode_awal s/d $periode_akhir"; ?></b><br>
                                    <a href="index.php?Page=Anggaran">
                                        <small class="credit">
                                            <i class="bi bi-chevron-left"></i> Kembali Ke Anggaran
                                        </small>
                                    </a>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <select name="tahun_anggaran" id="tahun_anggaran" class="form-control">
                                        <?php
                                            for ($year = $periode_awal; $year <= $periode_akhir; $year++) {
                                                echo '<option value="'.$year.'">'.$year.'</option>';
                                            }
                                        ?>
                                    </select>
                                    <small>Periode</small>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" class="btn btn-md btn-info btn-block" data-bs-toggle="modal" data-bs-target="#ModalExportRincianAnggaran" data-id="<?php echo "$id_anggaran"; ?>" title="Ekport Rincian Anggaran">
                                        <i class="bi bi-download"></i> Export
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    //Informasi Reverensi
                                    $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kategori');
                                    $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                                    $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                                    $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                                    $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
                                ?>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Provinsi</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$ProvinsiWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                <div class="col col-md-3">Kabupaten/Kota</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$KabupatenWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                <div class="col col-md-3">Kecamatan</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$KecamatanWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Kelurahan/Desa</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$DesaWilayah"; ?></code></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="MenampilkanTabelRincianAnggaran">

                            </div>
                        </div>
                        <!-- Menampilkan Tabel Rincian Anggaran Disini -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
