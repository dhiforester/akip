<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman detail desa.';
                echo '  Halaman ini digunakan untuk mempermudah anda pada saat mengelola data akses berdasarkan ID wilayah desa.';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <?php
        if(empty($_GET['id'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12 mt-3">';
            echo '      <div class="card">';
            echo '          <div class="card-body text-center text-danger">';
            echo '              ID Wilayah Tidak Boleh Kosong!';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($_GET['id_kecamatan'])){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12 mt-3">';
                echo '      <div class="card">';
                echo '          <div class="card-body text-center text-danger">';
                echo '              ID Wilayah Kecamatan Tidak Boleh Kosong!';
                echo '          </div>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_wilayah=$_GET['id'];
                $id_kecamatan=$_GET['id_kecamatan'];
                if (!preg_match('/^\d+$/', $id_wilayah)) {
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12 mt-3">';
                    echo '      <div class="card">';
                    echo '          <div class="card-body text-center text-danger">';
                    echo '              ID Wilayah Hanya Boleh Angka!';
                    echo '          </div>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $Provinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                    $Kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                    $Kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                    $Desa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
    ?>
        <div class="row mb-3">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <a href="index.php?Page=AksesWilayahAdmin&Sub=DetailKecamatan&id=<?php echo $id_kecamatan; ?>" class="btn btn-md btn-dark btn-block btn-rounded">
                    <i class="bi bi-chevron-left"></i> Kembali
                </a>
            </div>
        </div>
        <input type="hidden" id="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12"><b>A. Informasi Desa</b></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-3">Provinsi</div>
                            <div class="col col-md-9">
                                <code class="text text-grayish"><?php echo "$Provinsi"; ?></code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-3">Kabupaten/Kota</div>
                            <div class="col col-md-9">
                                <code class="text text-grayish"><?php echo "$Kabupaten"; ?></code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-3">Kecamatan</div>
                            <div class="col col-md-9">
                                <code class="text text-grayish"><?php echo "$Kecamatan"; ?></code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-3">Desa</div>
                            <div class="col col-md-9">
                                <code class="text text-grayish"><?php echo "$Desa"; ?></code>
                            </div>
                        </div>
                        <div class="row mb-3 border-top border-1">
                            <div class="col-md-10 mt-3"><b>B. Akses Desa</b></div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-sm btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahAksesDesa" data-id="<?php echo "$id_wilayah"; ?>">
                                    <i class="bi bi-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="table table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <td align="center"><b>No</b></td>
                                                <td align="center"><b>Nama</b></td>
                                                <td align="center"><b>Kontak</b></td>
                                                <td align="center"><b>Email</b></td>
                                                <td align="center"><b>Option</b></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListAksesKecamatanById">
                                            <!-- Tabel Kecamatan Disini -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }}} ?>
</section>