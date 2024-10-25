<?php
    include_once "database.php";
    $strUser="";
    $strPass="";
    if(isset($_POST['Ingresa'])){
        if(!empty($_POST["txtUser"]) && !empty($_POST["txtPasswd"])){
            $strUser=trim($_POST['txtUser']);
            $strPasswd=trim($_POST['txtPasswd']);
            conectar_db($link);
            if($link){
                $query=null;
                sql_usuarios($link,$query,$strUser,$strPasswd);
                if(mysqli_num_rows($query)>0){
                    $listaUsuario=mysqli_fetch_array($query);
                    setcookie("UserType",$listaUsuario[3],time()+3600,"/");
                    setcookie("UserName",$listaUsuario[1],time()+3600,"/");
                    if($listaUsuario[3]==3){ //Cliente
                        header("location: Clientes/cliente.php");
                    }elseif($listaUsuario[3]==2){ //Empleado   
                        header("location: Empleados/EmpleadoAlta.php");
                    }elseif($listaUsuario[3]==0){ //Admin
                        header("location: Administrador/cliente.html");
                    }
                }else{
                    echo "<div class='msjLog'><h3>Usuario incorrecto</h3></div>";
                }
            }
        }else{
            echo "<div class='msjLog'><h3>No se ha llenado un campo</h3></div>";
        }
    }

?>