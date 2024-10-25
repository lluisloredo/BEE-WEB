<?php
    include "database.php";

    $link=null;
    conectar_db($link);
    if($link){
        $query=null;
        sql_CantidadCarrito($link,$query,$nombreUsuario);
        $prodCarrito=mysqli_num_rows($query);
    }

    $link1=null;
    conectar_db($link1);
    if($link1){
        $query1=null;
        sql_Cliente($link1,$query1,$nombreUsuario);
        if(mysqli_num_rows($query1) > 0){
            $datosCliente=mysqli_fetch_array($query1);
        }
    }

    $ubicacion="C. Morelos 1670, Barrio de San Sebastian, 78139 San Luis Potosí, S.L.P.";
    $numLocal="444 814 2130";
    $anioAct=date("Y");
    $correoLocal="BEE-WEB@gmail.com";
?>