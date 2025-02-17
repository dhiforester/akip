<?php
    require '../../vendor/autoload.php'; // Load PhpSpreadsheet library

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Kontak (HP)');
    $sheet->setCellValue('D1', 'Email');
    $sheet->setCellValue('E1', 'Akses');
    $sheet->setCellValue('F1', 'Tanggal Input');

    // Fetch data and populate sheet
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akses"));
    if (empty($jml_data)) {
        $sheet->setCellValue('A2', 'Belum Memiliki Data Akses');
    } else {
        $no = 1;
        $query = mysqli_query($Conn, "SELECT * FROM akses ORDER BY id_akses ASC");
        $row = 2; // Starting from the second row
        while ($data = mysqli_fetch_array($query)) {
            $id_akses = $data['id_akses'];
            $nama = $data['nama'];
            $kontak = $data['kontak'];
            $email = $data['email'];
            $datetime_update = $data['timestamp_creat'];
            $akses = $data['akses'];
            $strtotime = strtotime($datetime_update);
            $datetime_update = date('d/m/Y H:i', $strtotime);
            //Tampilkan data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $nama);
            $sheet->setCellValueExplicit('C' . $row, $kontak, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $email);
            $sheet->setCellValue('E' . $row, $akses);
            $sheet->setCellValue('F' . $row, $datetime_update);
            $row++;
            $no++;
        }
    }

    // Auto size columns
    foreach (range('A', 'F') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Set headers to download file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DataAkses.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
?>
