<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM struktur_organisasi WHERE id_wilayah='$SessionIdWilayah'"));
?>
<?php
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Tidak Ada Data Struktur Organisasi Yang Ditemukan';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1;
        //KONDISI PENGATURAN MASING FILTER
        $query = mysqli_query($Conn, "SELECT*FROM struktur_organisasi WHERE id_wilayah='$SessionIdWilayah' ORDER BY nama ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_struktur_organisasi= $data['id_struktur_organisasi'];
            $part_of= $data['part_of'];
            $nama= $data['nama'];
            $jabatan= $data['jabatan'];
            $NIP= $data['NIP'];
            $updatetime= $data['updatetime'];
            $foto= $data['foto'];
            //Mengubah format tanggal
            $strtotime=strtotime($updatetime);
            $updatetime=date('d/m/y H:i:s', $strtotime);
?>
        <div class="row mb-3 border-bottom border-1">
            <div class="col-md-12">
                <b class="text-dark" title="Nama">
                    <?php echo "$no. $nama"; ?>
                </b>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Jabatan: $jabatan"; ?>
                        </code>
                    </li>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "ID: $id_struktur_organisasi"; ?>
                        </code>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "NIP: $NIP"; ?>
                        </code>
                    </li>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Part Of: $part_of"; ?>
                        </code>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Update. $updatetime"; ?>
                        </code>
                    </li>
                    <li>
                        <code class="text-dark">
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditStrukturOrganisasi" data-id="<?php echo $id_struktur_organisasi; ?>">
                                Edit
                            </a> / 
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusStrukturOrganisasi" data-id="<?php echo $id_struktur_organisasi; ?>">
                                Hapus
                            </a>
                        </code>
                    </li>
                </ul>
            </div>
        </div>
    <?php 
                $no++; 
            }
        }
    ?>
</div>