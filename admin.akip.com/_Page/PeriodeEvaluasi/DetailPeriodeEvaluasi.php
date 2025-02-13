<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');
    
    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
    $id_evaluasi_periode="";

    if (empty($SessionIdAkses)) {
        echo '
            <div class="alert alert-danger">
                Sesi Akses Sudah Berakhir! Silahkan Login Ulang!
            </div>
        ';
    }else{
        if(empty($_POST['id_evaluasi_periode'])){
            echo '
                <div class="alert alert-danger">
                    ID Periode Tidak Boleh Kosong!
                </div>
            ';
        }else{
            $id_evaluasi_periode = validateAndSanitizeInput($_POST['id_evaluasi_periode']);
            $Qry = $Conn->prepare("SELECT * FROM evaluasi_periode WHERE id_evaluasi_periode = ?");
            $Qry->bind_param("s", $id_evaluasi_periode);
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
                if(empty($Data['id_evaluasi_periode'])){
                    echo '
                        <div class="alert alert-danger">
                            Data Tidak Ditemukan!
                        </div>
                    ';
                }else{
                    //Buka Data
                    $id_evaluasi_periode=$Data['id_evaluasi_periode'];
                    $periode=$Data['periode'];
                    $date_mulai=$Data['date_mulai'];
                    $date_selesai=$Data['date_selesai'];
                    //Format Tanggal
                    $date_mulai_format=date('d F Y',strtotime($date_mulai));
                    $date_selesai_format=date('d F Y',strtotime($date_selesai));
                    echo '
                        <div class="row mb-3">
                            <div class="col-4"><small>Periode</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$periode.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Tanggal Mulai</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$date_mulai_format.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><small>Tanggal Selesai</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$date_selesai_format.'</small></div>
                        </div>
                    ';
                }
            }
        }
    }
?>
<script>
    var id_evaluasi_periode='<?php echo $id_evaluasi_periode; ?>';
    $('#FooterDetailPeriodeEvaluasi').html(`
        <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalEditPeriode" data-id="${id_evaluasi_periode}" data-mode="Detail">
            <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalHapusPeriode" data-id="${id_evaluasi_periode}">
            <i class="bi bi-trash"></i>
        </button>
    `);
</script>
