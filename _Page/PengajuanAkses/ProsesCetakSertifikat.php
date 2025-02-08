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
                    $nama_dokumen= "Sertifikat-$modifiedName";
                    //Atur Ukkuran
                    $width_px = 2000;
                    $height_px = 1414;
                    //Mulai Pembuatan File PDF
                    $mpdf = new \Mpdf\Mpdf();
                    // Konversi piksel ke milimeter (1 inchi = 25.4 mm, 96 piksel per inchi)
                    $width_mm = $width_px * 25.4 / 96;
                    $height_mm = $height_px * 25.4 / 96;
                    // Membuat instance mPDF dengan ukuran halaman yang dikonversi
                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => [$width_mm, $height_mm]
                    ]);
                    $html='<style>@page *{margin-top: 0px;}</style>'; 
                    //Beginning Buffer to save PHP variables and HTML tags
                    ob_start();
                    //Membuat QR Code
                    $TempDirQr = "assets/img/qrcode/"; 
                    $LogoTengahQrPath = "assets/img/langkuy.png";
                    $NamaQrCode ="sertifikat-$id.png";
                    //Kualitas dari QRCode 
                    $QualityQrCode = 'H'; 
                    //Ukuran besar QRCode
                    $UkuranQrCode = 8; 
                    $PaddingQrCode = 0; 
                    QRCode::png($url_to_qr,$TempDirQr.$NamaQrCode,$QualityQrCode,$UkuranQrCode,$PaddingQrCode);
                    $filepath = $TempDirQr.$NamaQrCode;
                    $QR = imagecreatefrompng($filepath);
                    //Membuat Logo
                    $logo = imagecreatefromstring(file_get_contents($LogoTengahQrPath));
                    $QR_width = imagesx($QR);
                    $QR_height = imagesy($QR);
                    $logo_width = imagesx($logo);
                    $logo_height = imagesy($logo);

                    //besar logo
                    $logo_qr_width = $QR_width/2.5;
                    $scale = $logo_width/$logo_qr_width;
                    $logo_qr_height = $logo_height/$scale;
?>
    <html>
        <head>
            <title>Sertifikat</title>
            <style type="text/css">
                @page {
                    margin-top: 0cm;
                    margin-bottom: 0cm;
                    margin-left: 0cm;
                    margin-right: 0cm;
                    background-image: url("assets/img/sertifikat.png");
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center;
                    background-size: cover;
                    height: 100%; 
                }
                body {
                    font-size: 52.5pt;
                    font-family: "charm";
                    position: relative;
                }
                .nama{
                    text-align: center;
                    line-height: 1000px;
                    color: #155B39;
                    margin-left: 0;
                    color:#333;
                }
                .QrCode{
                    position: absolute;
                    text-align: left;
                    bottom:0px;
                    width: 144px; 
                    height: 144px; 
                }
            </style>
        </head>
        <body>
            <div class="nama"><?php echo $nama;?></div>
            <div class="QrCode">
                <img src="assets/img/qrcode/<?php echo $NamaQrCode; ?>" width="144px" class="ImageQrCode">
            </div>
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