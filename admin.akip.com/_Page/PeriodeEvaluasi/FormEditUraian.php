<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');
    
    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');

    //Sesi Akses
    if (empty($SessionIdAkses)) {
        echo '
            <div class="alert alert-danger">
                Sesi Akses Sudah Berakhir! Silahkan Login Ulang!
            </div>
        ';
    }else{
        //Tangkap Data
        if(empty($_POST['id_uraian'])){
            echo '
                <div class="alert alert-danger">
                    ID Uraian Tidak Boleh Kosong!
                </div>
            ';
        }else{
            $id_uraian=$_POST['id_uraian'];
            $Qry = $Conn->prepare("SELECT * FROM uraian WHERE id_uraian = ?");
            $Qry->bind_param("s", $id_uraian);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="alert alert-danger">
                        Terjadi Kesalahan Pada Saat Membuka Data <br>
                        Error : '.$error.'
                    </div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_uraian'])){
                    echo '
                        <div class="alert alert-danger">
                            Data Tidak Ditemukan!
                        </div>
                    ';
                }else{
                    //Buka Data
                    $id_uraian=$Data['id_uraian'];
                    $id_kriteria=$Data['id_kriteria'];
                    $id_komponen_sub=$Data['id_komponen_sub'];
                    $id_komponen=$Data['id_komponen'];
                    $id_evaluasi_periode=$Data['id_evaluasi_periode'];
                    $kode=$Data['kode'];
                    $nama=$Data['nama'];
                    $alternatif=$Data['alternatif'];
                    $lampiran=$Data['lampiran'];
                    $bobot=$Data['bobot'];
                    //Buka Data Alternatif Menjadi Arry
                    $alternatif_arry=json_decode($alternatif, true);
                    $tipe_alternatif=$alternatif_arry['type'];
                    $alternatif_list=$alternatif_arry['alternatif'];
?>
                    <input type="hidden" name="id_uraian" id="id_uraian_for_edit" value="<?php echo $id_uraian; ?>">
                    <input type="hidden" name="id_kriteria" id="id_kriteria_for_edit" value="<?php echo $id_kriteria; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kode_uraian_edit">Kode Uraian</label>
                            <input type="text" name="kode" id="kode_uraian_edit" class="form-control" value="<?php echo $kode; ?>">
                            <small>
                                <code class="text text-grayish">Digunakan untuk mengatur urutan uraian ketika ditampilkan</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_uraian_edit">Uraian</label>
                            <input type="text" name="nama" id="nama_uraian_edit" class="form-control" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="tipe_uraian_edit">Tipe Jawaban</label>
                            <select name="tipe" id="tipe_uraian_edit" class="form-control">
                                <option <?php if($tipe_alternatif==""){echo "selected";} ?> value="">Pilih</option>
                                <option <?php if($tipe_alternatif=="select_option"){echo "selected";} ?> value="select_option">Select Option</option>
                                <option <?php if($tipe_alternatif=="list_option"){echo "selected";} ?> value="list_option">List Option</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-10 mb-3 mt-3">Alternatif Jawaban</div>
                        <div class="col-2 mb-3 mt-3 text-end">
                            <button type="button" class="btn btn-sm btn-floating btn-outline-secondary" id="TambahFormAlternatifEdit">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 border-1 border-bottom" id="list_alternatif_edit">
                            <!-- List Form Alternatif Akan Muncul Disini -->
                            <?php
                                foreach($alternatif_list as $row){
                                    $label=$row['label'];
                                    $value=$row['value'];
                                    echo '
                                        <div class="row mb-3">
                                            <div class="col-5">
                                                <input type="text" name="label_alternatif[]" class="form-control" value="'.$label.'">
                                                <small>Label</small>
                                            </div>
                                            <div class="col-5">
                                                <input type="number" step="0.01" min="0" name="value_alternatif[]" class="form-control" value="'.$value.'">
                                                <small>Skor</small>
                                            </div>
                                            <div class="col-2 text-end">
                                                <div class="btn-group shadow-0">
                                                    <button type="button" class="btn btn-sm btn-floating btn-outline-danger hapus_form_alternatif">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>
<script>
    $('#TambahFormAlternatifEdit').click(function() {
        var newForm = `
            <div class="row mb-3">
                <div class="col-5">
                    <input type="text" name="label_alternatif[]" class="form-control">
                    <small>Label</small>
                </div>
                <div class="col-5">
                    <input type="number" step="0.01" min="0" name="value_alternatif[]" class="form-control">
                    <small>Skor</small>
                </div>
                <div class="col-2 text-end">
                    <div class="btn-group shadow-0">
                        <button type="button" class="btn btn-sm btn-floating btn-outline-danger hapus_form_alternatif">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#list_alternatif_edit').append(newForm);
    });
    $(document).on('click', '.hapus_form_alternatif', function() {
        $(this).closest('.row.mb-3').remove();
    });
</script>