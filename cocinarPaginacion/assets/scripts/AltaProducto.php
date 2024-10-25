<?php
    include_once "database.php";
    
    $strProducto="";
    $intCantidad=0;
    $intCosto=0;
    $strDescripcion="";
    $link=null;
    $destino="../assets/imgProductos/";

    if(isset($_POST['subir'])){
        if(!empty($_POST['producto']) && !empty($_POST['cantidad']) && !empty($_POST['costo']) 
            && !empty($_POST['message']) && isset($_FILES['ImgProd'])
            && ($_FILES['ImgProd']['error'] === UPLOAD_ERR_OK)){
                $archivoInfo=$_FILES['ImgProd'];
                
                $strProducto=$_POST['producto'];
                $intCantidad=$_POST['cantidad'];
                $intCosto=$_POST['costo'];
                $strDescripcion=$_POST['message'];
                
                //Tomar la extenison de la imagen
                $ext=pathinfo($archivoInfo['name'],PATHINFO_EXTENSION);
                $strArchivo=$strProducto.'.'.$ext;
                $ubicacion=$destino.$strArchivo;

                //BUsca en el directorio si hay una imagen con el mismo nombre para eliminarlo
                if(file_exists($ubicacion)){   
                }else{
                    //Mover al directorio la imagen
                    if(move_uploaded_file($archivoInfo['tmp_name'],$ubicacion)){
                    }else{
                        echo "<h3>Ups hubo error con la imagen</h3>";
                    }
                }
                
                conectar_db($link);
                if($link){
                    $query=null;
                    sql_AltaProductos($link,$query,$strProducto,$intCantidad,$intCosto,$strDescripcion,$strArchivo);
                    
                    header("Location: ../Empleados/EmpleadoAlta.php");
                    exit();
                }
                //echo "<script>window.alert('Todo correcto');</script>";
        }else{
            //echo "<script type='text/javascript'>alert('No se ha llenado un campo');</script>";
        }


    }
?>