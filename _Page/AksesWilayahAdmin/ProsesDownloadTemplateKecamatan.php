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
    //Cek Apakah Data Kecamatan Ada
    $JumlahKecamatan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$NamaWilayahOfficial'"));
    if(empty($JumlahKecamatan)){
        echo "Data kecamatan Tidak Ada";
    }else{
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Menulis judul
        $sheet->setCellValue('A1', 'ID Wilayah');
        $sheet->setCellValue('B1', 'Kecamatan');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Kontak');
        $sheet->setCellValue('F1', 'Password');
        // Mengatur gaya baris judul
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Query untuk mendapatkan data
        $query = "SELECT * FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$NamaWilayahOfficial' ORDER BY kecamatan ASC";
        $result = mysqli_query($Conn, $query);
        // Mengisi data ke dalam Spreadsheet
        $row = 2; // Mulai dari baris ke-2
        while($data = mysqli_fetch_assoc($result)) {
            $id_wilayah= $data['id_wilayah'];
            $kecamatan= $data['kecamatan'];
            //Membuat Alamat email Dari Nama Kecamatan
            $NamaKecamatan=preg_replace('/\s+/', '', $kecamatan);
            $AlamatEmail="$NamaKecamatan@e-sakipku.com";
            $NamaAdmin="Admin $NamaKecamatan";
            //Generate Password Secara Acak Sebanyak 10 Karakter
            $PasswordReal=generateRandomString('10');
            $KontakRandome=generateRandomNumber('12');
            // Kolom kode diatur sebagai teks
            $sheet->setCellValueExplicit('A'.$row, $id_wilayah, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('B'.$row, $NamaKecamatan);
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
        $filename = 'Template-akses-Kecamatan.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'"');
        header('Cache-Control: max-age=0');
        
        // Menulis Spreadsheet ke dalam output PHP
        $writer->save('php://output');
    } 
?>
