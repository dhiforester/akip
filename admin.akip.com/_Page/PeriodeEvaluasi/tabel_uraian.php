<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $jml_data =0;
    if(empty($SessionIdAkses)){
        echo '
            <div class="alert alert-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang!</div>
        ';
    }else{
        if(empty($_POST['id_kriteria'])){
            echo '
                <div class="alert alert-danger">ID Kriteria Tidak Boleh Kosong!</div>
            ';
        }else{
            $id_kriteria=$_POST['id_kriteria'];
            $id_komponen_sub=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id_kriteria, 'id_komponen_sub');
            $id_komponen=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id_kriteria, 'id_komponen');
            //Buka Data Kriteria
            $NamaKriteria=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id_kriteria, 'nama');
            $KodeKriteria=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id_kriteria, 'kode');
            $KeteranganKriteria=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id_kriteria, 'keterangan');
            //Buka Data Sub Komponen
            $NamaSubKomponen=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id_komponen_sub, 'nama');
            $KodeSubKomponen=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id_komponen_sub, 'kode');
            $KeteranganSubKomponen=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id_komponen_sub, 'keterangan');
            //Buka Data Komponen
            $NamaKomponen=GetDetailData($Conn, 'komponen', 'id_komponen', $id_komponen, 'nama');
            $KodeKomponen=GetDetailData($Conn, 'komponen', 'id_komponen', $id_komponen, 'kode');
            $KeteranganKomponen=GetDetailData($Conn, 'komponen', 'id_komponen', $id_komponen, 'keterangan');
            echo '
                <div class="row mb-3 border-1 border-bottom">
                    <div class="col-12 mb-3">
                        <ul>
                            <li>
                                <b>'.$KodeKomponen.'. '.$NamaKomponen.'</b>
                                <ul>
                                    <li>
                                        '.$KodeKomponen.'.'.$KodeSubKomponen.'. '.$NamaSubKomponen.'
                                        <ul>
                                            <li>
                                                <small>'.$KodeKomponen.'.'.$KodeSubKomponen.'.'.$KodeKriteria.'. '.$NamaKriteria.'</small>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            ';
            $no = 1;
            $query = mysqli_query($Conn, "SELECT * FROM uraian WHERE id_kriteria='$id_kriteria' ORDER BY kode ASC");
            $jml_data = mysqli_num_rows($query);
            if(empty($jml_data)){
                echo '
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="alert alert-danger">Tidak Ada Data Yang Ditampilkan</div>
                        </div>
                    </div>
                ';
            }else{
                while ($data = mysqli_fetch_array($query)) {
                    $id_uraian= $data['id_uraian'];
                    $id_kriteria = $data['id_kriteria'];
                    $kode= $data['kode'];
                    $nama= $data['nama'];
                    $alternatif= $data['alternatif'];
                    $lampiran= $data['lampiran'];
                    $bobot= $data['bobot'];
                    if(empty($alternatif)){
                        $label_alternatif='<span class="badge badge-danger">No Set</span>';
                    }else{
                        $label_alternatif='<span class="badge badge-success">Already Set</span>';
                    }
                    if(empty($lampiran)){
                        $label_lampiran='<span class="badge badge-danger">No Set</span>';
                    }else{
                        $label_lampiran='<span class="badge badge-success">Already Set</span>';
                    }

                    // Decode JSON menjadi array asosiatif
                    $alternatif = json_decode($data['alternatif'], true);
                    $tipe_alternatif=$alternatif['type'];
                    if($tipe_alternatif=="select_option"){
                        $tipe_alternatif_label='<small><code class="text-warning"><i class="bi bi-check-circle"></i> Select Option</code></small>';
                    }else{
                        if($tipe_alternatif=="list_option"){
                            $tipe_alternatif_label='<small><code class="text-info"><i class="bi bi-check-all"></i> List Option</code></small>';
                        }else{
                            $tipe_alternatif_label='<small><code class="text-danger">None</code></small>';
                        }
                    }
                    // Buat variabel untuk menyimpan daftar alternatif
                    $list_alternatif = "<ul>";
                    foreach ($alternatif['alternatif'] as $item) {
                        $list_alternatif .= "<li><small class='text text-grayish'>" .$item['label'] . " (" .$item['value'] . ")</small></li>";
                    }
                    $list_alternatif .= "</ul>";

                    // Lampiran
                    $lampiran = json_decode($data['lampiran'], true); 
                    if(empty(count($lampiran))){
                        $list_lampiran='<br><small class="text text-grayish">None</small>';
                    }else{
                        // Buat variabel untuk menyimpan daftar alternatif
                        $list_lampiran = "<ul>";
                        foreach ($lampiran as $item_lampiran) {
                            $id_lampiran=$item_lampiran['id_lampiran'];
                            $nama=$item_lampiran['nama'];
                            $size_max=$item_lampiran['size_max'];
                            $size_max_mb = $size_max / (1024 * 1024);
                            $list_lampiran .= '
                                <li>
                                    <small class="text text-grayish">
                                        <code class="text-grayish">'.$nama.' (Max File : '.$size_max_mb.' Mb)</code>
                                    </small>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusLampiran" data-id_kriteria="'.$id_kriteria.'" data-id_uraian="'.$id_uraian.'" data-id_lampiran="'.$id_lampiran.'">
                                        <small class="text-danger">
                                            <i class="bi bi-x-circle"></i>
                                        </small>
                                    </a>
                                </li>
                            ';
                        }
                        $list_lampiran .= "</ul>";
                    }

                    echo '
                        <div class="row mt-3 border-1 border-bottom">
                            <div class="col-9 mb-3 mt-3">
                                <b class="text text-dark">
                                    '.$kode.'. '.$nama.'
                                </b>
                            </div>
                            <div class="col-3 text-end mb-3 mt-3">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditUraian" data-id="'.$id_uraian.'">
                                            <i class="bi bi-pencil"></i> Edit Uraian
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusUraian" data-id_uraian="'.$id_uraian.'" data-id_kriteria="'.$id_kriteria.'" data-kode="'.$KodeKomponen.'.'.$KodeSubKomponen.'.'.$KodeKriteria.'.'.$kode.'" data-nama="'.$nama.'">
                                            <i class="bi bi-trash"></i> Hapus Uraian
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahLampiran" data-id="'.$id_uraian.'" data-kode="'.$kode.'" data-nama="'.$nama.'" data-level="Uraian">
                                            <i class="bi bi-paperclip"></i> Tambah Lampiran
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <small>Kode</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish">'.$KodeKomponen.'.'.$KodeSubKomponen.'.'.$KodeKriteria.'.'.$kode.'</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <small>Uraian</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish">'.$nama.'</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <small>Bobot</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish">'.$bobot.'</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <small>Alternatif Jawaban | '.$tipe_alternatif_label.'</small>
                                        '.$list_alternatif.'
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <small>Pengaturan Lampiran</small>
                                '.$list_lampiran.'
                            </div>
                        </div>
                    ';
                    $no++; 
                }
            }
        }
    }
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";

    //Put Into Pagging Element
    $('#FooterIndikator').html('<small><code class="text text-grayish">Jumlah Data: '+jml_data+' Komponen</code></small>');
</script>
