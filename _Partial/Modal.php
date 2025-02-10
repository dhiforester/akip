<?php
    include "_Page/Logout/ModalLogout.php";
    $page_arry=[
        "MyProfile"=>"_Page/MyProfile/ModalMyProfile.php",
        "Akses"=>"_Page/Akses/ModalAkses.php",
        "Wilayah"=>"_Page/RegionalData/ModalRegionalData.php",
        "Help"=>"_Page/Help/Help.php",
    ];
    //Tangkap 'Page'
    $Page = !empty($_GET['Page']) ? $_GET['Page'] : "";

    //Kondisi Page
    if (array_key_exists($Page, $page_arry)) { 
        include $page_arry[$Page]; 
    }
?>