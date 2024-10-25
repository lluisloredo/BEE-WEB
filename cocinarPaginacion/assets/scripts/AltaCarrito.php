<?php
    include_once "database.php";

    
    $cantidad = 0;
    if (isset($_POST['btnCarrito'])) {
        $strCliente = $nombreUsuario; 
        $strProducto = $_GET['id']; 
        $cantidad=$_POST['product-quanity'];
        
        $bandera1=true;
        $link1=null;
        conectar_db($link1);
        if($link1){
            $query1=null;
            sql_NombreCarrito($link1,$query1,$strCliente,$strProducto);
            if(mysqli_num_rows($query1) > 0){
                $bandera1=false;
            }
        }

        $link=null;
        conectar_db($link);
        if($link && $bandera1===true){
            $query=null;
            sql_AltaCarrito($link,$query,$strCliente,$strProducto,$cantidad);

            header("Location: ../Clientes/clienteProducto.php?id=$strProducto");
            exit();
        }else{
            //echo "<script>alert('Ya se agrego el producto');</script>";
        }
        

    }
?>