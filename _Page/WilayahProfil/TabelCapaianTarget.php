<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$SessionIdWilayah'"));
?>
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
            $query = mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$SessionIdWilayah' ORDER BY periode ASC");
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
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailCapaianTarget" data-id="<?php echo "$id_target_capaian"; ?>">
                                <i class="bi bi-info-circle"></i> Lihat Detail
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditCapaianTarget" data-id="<?php echo "$id_target_capaian"; ?>">
                                <i class="bi bi-pencil"></i> Edit Capaian Target
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusCapaianTarget" data-id="<?php echo "$id_target_capaian"; ?>">
                                <i class="bi bi-x"></i> Hapus Capaian Target
                            </a>
                        </li>
                    </ul>
                </div>
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