<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM referensi_bukti WHERE hapus='Tidak'"));
    if(empty($jml_data)){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Referensi Belum Terseedia';
        echo '  </div>';
        echo '</div>';
    }
    $no=1;
    $query = mysqli_query($Conn, "SELECT * FROM referensi_bukti WHERE hapus='Tidak' ORDER BY id_referensi_bukti ASC");
    while ($data = mysqli_fetch_array($query)) {
        $id_referensi_bukti= $data['id_referensi_bukti'];
        $nama_bukti= $data['nama_bukti'];
        $single_multi= $data['single_multi'];
        $type_file= $data['type_file'];
        $deskripsi= $data['deskripsi'];
        $max_file= $data['max_file'];
        $DataArray = json_decode($type_file, true);
        $Referensi = [
            ['name' => 'PDF', 'type' => 'application/pdf'],
            ['name' => 'XLS', 'type' => 'application/vnd.ms-excel'],
            ['name' => 'XLSX', 'type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            ['name' => 'CSV1', 'type' => 'text/csv'],
            ['name' => 'CSV2', 'type' => 'application/csv'],
            ['name' => 'CSV3', 'type' => 'text/plain'],
            ['name' => 'DOC', 'type' => 'application/msword'],
            ['name' => 'DOCX', 'type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            ['name' => 'JPEG', 'type' => 'image/jpeg'],
            ['name' => 'PNG', 'type' => 'image/png'],
            ['name' => 'GIF', 'type' => 'image/gif'],
        ];
        echo '<div class="row mb-3 border-1 border-bottom">';
        echo '  <div class="col-md-12">';
        echo '      <b>'.$no.'. '.$nama_bukti.'</b>';
        echo '  </div>';
        echo '  <div class="col-md-4">';
        echo '      <ul>';
        echo '          <li>Single/Multi : <code class="text-grayish">'.$single_multi.'</code></li>';
        echo '          <li>Max File : <code class="text-grayish">'.$max_file.' MB</code></li>';
        echo '      </ul>';
        echo '  </div>';
        echo '  <div class="col-md-4">';
        echo '      <ul>';
        echo '          <li>';
        echo '              Type File :';
        echo '                  <code class="text text-grayish">';
                                foreach($DataArray as $DataList){
                                    $TypeList=$DataList['type'];
                                    $matchedIds = [];
                                    foreach ($Referensi as $item) {
                                        if ($item['type'] === $TypeList) {
                                            $matchedIds[] = $item['name'];
                                            
                                        }
                                    }
                                    $NamaFile=implode(', ', $matchedIds);
                                    echo "$NamaFile, ";
                                }
        echo '                  </code>';
        echo '          </li>';
        echo '          <li>';
        echo '              Deskripsi :';
        echo '                  <code class="text text-grayish">';
        echo '                      '.$deskripsi.'';
        echo '                  </code>';
        echo '          </li>';
        echo '      </ul>';
        echo '  </div>';
        echo '  <div class="col-md-4 text-center mb-3">';
        echo '      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditLampiranBukti" data-id="'.$id_referensi_bukti.'" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>';
        echo '      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusLampiranBukti" data-id="'.$id_referensi_bukti.'" class="btn btn-sm btn-outline-dark"><i class="bi bi-x"></i> Hapus</a>';
        echo '  </div>';
        echo '</div>';
        $no++;
    }
?>
