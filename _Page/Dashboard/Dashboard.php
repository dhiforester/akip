<?php
    if($SessionAkses=="Admin"){
        include "_Page/Dashboard/DashboardAdmin.php";
    }else{
        include "_Page/Dashboard/DashboardHome.php";
    }
?>