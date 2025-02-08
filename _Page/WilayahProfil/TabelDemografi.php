<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah_demografi WHERE id_wilayah='$SessionIdWilayah'"));
?>
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
            $query = mysqli_query($Conn, "SELECT*FROM wilayah_demografi WHERE id_wilayah='$SessionIdWilayah' ORDER BY periode ASC");
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
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailDemografi" data-id="<?php echo "$id_wilayah_demografi"; ?>">
                                <i class="bi bi-info-circle"></i> Lihat Detail
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditDemografi" data-id="<?php echo "$id_wilayah_demografi"; ?>">
                                <i class="bi bi-pencil"></i> Edit Demografi
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusDemografi" data-id="<?php echo "$id_wilayah_demografi"; ?>">
                                <i class="bi bi-x"></i> Hapus Demografi
                            </a>
                        </li>
                    </ul>
                </div>
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