<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="DetailAnggaranDesa"){
            include "_Page/AnggaranAdmin/DetailAnggaranDesa.php";
        }else{
            include "_Page/AnggaranAdmin/AnggaranAdminHome.php";
        }
    }else{
        include "_Page/AnggaranAdmin/AnggaranAdminHome.php";
    }
?>