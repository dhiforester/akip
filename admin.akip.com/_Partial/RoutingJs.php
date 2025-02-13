<script type="text/javascript">
    //Detail Akses
    $('#scrollingModal2').on('show.bs.modal', function (e) {
        $('#IsiModalBody').html("<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");
    });
</script>
<?php 
    echo '<script type="text/javascript" src="_Partial/Universal.js"></script>';
    if(empty($_GET['Page'])){
        echo '<script type="text/javascript" src="_Page/Dashboard/Dashboard.js"></script>';
    }else{
        // Daftar mapping halaman dengan file JavaScript
        $scripts = [
            "Dashboard" => "_Page/Dashboard/Dashboard.js",
            "MyProfile" => "_Page/MyProfile/MyProfile.js",
            "Akses" => "_Page/Akses/Akses.js",
            "Wilayah" => "_Page/RegionalData/RegionalData.js",
            "PeriodeEvaluasi" => "_Page/PeriodeEvaluasi/PeriodeEvaluasi.js",
            "Help" => "_Page/Help/Help.js",
            "Profil" => "_Page/Profil/Profil.js",
        ];

        // Cek apakah $Page ada dalam array dan sertakan file JS yang sesuai
        $script = isset($scripts[$Page]) ? $scripts[$Page] : $scripts["Dashboard"];
        echo '<script type="text/javascript" src="' . $script . '?v=' . date('Ymdhis') . '"></script>';
    }
    //default Login
    // echo '<script type="text/javascript" src="_Page/Pendaftaran/Pendaftaran.js"></script>';
    echo '<script type="text/javascript" src="_Page/Login/Login.js"></script>';
    // echo '<script type="text/javascript" src="_Page/ResetPassword/ResetPassword.js"></script>';
?>