<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'n1yaNJ74Bm');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        if(empty($_GET['id_wilayah'])){
            echo "ID Wilayah Tidak Boleh Kosong";
        }else{
            $id_wilayah=$_GET['id_wilayah'];
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$id_wilayah'"));
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman untuk menampilkan capaian target keluarga miskin, pencegahan stunting, kualitas pelayanan publik dan';
                    echo '  index desa membangun.';
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
                    echo '          Tidak Ada Informasi CapaianTarget Yang Ditemukan';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$id_wilayah' ORDER BY periode ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_target_capaian= $data['id_target_capaian'];
                        $id_wilayah= $data['id_wilayah'];
                        $periode= $data['periode'];
                        $persen_miskin= $data['persen_miskin'];
                        $persen_stunting= $data['persen_stunting'];
                        $persen_ikm= $data['persen_ikm'];
                        $persen_idm= $data['persen_idm'];
                        $updatetime= $data['updatetime'];
                        $strtotime= strtotime($updatetime);
                        $updatetime=date('d/m/Y H:i:s',$strtotime);
            ?>
            </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title" data-bs-toggle="modal" data-bs-target="#ModalDetailCapaianTarget" data-id="<?php echo "$id_target_capaian"; ?>" title="Lihat Detail">
                                Capaian Target Thn <?php echo "$periode";?></b>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="credit">
                                        <code class="text-dark">
                                            <ul>
                                                <li title="Capaian Target KK Miskin">
                                                    KK Miskin : <?php echo "$persen_miskin %"; ?>
                                                </li>
                                                <li title="Pencegahan Stunting">
                                                    Stunting : <?php echo "$persen_stunting %"; ?>
                                                </li>
                                            </ul>
                                        </code>
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <small class="credit">
                                        <code class="text-dark">
                                            <ul>
                                                <li title="Capaian IKM">
                                                    IKM : <?php echo "$persen_ikm %"; ?>
                                                </li>
                                                <li title="Capaian IDM">
                                                    IDM : <?php echo "$persen_idm %"; ?>
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