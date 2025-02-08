<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    //Menangkap id_akses_pengajuan
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Pengajuan Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        //Cek Ketersediaan Data RKPDES
        $Qry= mysqli_query($Conn,"SELECT * FROM akses_pengajuan WHERE id_akses_pengajuan='$id_akses_pengajuan'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_akses_pengajuan'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Pengajuan Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $surat_pengajuan=$Data['surat_pengajuan'];
            // Dekode base64 string untuk mendapatkan data biner
            $pdf_data = base64_decode($surat_pengajuan);
            // Nama file sementara
            $temp_pdf_file = tempnam(sys_get_temp_dir(), 'pdf');
            // Simpan data biner ke file sementara
            file_put_contents($temp_pdf_file, $pdf_data);
            // Tampilkan file PDF pada halaman web
            // Atau menggunakan iframe
            // echo '<iframe src="data:application/pdf;base64,'.base64_encode($pdf_data).'" width="100%" height="600px"></iframe>';
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center">';
            echo '      <embed src="data:application/pdf;base64,'.base64_encode($pdf_data).'" width="100%" height="600px" />';
            echo '  </div>';
            echo '</div>';
            unlink($temp_pdf_file);
            // Hapus file sementara setelah digunakan
        }
    }
?>