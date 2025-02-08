<?php
    $id_akses_pengajuan=$explode['1'];
    $id_wilayah=$explode['2'];
    $strtotime=$explode['3'];
    $id_akses=$explode['4'];
    if(!preg_match('/^[0-9]+$/', $id_akses_pengajuan)) {
        echo "Input id_akses_pengajuan Tidak Valid";
    }else{
        if(!preg_match('/^[0-9]+$/', $id_wilayah)) {
            echo "Input ID Wilayah Tidak Valid";
        }else{
            if(!preg_match('/^[0-9]+$/', $strtotime)) {
                echo "Input strtotime Tidak Valid";
            }else{
                if(!preg_match('/^[0-9]+$/', $id_akses)) {
                    echo "Input id_akses Tidak Valid";
                }else{
                    $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
                    $email=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'email');
                    $tanggal=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'tanggal');
                    //Format Tanggal
                    $strtotime=strtotime($tanggal);
                    $TanggalFormat=date('d/m/Y', $strtotime);
                    //Buka Wilayah

                    //Modifikasi Nama Agar Aman
                    $modifiedName = preg_replace('/[^\w]/', '_', $nama);
                    $url_to_qr="$base_url/GenerateDocument.php?id=$id";
                    $penyimpanan = "assets/img/qrcode/";
                    // membuat folder dengan nama "temp"
                    if (!file_exists($penyimpanan)){
                        mkdir($penyimpanan);
                    }
                    // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
                    QRcode::png($url_to_qr, $penyimpanan."$id.png"); 
                    //Mulai Pembuatan File PDF
                    $mpdf = new \Mpdf\Mpdf([
                        'orientation' => 'L' // 'L' untuk lanskap, 'P' untuk potret
                    ]);
                    $nama_dokumen= "Kwitansi-$modifiedName";
                    // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                    $html='<style>@page *{margin-top: 0px;}</style>'; 
                    //Beginning Buffer to save PHP variables and HTML tags
                    ob_start();
?>
    <html>
        <head>
            <title>Kwitansi/Bukti Pembayaran</title>
            <style type="text/css">
                @page {
                    margin-top: 3cm;
                    margin-bottom: 3cm;
                    margin-left: 3cm;
                    margin-right: 3cm;
                }
                body {
                    background-color: #FFF;
                    font-family: arial;
                    font-size : 11pt;
                }
                .company_title{
                    font-size : 14pt;
                }
                table{
                    border-collapse: collapse;
                    margin-top:10px;
                }
                table.header_table tr td {
                    border-bottom: 1px solid #666;
                    color:#333;
                    border-spacing: 0px;
                    padding: 2px;
                    border-collapse: collapse;
                }
                table.kostum tr td {
                    border:none;
                    color:#333;
                    border-spacing: 0px;
                    padding: 4px;
                    border-collapse: collapse;
                    font-size: 12pt;
                }
                table.data tr td {
                    border: 1px solid #666;
                    color:#333;
                    border-spacing: 0px;
                    padding: 10px;
                    border-collapse: collapse;
                }
            </style>
        </head>
        <body>
            <table class="header_table" width="100%">
                <tr>
                    <td align="center">
                        <img src="assets/img/langkuy.png" alt="" width="80px">
                    </td>
                    <td align="left">
                        <b class="company_title">CV. LANGKUY</b><br>
                        <i>IT Specialist Application Developer Event Organizer</i><br>
                        <small>Jl.Siliwangi No. 05 Cirendang-Kuningan-Jawa Barat</small><br>
                        <small>Phone (0857 2444 9495)</small><br>
                    </td>
                    <td align="right">
                        <b>KWITANSI/BUKTI PEMBAYARAN</b><br>
                        Nomor : <?php echo "INV.$id_akses_pengajuan.$id_wilayah.$strtotime.$id_akses"; ?>
                    </td>
                </tr>
            </table>
            <table class="kostum">
                <tr>
                    <td align="left"><b>Tanggal</b></td>
                    <td align="left"><b>:</b></td>
                    <td align="left"><?php echo "$TanggalFormat"; ?></td>
                </tr>
                <tr>
                    <td align="left"><b>Telah Menerima Dari</b></td>
                    <td align="left"><b>:</b></td>
                    <td align="left"><?php echo "$nama"; ?></td>
                </tr>
                <tr>
                    <td align="left"><b>Banyaknya Uang</b></td>
                    <td align="left"><b>:</b></td>
                    <td align="left">
                        <i>Tiga Juta Enam Ratus Tujuh Puluh Ribu Rupiah</i>
                    </td>
                </tr>
                <tr>
                    <td align="left"><b>Jumlah (Rp)</b></td>
                    <td align="left"><b>:</b></td>
                    <td align="left">
                        Rp 3.670.000
                    </td>
                </tr>
                <tr>
                    <td align="left"><b>Untuk Pembayaran</b></td>
                    <td align="left"><b>:</b></td>
                    <td align="left">
                        Penggunaan Aplikasi Kepala Desa Se- Kabupaten Kuningan E-SAKIPKU
                    </td>
                </tr>
            </table>
            <table class="header_table" width="100%">
                <tr>
                    <td align="center"></td>
                </tr>
            </table>
            <table class="header_table" width="100%">
                <tr>
                    <td align="left">
                        <small>
                            <b>Keterangan : </b><br>
                            Dokumen ini dibuat oleh sistem dan telah mendapatkan validasi pihak yang membuat.
                        </small>
                    </td>
                </tr>
            </table>
            <table class="header_table" width="100%">
                <tr>
                    <td align="center">
                        <?php echo '<img src="'.$penyimpanan.''.$id.'.png">';  ?><br>
                        <small>
                            <i>URL Doc</i>
                        </small>
                    </td>
                    <td align="center">
                        Hormat Kami<br>
                        Direktur<br><br><br><br><br>
                        Peny Nursyamsi
                    </td>
                </tr>
            </table>
        </body>
    </html>
<?php
                    $html = ob_get_contents();
                    ob_end_clean();
                    $mpdf->WriteHTML(utf8_encode($html));
                    $mpdf->Output($nama_dokumen.".pdf" ,'I');
                    exit;
                }
            }
        }
    }
?>