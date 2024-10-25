<?php
    if(isset($_COOKIE['UserName'])){
        setcookie('UserName',"",time()-3600,"/");
    }
    if(isset($_COOKIE['UserType'])){
        setcookie('UserType',"",time()-3600,"/");
    }
    header("Location: ../../login.php");
?>