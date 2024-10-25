<?php
    $db='proyectoing';
    //Funcion para conectar con la base de datos
    function conectar_db(&$db_link,$db_Server='localhost',$db_user='root',$db_pass='',$db_name='proyectoing'){
        $db_link=mysqli_connect($db_Server,$db_user,$db_pass,$db_name);
        if(!$db_link){
            echo "<h2>!!!Ups ha ocurrido un error</h2>";
            exit;
        }
    }

    function desconectar_db(&$db_link){
        if($db_link){
            mysqli_close($db_link);
        }
    }
    

    //Funcion para saber el tipo de usuario
    function sql_usuarios(&$db_link,&$query,$strUser,$strPass){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT 
        idCliente AS 'id' ,nombreCliente AS 'usuario',passwdCliente AS 'Pass', 
        (3) AS 'Tipo'
        FROM cliente WHERE nombreCliente='$strUser' AND passwdCliente='$strPass'
        UNION
        SELECT 
        idEmpleado AS 'id' ,nombreEmpleado AS 'usuario',passwdEmpleado AS 'Pass', 
        (2) AS 'Tipo'
        FROM empleado WHERE nombreEmpleado='$strUser' AND passwdEmpleado='$strPass'
        UNION
        SELECT 
        idAdministrador AS 'id' ,nombreAdmin AS 'usuario',passwdAdmin AS 'Pass', 
        (0) AS 'Tipo'
        FROM administrador WHERE nombreAdmin='$strUser' AND passwdAdmin='$strPass'";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion para tomar los datos del cliente
    function sql_Cliente(&$db_link,&$query,$strUser){
        $str_query="SELECT * from cliente WHERE nombreCliente='$strUser'";
        $query=mysqli_query($db_link,$str_query);
    }


    //Funcion para crear productos y dar de alta en la base de datos
    function sql_AltaProductos(&$db_link,&$query,$strProducto,$intCantidad,$intCosto,$strDescripcion,$archivo){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="INSERT INTO 
        producto (nombreProducto,cantidadProducto,costoProducto,
        descripcionProducto,imagenProducto,cantidadVenta) VALUES ('$strProducto',
        $intCantidad,$intCosto,'$strDescripcion','$archivo',
        0)";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion para consultar productos de la tienda
    function sql_ConsultaTienda(&$db_link,&$query){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT idProducto,nombreProducto,costoProducto,cantidadProducto,
        imagenProducto,descripcionProducto FROM producto";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion consulta producto
    function sql_ConsultaProducto(&$db_link,&$query,$idProd){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT idProducto,nombreProducto,costoProducto,cantidadProducto,
        imagenProducto,descripcionProducto FROM producto WHERE idProducto=$idProd";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion consultar cantidad de productos en carrito
    function sql_CantidadCarrito(&$db_link,&$query,$strUsuario){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT carrito.*,cliente.nombreCliente FROM carrito JOIN cliente ON 
        carrito.cliente_id=cliente.idCliente WHERE cliente.nombreCliente='$strUsuario'";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion consulta nombre producto carrito
    function sql_NombreCarrito(&$db_link,&$query,$strUsuario,$strProducto){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT carrito.*, cliente.nombreCliente, producto.idProducto
        FROM carrito 
        JOIN cliente ON carrito.cliente_id = cliente.idCliente
        JOIN producto ON carrito.producto_id = producto.idProducto
        WHERE cliente.nombreCliente = '$strUsuario' AND producto.idProducto = $strProducto;";
        $query=mysqli_query($db_link,$str_query);
    }


    //Funcion crear carrito
    function sql_AltaCarrito(&$db_link,&$query,$strUsuario,$strProducto,$intCantidad){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="INSERT INTO carrito (cliente_id, producto_id, cantidad) 
        SELECT c.idCliente, p.idProducto, $intCantidad 
        FROM cliente c, producto p 
        WHERE c.nombreCliente = '$strUsuario' AND p.idProducto = $strProducto";
        $query=mysqli_query($db_link,$str_query);
    }

    //Funcion consultar carrito
    function sql_ConsultaCarrito(&$db_link,&$query,$strUsuario){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="SELECT carrito.*, 
            cliente.nombreCliente, 
            producto.nombreProducto,
            producto.costoProducto,
            producto.cantidadProducto,
            producto.imagenProducto
            FROM carrito 
            JOIN cliente ON carrito.cliente_id = cliente.idCliente
            JOIN producto ON carrito.producto_id = producto.idProducto 
            WHERE cliente.nombreCliente = '$strUsuario'";
        $query=mysqli_query($db_link,$str_query);
    }
    
    //Funcion para eliminar un producto del carrito
    function sql_EliminaCarrito(&$db_link,&$query,$strCarrito,$strUser){
        mysqli_select_db($db_link,$GLOBALS["db"]);
        $str_query="DELETE car FROM carrito car JOIN cliente cli ON 
        car.cliente_id=cli.idCliente  WHERE 
        car.idCarrito=$strCarrito AND cli.nombreCliente='$strUser'";
        $query=mysqli_query($db_link,$str_query);
    }

    function sql_CompraProducto(&$db_link, &$query, $idCarrito, $strProd, $strUser, $intCantidad, $floatSaldo) {
        mysqli_select_db($db_link, $GLOBALS["db"]);
        
        // Iniciar transacción
        mysqli_begin_transaction($db_link);
        
        try {
            // Preparar y ejecutar la primera consulta
            $stmt1 = $db_link->prepare("UPDATE producto SET cantidadVenta = cantidadVenta + ?, cantidadProducto = cantidadProducto - ? WHERE nombreProducto = ?");
            $stmt1->bind_param("iis", $intCantidad, $intCantidad, $strProd);
            $stmt1->execute();
            
            // Preparar y ejecutar la segunda consulta
            $stmt2 = $db_link->prepare("UPDATE cliente SET saldoCliente = ? WHERE nombreCliente = ?");
            $stmt2->bind_param("ds", $floatSaldo, $strUser);
            $stmt2->execute();
            
            // Preparar y ejecutar la tercera consulta
            $stmt3 = $db_link->prepare("DELETE car FROM carrito car JOIN cliente cli ON car.cliente_id = cli.idCliente WHERE car.idCarrito = ? AND cli.nombreCliente = ?");
            $stmt3->bind_param("is", $idCarrito, $strUser);
            $stmt3->execute();
            
            // Confirmar transacción
            mysqli_commit($db_link);
            
            $query = true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            mysqli_rollback($db_link);
            
            $query = false;
        }
    }

?>