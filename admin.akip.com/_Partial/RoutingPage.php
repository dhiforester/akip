<?php
    //Index Halaman
    $page_arry=[
        "Dashboard"=>"_Page/Dashboard/Dashboard.php",
        "MyProfile"=>"_Page/MyProfile/MyProfile.php",
        "Akses"=>"_Page/Akses/Akses.php",
        "SettingGeneral"=>"_Page/SettingGeneral/SettingGeneral.php",
        "SettingEmail"=>"_Page/SettingEmail/SettingEmail.php",
        "Wilayah"=>"_Page/RegionalData/RegionalData.php",
        "Inspektorat"=>"_Page/Inspektorat/Inspektorat.php",
        "PeriodeEvaluasi"=>"_Page/PeriodeEvaluasi/PeriodeEvaluasi.php",
        "Help"=>"_Page/Help/Help.php",
    ];

    //Tangkap 'Page'
    $Page = !empty($_GET['Page']) ? $_GET['Page'] : "";

    //Kondisi Page
    if (array_key_exists($Page, $page_arry)) { 
        include $page_arry[$Page]; 
    } else { 
        include "_Page/Dashboard/Dashboard.php"; 
    }
?>