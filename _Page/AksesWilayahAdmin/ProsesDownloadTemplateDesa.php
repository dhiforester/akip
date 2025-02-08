<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";

    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-danger text-danger">ID Wilayah Tidak Boleh Kosong!</div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $Kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        //Nama Kecamatan
        //Cek Apakah Data Desa Ada
        $JumlahDesa = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$Kecamatan'"));
        if(empty($JumlahDesa)){
            echo "Data Desa Tidak Ada";
        }else{
            // Membuat objek Spreadsheet baru
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Menulis judul
            $sheet->setCellValue('A1', 'ID Wilayah');
            $sheet->setCellValue('B1', 'Desa');
            $sheet->setCellValue('C1', 'Nama');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Kontak');
            $sheet->setCellValue('F1', 'Password');
            // Mengatur gaya baris judul
            $sheet->getStyle('A1:F1')->getFont()->setBold(true);
            $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Query untuk mendapatkan data
            $query = "SELECT * FROM wilayah WHERE kategori='desa' AND kabupaten='$NamaWilayahOfficial' AND kecamatan='$Kecamatan' ORDER BY desa ASC";
            $result = mysqli_query($Conn, $query);
            // Mengisi data ke dalam Spreadsheet
            $row = 2; // Mulai dari baris ke-2
            while($data = mysqli_fetch_assoc($result)) {
                $id_desa= $data['id_wilayah'];
                $kecamatan= $data['kecamatan'];
                $desa= $data['desa'];
                //Membuat Alamat email Dari Nama Kecamatan
                $NamaKecamatan=preg_replace('/\s+/', '', $kecamatan);
                $NamaDesa=preg_replace('/\s+/', '', $desa);
                $AlamatEmail="$id_wilayah-$NamaDesa@e-sakipku.com";
                $NamaAdmin="Admin $NamaDesa";
                //Generate Password Secara Acak Sebanyak 10 Karakter
                $PasswordReal=generateRandomString('10');
                $KontakRandome=generateRandomNumber('12');
                // Kolom kode diatur sebagai teks
                $sheet->setCellValueExplicit('A'.$row, $id_desa, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue('B'.$row, $desa);
                $sheet->setCellValue('C'.$row, $NamaAdmin);
                $sheet->setCellValue('D'.$row, $AlamatEmail);
                $sheet->setCellValueExplicit('E'.$row, $KontakRandome, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue('F'.$row, $PasswordReal);
                $row++; // Pindah ke baris berikutnya
            }
            // Menyesuaikan lebar kolom dengan karakter terpanjang
            foreach(range('A', 'F') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
            
            // Membuat objek Writer untuk menulis Spreadsheet ke dalam file XLSX
            $writer = new Xlsx($spreadsheet);
            
            // Menyimpan file XLSX
            $filename = 'Template-akses-desa-'.$NamaKecamatan.'.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'. $filename .'"');
            header('Cache-Control: max-age=0');
            
            // Menulis Spreadsheet ke dalam output PHP
            $writer->save('php://output');
        } 
    } 
?>
