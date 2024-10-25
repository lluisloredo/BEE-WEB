<?php
    include "database.php";

    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        if(isset($_COOKIE['UserName'])){
            $nombreUsuario=$_COOKIE['UserName'];
        }
        if(isset($_POST['carritoId']) && isset($_POST['compara']) && isset($_POST['cantidad'])
            && isset($_POST['nombreProducto'])){
            $carritoId=$_POST['carritoId'];
            $costo=$_POST['compara'];
            $cantidad=$_POST['cantidad'];
            $strProducto=$_POST['nombreProducto'];

            $saldo=number_format($costo,2,'.','');
            $link=null;
            conectar_db($link);
            if($link){
                $query1=null;
                sql_CompraProducto($link,$query1,$carritoId,$strProducto,$nombreUsuario,$cantidad,$saldo);
            }
        }
    }
?>