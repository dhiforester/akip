<section class="section dashboard">
    <?php
        if(empty($_GET['id_wilayah'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '         ID Wilayah Tidak Boleh Kosong';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_wilayah=$_GET['id_wilayah'];
            //Validasi ID
            if (!is_numeric($id_wilayah)) {
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12">';
                echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '         ID Wilayah Tidak Valid';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }else{
                $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                if(empty($NamaKabupaten)){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo '         ID Wilayah Tidak Ditemukan Pada Database';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row border-1 border-bottom mb-3">
                            <div class="col-md-12 text-center">
                                <h2><b>DRAFT PARAMETER BIDANG DAN KEGIATAN</b></h2>
                            </div>
                        </div>
                        <div class="row mb-3 border-1 border-bottom">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        <b>ID.Kab :</b> <code class="text-info" id="GetIdWilayah"><?php echo "$id_wilayah"; ?></code>
                                    </li>
                                    <li>
                                        <b>Kab/Kot :</b> <code class="text-info"><?php echo "$NamaKabupaten"; ?></code>
                                    </li>
                                    <li>
                                        <b>Provinsi :</b> <code class="text-info"><?php echo "$NamaPropinsi"; ?></code>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mt-3"></div>
                            <div class="col-md-2 mt-3">
                                <a href="index.php?Page=BidangKegiatan" class="btn btn-md btn-dark btn-block btn-rounded" title="Kembali Ke Halaman Sebelumnya">
                                    <i class="bi bi-chevron-left"></i> Kembali
                                </a>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterDraft" data-id="<?php echo "$id_wilayah"; ?>" title="Filter Data">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahBidang" data-id="<?php echo "$id_wilayah"; ?>" title="Tambah Bidang Tingkat Kabupaten">
                                    <i class="bi bi-plus"></i> Tambah Bidang
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12" id="TabelBidangByKabupaten">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }}} ?>
</section>