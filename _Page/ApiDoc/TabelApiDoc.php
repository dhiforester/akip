<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dokumentasi_api"));
?>
<div class="table-responsive">
    <table class="table table-hover table-bordered align-items-center mb-0">
        <thead class="">
            <tr>
                <th class="text-center">
                    <b>No</b>
                </th>
                <th class="text-center">
                    <b>Title/Description</b>
                </th>
                <th class="text-center">
                    <b>Method</b>
                </th>
                <th class="text-center">
                    <b>Date Time</b>
                </th>
                <th class="text-center">
                    <b>Option</b>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(empty($jml_data)){
                    echo '<tr>';
                    echo '  <td colspan="5" class="text-center">';
                    echo '      <span class="text-danger">No Data</span>';
                    echo '  </td>';
                    echo '</tr>';
                }else{
                    $no=1;
                    $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_api FROM dokumentasi_api ORDER BY kategori_api ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori_api=$DataKategori['kategori_api'];
                        echo '<tr>';
                        echo '  <td class="text-left text-xs bg-info text-light"><b>'.$no.'</b></td>';
                        echo '  <td class="text-left text-xs bg-info text-light" colspan="4"><b>'.$kategori_api.'</b></td>';
                        echo '</tr>';
                        //LIST DOKUMENTASI
                        $no2=1;
                        $query = mysqli_query($Conn, "SELECT*FROM dokumentasi_api WHERE kategori_api='$kategori_api' ORDER BY id_dokumentasi_api ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_dokumentasi_api=$data['id_dokumentasi_api'];
                            $updatetime_api=$data['updatetime_api'];
                            $judul_api=$data['judul_api'];
                            $metode_api= $data['metode_api'];
                            $url_api= $data['url_api'];
                            $request_api= $data['request_api'];
                            $response_api= $data['response_api'];
                            //Ubah waktu ke format lokal
                            date_default_timezone_set('Asia/Jakarta');
                            //Ubah STRTOTIME to DATETIME
                            $updatetime_api=date('d/m/y H:i',$updatetime_api);
                    ?>
                        <tr>
                            <td class="text-xs" align="right">
                                <?php echo "$no.$no2" ?>
                            </td>
                            <td class="text-left" align="left">
                                <b><?php echo "<a href='index.php?Page=ApiDoc&Sub=ApiDocViewer&id=$id_dokumentasi_api'>$judul_api</a>";?></b>
                                <br>
                                <small class="credit">
                                    <?php echo "$url_api";?>
                                </small>
                                <br>
                            </td>
                            <td class="text-left text-xs">
                                <?php echo "<small>$metode_api</small>" ?>
                            </td>
                            <td class="text-left text-xs">
                                <?php echo "<small>$updatetime_api</small>" ?>
                            </td>
                            <td align="center">
                                <div class="btn-group">
                                    <a href="index.php?Page=ApiDoc&Sub=ApiDocEditor&id=<?php echo $id_dokumentasi_api;?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>  
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteDocApi" data-id="<?php echo "$id_dokumentasi_api"; ?>">
                                        <i class="bi bi-x"></i>
                                    </button>   
                                </div>
                                
                            </td>
                        </tr>
                <?php
                    $no2++; }$no++;}}
                ?>
        </tbody>
    </table>
</div>