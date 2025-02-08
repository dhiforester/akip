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

    if(empty($_POST['id_rkpdes'])){
        echo '<code class="text-danger">ID RKPDES Tidak Boleh Kosong!</code>';
    }else{
        $id_rkpdes=$_POST['id_rkpdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rkpdes)) {
            echo '<code class="text-danger">ID RKPDES Tidak Valid atau Mengandung Karakter Ilegal!</code>';
        }else{
            //Validasi Keberadaan Data
            $QryRkpdews = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRkpdes = mysqli_fetch_array($QryRkpdews);
            if(empty($DataRkpdes['id_rkpdes'])){
                echo '<code class="text-danger">ID RKPDES Tidak Valid atau Tidak Ditemukan Pada Database!</code>';
            } else {
                $periode=$DataRkpdes['periode'];
                $jumlah_anggaran=$DataRkpdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                // Membuat objek Spreadsheet baru
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                // Menulis judul
                $sheet->setCellValue('A1', 'Kode');
                $sheet->setCellValue('B1', 'Bidang/Kegiatan');
                $sheet->setCellValue('C1', 'Anggaran');
                // Mengatur gaya baris judul
                $sheet->getStyle('A1:C1')->getFont()->setBold(true);
                $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // Query untuk mendapatkan data
                $query = "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$SettingIdWilayahUtama' ORDER BY kode ASC";
                $result = mysqli_query($Conn, $query);
                        
                // Mengisi data ke dalam Spreadsheet
                $row = 2; // Mulai dari baris ke-2
                while($data = mysqli_fetch_assoc($result)) {
                    $id_bidang_kegiatan= $data['id_bidang_kegiatan'];
                    $kode= $data['kode'];
                    $nama= $data['nama'];
                    $level= $data['level'];
                    
                    if($level=="Kegiatan") {
                        //Menghitung Anggaran
                        $QryRincianRkpdes = mysqli_query($Conn,"SELECT * FROM rkpdes_rincian WHERE id_rkpdes='$id_rkpdes' AND kode='$kode'")or die(mysqli_error($Conn));
                        $DataRincianRkpdes = mysqli_fetch_array($QryRincianRkpdes);
                        if(empty($DataRincianRkpdes['anggaran'])){
                            $anggaran="0";
                        } else {
                            $anggaran=$DataRincianRkpdes['anggaran'];
                        }
                    } else {
                        $anggaran="";
                    }
                    // Kolom kode diatur sebagai teks
                    $sheet->setCellValueExplicit('A'.$row, $kode, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue('B'.$row, $nama);
                    $sheet->setCellValue('C'.$row, $anggaran);
                    
                    // Mengatur huruf tebal dan ukuran font 12 untuk level bidang
                    if($level=="Bidang"||$level=="Sub Bidang") {
                        // Mencetak seluruh teks pada baris tersebut sebagai huruf tebal
                        $sheet->getStyle('A'.$row.':C'.$row)->getFont()->setBold(true);
                    }
                    $row++; // Pindah ke baris berikutnya
                }
                    
                // Menyesuaikan lebar kolom dengan karakter terpanjang
                foreach(range('A', 'C') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
                
                // Membuat objek Writer untuk menulis Spreadsheet ke dalam file XLSX
                $writer = new Xlsx($spreadsheet);
                
                // Menyimpan file XLSX
                $filename = 'Template-RKPDES-'.$periode.'.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="'. $filename .'"');
                header('Cache-Control: max-age=0');
                
                // Menulis Spreadsheet ke dalam output PHP
                $writer->save('php://output');
            }
        }
    } 
?>
