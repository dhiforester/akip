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

if(empty($_POST['id_rpjmdes'])){
    echo '<code class="text-danger">ID RPJMDES Tidak Boleh Kosong!</code>';
} else {
    if(empty($_POST['periode_tahun'])){
        echo '<code class="text-danger">Periode Tahun Anggaran Tidak Boleh Kosong!</code>';
    } else {
        $id_rpjmdes=$_POST['id_rpjmdes'];
        $periode_tahun=$_POST['periode_tahun'];
        
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
            echo '<code class="text-danger">ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!</code>';
        } else {
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $periode_tahun)) {
                echo '<code class="text-danger">Periode Tahun Anggaran Tidak Valid atau Mengandung Karakter Ilegal!</code>';
            } else {
                //Validasi Keberadaan Data
                $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
                if(empty($DataRpjmdes['id_rpjmdes'])){
                    echo '<code class="text-danger">ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!</code>';
                } else {
                    $periode_rpjmdes=$DataRpjmdes['periode'];
                    $kepala_desa=$DataRpjmdes['kepala_desa'];
                    $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                    $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
                    $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                    //Explode
                    $explode=explode('-',$periode_rpjmdes);
                    $periode_awal=$explode['0'];
                    $periode_akhir=$explode['1'];
                    
                    // Membuat objek Spreadsheet baru
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    
                    // Menulis judul
                    $sheet->setCellValue('A1', 'Tahun');
                    $sheet->setCellValue('B1', 'Kode');
                    $sheet->setCellValue('C1', 'Bidang/Kegiatan');
                    $sheet->setCellValue('D1', 'Anggaran');
                    
                    // Mengatur gaya baris judul
                    $sheet->getStyle('A1:D1')->getFont()->setBold(true);
                    $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    
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
                            $QryRincianRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah' AND tahun='$periode_tahun' AND kode='$kode'")or die(mysqli_error($Conn));
                            $DataRincianRpjmdes = mysqli_fetch_array($QryRincianRpjmdes);
                            if(empty($DataRincianRpjmdes['anggaran'])){
                                $anggaran="0";
                            } else {
                                $anggaran=$DataRincianRpjmdes['anggaran'];
                            }
                        } else {
                            $anggaran="";
                        }
                        
                        // Menulis data ke dalam sel-sel Spreadsheet
                        $sheet->setCellValue('A'.$row, $periode_tahun);
                        
                        // Kolom kode diatur sebagai teks
                        $sheet->setCellValueExplicit('B'.$row, $kode, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        
                        $sheet->setCellValue('C'.$row, $nama);
                        $sheet->setCellValue('D'.$row, $anggaran);
                        
                        // Mengatur huruf tebal dan ukuran font 12 untuk level bidang
                        if($level=="Bidang"||$level=="Sub Bidang") {
                            // Mencetak seluruh teks pada baris tersebut sebagai huruf tebal
                            $sheet->getStyle('A'.$row.':D'.$row)->getFont()->setBold(true);
                        }
                        
                        $row++; // Pindah ke baris berikutnya
                    }
                    
                    // Menyesuaikan lebar kolom dengan karakter terpanjang
                    foreach(range('A', 'D') as $columnID) {
                        $sheet->getColumnDimension($columnID)->setAutoSize(true);
                    }
                    
                    // Membuat objek Writer untuk menulis Spreadsheet ke dalam file XLSX
                    $writer = new Xlsx($spreadsheet);
                    
                    // Menyimpan file XLSX
                    $filename = 'Template-RPJMDES-'.$periode_tahun.'.xlsx';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="'. $filename .'"');
                    header('Cache-Control: max-age=0');
                    
                    // Menulis Spreadsheet ke dalam output PHP
                    $writer->save('php://output');
                }
            }
        }
    }
} 
?>
