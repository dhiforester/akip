<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_SESSION["id_akses"])){
        session_destroy();   
        session_unset();
        header('Location:../../Login.php');
    }else{
        if(empty($_SESSION["login_token"])){
            session_destroy();   
            session_unset();
            header('Location:../../Login.php');
        }else{
            $SessionIdAkses=$_SESSION ["id_akses"];
            $SessionLoginToken=$_SESSION ["login_token"];
            $HapusAksesToken = mysqli_query($Conn, "DELETE FROM akses_token WHERE id_akses='$SessionIdAkses' AND akses_token='$SessionLoginToken'") or die(mysqli_error($Conn));
            if($HapusAksesToken){
                session_destroy();   
                session_unset();
                header('Location:../../Login.php');
            }else{
                session_destroy();   
                session_unset();
                header('Location:../../Login.php');
            }
        }
    }
?>