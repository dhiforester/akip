<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="Detail"){
            include "_Page/PerjanjianKinerja/PerjanjianKinerjaHome.php";
        }else{
            include "_Page/PerjanjianKinerja/PerjanjianKinerjaHome.php";
        }
    }else{
        include "_Page/PerjanjianKinerja/PerjanjianKinerjaHome.php";
    }
?>