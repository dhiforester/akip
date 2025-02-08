<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="DetailProfile"){
            include "_Page/WilayahProfilAdmin/DetailProfile.php";
        }else{
            if($Sub=="DetailDemografi"){
                include "_Page/WilayahProfilAdmin/DetailDemografi.php";
            }else{
                if($Sub=="DetailTargetCapaian"){
                    include "_Page/WilayahProfilAdmin/DetailTargetCapaian.php";
                }else{
                    if($Sub=="KelolaAksesWilayah"){
                        include "_Page/WilayahProfilAdmin/KelolaAksesWilayah.php";
                    }else{
                        include "_Page/WilayahProfilAdmin/WilayahProfilAdminHome.php";
                    }
                }
            }
        }
    }else{
        include "_Page/WilayahProfilAdmin/WilayahProfilAdminHome.php";
    }
?>