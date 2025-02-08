<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'fLpyQfaxuQ');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        if(empty($_GET['id_wilayah'])){
            echo "ID Wilayah Tidak Boleh Kosong";
        }else{
            $id_wilayah=$_GET['id_wilayah'];
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah_demografi WHERE id_wilayah='$id_wilayah'"));
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman yang menampilkan laporan profil demografi.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <?php
                if(empty($jml_data)){
                    echo '<div class="col-md-12">';
                    echo '  <div class="card">';
                    echo '      <div class="card-body text-center">';
                    echo '          Tidak Ada Informasi Demografi Yang Ditemukan';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM wilayah_demografi WHERE id_wilayah='$id_wilayah' ORDER BY periode ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_wilayah_demografi= $data['id_wilayah_demografi'];
                        $id_wilayah= $data['id_wilayah'];
                        $periode= $data['periode'];
                        $demografi= $data['demografi'];
                        $updatetime= $data['updatetime'];
                        $strtotime= strtotime($updatetime);
                        $updatetime=date('d/m/Y H:i:s',$strtotime);
                        //Buka Detail Wilayah
                        $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kategori');
                        $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                        $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                        $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                        $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
            ?>
            </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title" data-bs-toggle="modal" data-bs-target="#ModalDetailDemografi" data-id="<?php echo "$id_wilayah_demografi"; ?>" title="Lihat Detail">
                                Demografi Thn <?php echo "$periode";?></b>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="credit">
                                        <code class="text-dark">
                                            <ul>
                                                <li>
                                                    Provinsi : <?php echo "$ProvinsiWilayah"; ?>
                                                </li>
                                                <li>
                                                    Kabupaten/Kota : <?php echo "$KabupatenWilayah"; ?>
                                                </li>
                                            </ul>
                                        </code>
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <small class="credit">
                                        <code class="text-dark">
                                            <ul>
                                                <li>
                                                    Kecamatan : <?php echo "$KecamatanWilayah"; ?>
                                                </li>
                                                <li>
                                                    Desa/Kelurahan : <?php echo "$DesaWilayah"; ?>
                                                </li>
                                            </ul>
                                        </code>
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <small class="credit">
                                        <code class="text-dark">
                                            <ul>
                                                <li>
                                                    Update: <?php echo "$updatetime"; ?>
                                                </li>
                                            </ul>
                                        </code>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                        $no++; 
                    }
                }
            ?>
        </div>
    </section>
<?php }} ?>