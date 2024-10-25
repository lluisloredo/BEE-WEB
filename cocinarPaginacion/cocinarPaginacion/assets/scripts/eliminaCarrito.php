<?php
    include "database.php";
    
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        if(isset($_COOKIE['UserName'])){
            $nombreUsuario=$_COOKIE['UserName'];
        }
        if(isset($_POST['productoId'])){
            $producto=$_POST['productoId'];
            $link=null;
            conectar_db($link);
            if($link){
                $query=null;
                sql_EliminaCarrito($link,$query,$producto,$nombreUsuario);
            }
        }
    }
?>