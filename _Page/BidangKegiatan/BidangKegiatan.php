<?php
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'MUYYab7J5Q');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        if(empty($_GET['Sub'])){
            include "_Page/BidangKegiatan/BidangKegiatanHome.php";
        }else{
            $Sub=$_GET['Sub'];
            if($Sub=="BidangKegiatanKabupaten"){
                include "_Page/BidangKegiatan/BidangKegiatanKabupaten.php";
            }
        }
    }
?>