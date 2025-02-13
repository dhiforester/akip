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
                <div class="alert alert-danger">ID Sub Komponen Tidak Boleh Kosong!</div>
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
                <div class="row mb-2">
                    <div class="col-3">
                        <small class="text text-dark">Komponen</small>
                    </div>
                    <div class="col-9">
                        <small class="text text-dark">
                            '.$KodeKomponen.'. '.$NamaKomponen.'
                        </small>
                    </div>
                </div>
                <div class="row mb-2 border-1 border-bottom">
                    <div class="col-3 mb-3">
                        <small class="text text-dark">Keterangan</small>
                    </div>
                    <div class="col-9 mb-3">
                        <small class="text text-dark">
                            <code class="text text-grayish">('.$KeteranganKomponen.')</code>
                        </small>
                    </div>
                </div>
            ';
            echo '
                <div class="row mb-2">
                    <div class="col-3">
                        <small class="text text-dark">Sub Komponen</small>
                    </div>
                    <div class="col-9">
                        <small class="text text-dark">
                            '.$KodeKomponen.'.'.$KodeSubKomponen.'. '.$NamaSubKomponen.'
                        </small>
                    </div>
                </div>
                <div class="row mb-2 border-1 border-bottom">
                    <div class="col-3 mb-3">
                        <small class="text text-dark">Keterangan</small>
                    </div>
                    <div class="col-9 mb-3">
                        <small class="text text-dark">
                            <code class="text text-grayish">('.$KeteranganSubKomponen.')</code>
                        </small>
                    </div>
                </div>
            ';
            echo '
                <div class="row mb-2">
                    <div class="col-3">
                        <small class="text text-dark">Kriteria</small>
                    </div>
                    <div class="col-9">
                        <small class="text text-dark">
                            '.$KodeKomponen.'.'.$KodeSubKomponen.'.'.$KodeKriteria.'. '.$NamaKriteria.'
                        </small>
                    </div>
                </div>
                <div class="row mb-2 border-1 border-bottom">
                    <div class="col-3 mb-3">
                        <small class="text text-dark">Keterangan</small>
                    </div>
                    <div class="col-9 mb-3">
                        <small class="text text-dark">
                            <code class="text text-grayish">('.$KeteranganKriteria.')</code>
                        </small>
                    </div>
                </div>
            ';
            echo '
                <div class="table table-responsive mt-3">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><b>Kode</b></th>
                                <th><b>Uraian</b></th>
                                <th><b>Alternatif</b></th>
                                <th><b>Evidanse</b></th>
                                <th><b>Bobot</b></th>
                                <th><b>Opsi</b></th>
                            </tr>
                        </thead>
                        <tbody>
            ';
                $no = 1;
                $query = mysqli_query($Conn, "SELECT * FROM uraian WHERE id_kriteria='$id_kriteria' ORDER BY kode ASC");
                $jml_data = mysqli_num_rows($query);
                if(empty($jml_data)){
                    echo '
                        <tr>
                            <td colspan="6" class="text-center">
                                <small class="text-danger">Tidak Ada Data Yang Ditampilkan</small>
                            </td>
                        </tr>
                    ';
                }else{
                    while ($data = mysqli_fetch_array($query)) {
                        $id_uraian= $data['id_uraian'];
                        $kode= $data['kode'];
                        $nama= $data['nama'];
                        $keterangan= $data['keterangan'];
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
                        echo '
                            <tr>
                                <td><small>'.$KodeKomponen.'.'.$KodeSubKomponen.'.'.$KodeKriteria.'..'.$kode.'</small></td>
                                <td>
                                    <a href="javascript:void(0);" class="show_uraian" data-id="'.$id_uraian.'" title="Tampilkan Uraian">
                                        <small class="text-primary">'.$nama.'</small>
                                    </a>
                                </td>
                                <td>
                                    <small>
                                        <code class="text text-grayish">'.$keterangan.'</code>
                                    </small>
                                </td>
                                <td><small>'.$label_alternatif.'</small></td>
                                <td><small>'.$label_lampiran.'</small></td>
                                <td><small>'.$bobot.'</small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditUraian" data-id="'.$id_uraian.'" data-kode="'.$kode.'" data-nama="'.$nama.'" data-keterangan="'.$keterangan.'" data-level="Uraian">
                                                <i class="bi bi-pencil"></i> Edit Uraian
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusUraian" data-id="'.$id_uraian.'" data-kode="'.$kode.'" data-nama="'.$nama.'" data-keterangan="'.$keterangan.'" data-level="Uraian">
                                                <i class="bi bi-trash"></i> Hapus Uraian
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        ';
                        $no++; 
                    }
                }
            echo '
                        </tbody>
                    </table>
                </div>
            ';
        }
    }
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";

    //Put Into Pagging Element
    $('#FooterIndikator').html('Jumlah Data: '+jml_data+' Komponen');
</script>
