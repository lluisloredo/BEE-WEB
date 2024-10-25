<?php
    include_once "database.php";

    $banderaMsg=false;
    $idProducto = isset($_GET['id']) ? $_GET['id'] : null;
    $link=null;
    conectar_db($link);
    if($link && $idProducto){
        $query=null;
        sql_ConsultaProducto($link,$query,$idProducto);
        if(mysqli_num_rows($query) > 0){
            $listaProducto=mysqli_fetch_array($query);
        }
    }
?>