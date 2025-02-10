<?php
    // Daftar mapping halaman dengan file JavaScript
    $scripts = [
        "Dashboard" => "_Page/Dashboard/Dashboard.js",
        "MyProfile" => "_Page/MyProfile/MyProfile.js",
        "Akses" => "_Page/Akses/Akses.js",
        "Wilayah" => "_Page/RegionalData/RegionalData.js",
        "Profil" => "_Page/Profil/Profil.js",
    ];

    // Cek apakah $Page ada dalam array dan sertakan file JS yang sesuai
    $script = isset($scripts[$Page]) ? $scripts[$Page] : $scripts["Dashboard"];
    echo '<script type="text/javascript" src="' . $script . '?v=' . date('Ymdhis') . '"></script>';

?>

