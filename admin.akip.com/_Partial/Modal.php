<?php
    include "_Page/Logout/ModalLogout.php";
    if(empty($_GET['Page'])){
        include "_Page/Dashboard/ModalDashboard.php";
    }else{
        $page_arry=[
            "MyProfile"=>"_Page/MyProfile/ModalMyProfile.php",
            "Akses"=>"_Page/Akses/ModalAkses.php",
            "SettingGeneral"=>"_Page/SettingGeneral/ModalSettingGeneral.php",
            "SettingEmail"=>"_Page/SettingEmail/ModalSettingEmail.php",
            "Wilayah"=>"_Page/RegionalData/ModalRegionalData.php",
            "Inspektorat"=>"_Page/Inspektorat/ModalInspektorat.php",
            "PeriodeEvaluasi"=>"_Page/PeriodeEvaluasi/ModalPeriodeEvaluasi.php",
            "Help"=>"_Page/Help/ModalHelp.php",
        ];
        //Tangkap 'Page'
        $Page = !empty($_GET['Page']) ? $_GET['Page'] : "";

        //Kondisi Page
        if (array_key_exists($Page, $page_arry)) { 
            include $page_arry[$Page]; 
        }
    }
?>