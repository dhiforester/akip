<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="Identitas"){
            include "_Page/WilayahProfil/WilayahIdentitas.php";
        }else{
            if($Sub=="StrukturOrganisasi"){
                include "_Page/WilayahProfil/StrukturOrganisasi.php";
            }else{
                if($Sub=="Demografi"){
                    include "_Page/WilayahProfil/Demografi.php";
                }else{
                    if($Sub=="DetailDemografi"){
                        include "_Page/WilayahProfil/DetailDemografi.php";
                    }else{
                        if($Sub=="ProgramCapaian"){
                            include "_Page/WilayahProfil/ProgramCapaian.php";
                        }else{
                            
                        }
                    }
                }
            }
        }
    }
?>